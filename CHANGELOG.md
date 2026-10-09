***Español** · English below*

# Novedades de RackScope

## v2.0 — 9 de octubre de 2026

Todo lo que habéis pedido en las *issues* de GitHub. Gracias.

- **Cables entre salas** ([#5](https://github.com/marcosblg/rackscope/issues/5)): pulsa *Conectar esta boca…*, cambia de sala en el desplegable y elige el destino. La boca lleva la marca ↗, su ficha te lleva a la otra sala y los cables salen en el CSV y el PDF con la sala de cada extremo.
- **Trabajo en equipo** ([#1](https://github.com/marcosblg/rackscope/issues/1)): con un `.json` compartido en una carpeta de red, cada persona ve los cambios de las demás en unos segundos y, si dos guardan a la vez, se avisa en vez de pisar nada. Y hay un **modo servidor** opcional para Apache con PHP (`rackscope.php`): todo el equipo trabaja sobre el mismo plano desde su navegador. Ver [SERVIDOR.md](SERVIDOR.md).
- **Bocas SFP aparte** ([#6](https://github.com/marcosblg/rackscope/issues/6)) con su propia numeración (S1, S2…), a la derecha o a la izquierda, y numeración invertida: impares abajo y pares arriba. Si pasas un switch de "24 + 4" a 24 bocas + 4 SFP, los cables de las bocas 25-28 se quedan en S1-S4.
- **Tipos de equipo propios** ([#3](https://github.com/marcosblg/rackscope/issues/3)) con su nombre y su color: *＋ Nuevo tipo…* en la ficha del equipo, o *Sala ⋯ › Tipos de equipo*.
- **Copiar un rack** ([#2](https://github.com/marcosblg/rackscope/issues/2)) al crear uno nuevo, de esta sala o de otra, con sus cables internos si quieres.
- Los **huecos libres** reservados ya no cuentan como U ocupadas ([#4](https://github.com/marcosblg/rackscope/issues/4)): *"13 / 42 U · quedan 29 U libres (3 en huecos reservados)"*.
- El CSV lleva ahora la sala de origen y la de destino de cada cable.

Los datos de versiones anteriores se cargan tal cual, sin hacer nada.

## v1.2 — 2 de octubre de 2026

Actualización de seguridad. Se recomienda a todo el mundo.

- Los archivos JSON que importas o abres se revisan a fondo antes de usarlos: números, opciones, identificadores y cables a bocas que no existen. Un archivo manipulado ya no puede ejecutar nada en la página.
- La página tiene bloqueada cualquier conexión a Internet (política de seguridad del navegador): que tus datos no salen de tu equipo ya no es solo una promesa, lo garantiza el navegador.
- Al exportar a Excel (CSV), los textos que empiezan por `=`, `+`, `-` o `@` ya no se interpretan como fórmulas.

## v1.1 — 2 de octubre de 2026

- La ventana de la boca se arrastra por su cabecera y se queda donde la dejas. *(Sugerencia de la comunidad: gracias.)*
- Al pulsar **Conectar esta boca…** la ventana se reduce a la cabecera y un aviso, para que no tape la boca de destino.
- El número de versión aparece junto al nombre; al pulsarlo se ven las novedades. Quien ya usaba RackScope ve un aviso con lo nuevo la primera vez que abre la versión actualizada.

## v1.0 — 30 de septiembre de 2026

Primera versión pública.

- Salas, racks y equipos con su número real de bocas, de 1 a 96.
- Cables con tipo, etiqueta y nota; clic en una boca para saber a dónde va.
- Regla de U con el espacio libre y colocación de bocas a mano.
- Exportación a PNG, SVG, PDF, CSV y JSON, y guardado automático en un archivo vinculado.
- Demo guiada de 30 segundos.

---

# What's new in RackScope

## v2.0 — October 9, 2026

Everything you asked for in the GitHub issues. Thank you.

- **Cables between rooms** (#5): hit *Conectar esta boca…*, switch rooms in the selector and pick the destination. The port shows a ↗ mark, its card takes you to the other room, and these cables appear in the CSV and PDF with each end's room.
- **Teamwork** (#1): with a `.json` shared in a network folder, everyone sees the others' changes within seconds, and if two people save at once the app warns instead of overwriting. Plus an optional **server mode** for Apache with PHP (`rackscope.php`) so the whole team works on the same plan from their browsers. See [SERVIDOR.md](SERVIDOR.md).
- **Separate SFP ports** (#6) with their own numbering (S1, S2…), right or left, and inverted numbering: odd ports at the bottom, even at the top. Turning a "24 + 4" switch into 24 ports + 4 SFP keeps the cables of ports 25-28 on S1-S4.
- **Custom device types** (#3) with their own name and color.
- **Copy a rack** (#2) when creating a new one, from this room or another, optionally with its internal cables.
- Reserved **blank panels** no longer count as used U (#4).
- The CSV now includes the source and destination room of each cable.

Data from previous versions loads as is.

## v1.2 — October 2, 2026

Security update. Recommended for everyone.

- JSON files you import or open are thoroughly validated before use: numbers, options, identifiers and cables pointing to ports that do not exist. A tampered file can no longer run anything on the page.
- The page blocks every connection to the Internet (browser security policy): your data staying on your machine is no longer just a promise, the browser enforces it.
- When exporting to Excel (CSV), text starting with `=`, `+`, `-` or `@` is no longer treated as a formula.

## v1.1 — October 2, 2026

- The port window can be dragged by its header and stays where you leave it. *(Community suggestion: thank you.)*
- When you hit **Conectar esta boca…** (connect this port) the window shrinks to its header and a hint, so it never covers the destination port.
- The version number is shown next to the name; click it to see what's new. Existing users get a one-time notice the first time they open the updated version.

## v1.0 — September 30, 2026

First public release.

- Rooms, racks and devices with their real port count, from 1 to 96.
- Cables with type, label and note; click a port to see where it goes.
- U ruler with free space, and ports placed by hand.
- Export to PNG, SVG, PDF, CSV and JSON, plus automatic saving to a linked file.
- 30-second guided demo.
