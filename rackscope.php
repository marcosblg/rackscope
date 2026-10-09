<?php
/*
 * RackScope · modo servidor (opcional)
 *
 * Sirve la aplicación y guarda los datos en datos/rackscope.json para que varias
 * personas trabajen sobre el mismo plano, cada una desde su navegador.
 * Se instala copiando este archivo junto a index.html en una carpeta de Apache
 * con PHP. Instrucciones completas en SERVIDOR.md.
 *
 * Sin base de datos ni dependencias: PHP 7.4 o superior.
 */
declare(strict_types=1);

const DATOS_DIR = __DIR__ . '/datos';
const DATOS     = DATOS_DIR . '/rackscope.json';
const MAX_BYTES = 20 * 1024 * 1024;   // 20 MB por guardado

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: no-referrer');

function responder(int $codigo, string $json): void {
    http_response_code($codigo);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo $json;
    exit;
}
function error_json(int $codigo, string $msg): void {
    responder($codigo, json_encode(['error' => $msg], JSON_UNESCAPED_UNICODE));
}
// la carpeta de datos no debe poder leerse desde el navegador
function preparar_carpeta(): void {
    if (!is_dir(DATOS_DIR) && !@mkdir(DATOS_DIR, 0770, true)) {
        error_json(500, 'No se puede crear la carpeta datos/: revisa los permisos');
    }
    $ht = DATOS_DIR . '/.htaccess';
    if (!is_file($ht)) {
        @file_put_contents($ht, "<IfModule mod_authz_core.c>\n  Require all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\n  Deny from all\n</IfModule>\n");
    }
}

/* ---- 1) la aplicación: index.html con permiso para hablar con este mismo servidor ---- */
if (!isset($_GET['datos'])) {
    $html = @file_get_contents(__DIR__ . '/index.html');
    if ($html === false) {
        http_response_code(500);
        exit('Falta index.html en la misma carpeta que rackscope.php');
    }
    // index.html bloquea toda conexión; aquí solo se abre al propio servidor
    $html = str_replace("connect-src 'none'", "connect-src 'self'", $html);
    $aviso = '<script>window.RS_SERVER=' . json_encode(basename(__FILE__)) . ';</script>';
    $pos = strpos($html, '<script>');
    if ($pos !== false) {
        $html = substr_replace($html, $aviso, $pos, 0);
    }
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: no-cache');
    echo $html;
    exit;
}

/* ---- 2) los datos ---- */
// cabecera propia: un formulario de otra web no puede enviarla sin permiso del navegador
if (($_SERVER['HTTP_X_RACKSCOPE'] ?? '') !== '1') {
    error_json(403, 'Petición no válida');
}
preparar_carpeta();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!is_file(DATOS)) {
        responder(200, '{"version":null,"db":null}');
    }
    $txt = (string)file_get_contents(DATOS);
    $ver = sha1($txt);
    if (($_GET['v'] ?? '') === $ver) {
        responder(200, json_encode(['version' => $ver, 'igual' => true]));
    }
    responder(200, '{"version":' . json_encode($ver) . ',"db":' . $txt . '}');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    error_json(405, 'Método no permitido');
}
if (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== 0) {
    error_json(415, 'Se esperaba JSON');
}
$cuerpo = file_get_contents('php://input', false, null, 0, MAX_BYTES + 1);
if ($cuerpo === false || strlen($cuerpo) > MAX_BYTES) {
    error_json(413, 'Datos demasiado grandes');
}
$pet = json_decode($cuerpo);
if (!is_object($pet) || !isset($pet->db) || !is_object($pet->db) || !isset($pet->db->rooms) || !is_array($pet->db->rooms)) {
    error_json(400, 'Datos no válidos');
}

// un guardado cada vez; si alguien guardó antes que tú, se devuelve lo suyo (409)
$cerrojo = fopen(DATOS_DIR . '/.bloqueo', 'c');
if ($cerrojo === false || !flock($cerrojo, LOCK_EX)) {
    error_json(500, 'No se pudo bloquear el archivo de datos');
}
$actual = is_file(DATOS) ? (string)file_get_contents(DATOS) : null;
$verActual = $actual === null ? null : sha1($actual);
if (empty($pet->force) && $verActual !== ($pet->version ?? null)) {
    flock($cerrojo, LOCK_UN);
    responder(409, '{"version":' . json_encode($verActual) . ',"db":' . ($actual ?? 'null') . '}');
}
$nuevo = json_encode($pet->db, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$tmp = DATOS . '.tmp';
if ($nuevo === false || file_put_contents($tmp, $nuevo) === false || !rename($tmp, DATOS)) {
    flock($cerrojo, LOCK_UN);
    error_json(500, 'No se pudo guardar: revisa los permisos de la carpeta datos/');
}
// una copia por día, por si alguien borra algo sin querer
$copia = DATOS_DIR . '/copia-' . date('Y-m-d') . '.json';
if (!is_file($copia)) {
    @copy(DATOS, $copia);
}
flock($cerrojo, LOCK_UN);
responder(200, json_encode(['version' => sha1($nuevo)]));
