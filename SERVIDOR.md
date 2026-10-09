# RackScope en un servidor (trabajo en equipo)

Por defecto RackScope es un único `index.html` que guarda los datos en tu navegador o en un archivo tuyo. Si queréis trabajar **varias personas sobre el mismo plano**, cada una desde su navegador y sin exportar ni importar, hay dos caminos.

## Opción 1 · Carpeta de red (sin servidor)

1. Guardad `index.html` en una carpeta compartida, o que cada uno tenga su copia.
2. Cada persona pulsa **💾 Archivo** y vincula **el mismo** `.json` de la carpeta de red.

La aplicación mira cada pocos segundos si alguien ha cambiado el archivo y carga sus cambios sola. Si dos personas guardan casi a la vez, avisa y deja elegir entre cargar los cambios del otro o guardar los propios encima.

Cada navegador recuerda el archivo vinculado, pero al volver a abrir RackScope puede pedir permiso otra vez: basta con pulsar **💾 Archivo**.

## Opción 2 · Servidor Apache con PHP (recomendada para equipos)

Necesitas Apache, o cualquier servidor web, con **PHP 7.4 o superior**. No hace falta base de datos.

1. Copia **`index.html`** y **`rackscope.php`** en una carpeta del servidor, por ejemplo `/var/www/html/rackscope/`.
2. Da permiso de escritura al servidor web sobre esa carpeta. La primera vez se crea dentro una carpeta `datos/`:
   ```bash
   sudo chown www-data:www-data /var/www/html/rackscope
   ```
3. Abrid en el navegador **`http://tu-servidor/rackscope/rackscope.php`**. Es importante entrar por `rackscope.php`, no por `index.html`.

La primera persona que entra sube los datos que tuviera en su navegador. A partir de ahí:

- Todo se guarda en `datos/rackscope.json`. En la barra superior aparece **🌐 Servidor**.
- Los cambios de los demás aparecen solos en unos segundos.
- Si dos personas guardan a la vez, la aplicación avisa en vez de pisar nada.
- Cada día se guarda una copia en `datos/copia-AAAA-MM-DD.json`.
- La carpeta `datos/` queda protegida: no se puede descargar desde el navegador (se crea un `.htaccess`).

### Proteger el acceso

`rackscope.php` no pide usuario: cualquiera que llegue a la dirección puede ver y editar. Si el servidor no está solo en vuestra red interna, protegedlo con usuario y contraseña de Apache. Por ejemplo, con un `.htaccess` en la misma carpeta:

```apache
AuthType Basic
AuthName "RackScope"
AuthUserFile /etc/apache2/.htpasswd-rackscope
Require valid-user
```

```bash
sudo htpasswd -c /etc/apache2/.htpasswd-rackscope marcos
```

### Actualizar RackScope

Sustituye `index.html` y `rackscope.php` por los nuevos. La carpeta `datos/` no se toca.

### Si algo falla

- **"⚠ Sin conexión con el servidor"**: revisa que PHP funcione y que la carpeta tenga permiso de escritura. El registro de errores de Apache dirá el motivo.
- **Abrir `index.html` directamente** desde el servidor también funciona, pero entonces cada navegador guarda sus propios datos, como en la versión de escritorio. Para trabajar en equipo hay que entrar por `rackscope.php`.
