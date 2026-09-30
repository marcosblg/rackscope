# Guion del vídeo y texto del post

## 1. Vídeo de demostración (60–90 segundos)

Graba con la sala de ejemplo que trae el archivo. **No abras tu sala real en ningún momento**, ni siquiera un segundo: el desplegable de salas se ve en pantalla.

Antes de grabar: pulsa `Reiniciar` para dejar la sala de ejemplo como recién instalada, pon el zoom al 100 % y cierra la leyenda si te estorba.

| Tiempo | Qué se ve | Qué haces |
|---|---|---|
| 0:00–0:08 | Plano general de los dos racks | Nada. Que se vea el conjunto: bocas, colores, regla de U |
| 0:08–0:20 | El problema | Clic en la boca 48 del SWITCH CORE 01 → sale la ficha: *va al SWITCH PLANTA 1, boca 27, fibra multimodo, troncal A-B* |
| 0:20–0:30 | Lo mismo pero al vuelo | Pasa el ratón por varias bocas seguidas y que se vean los avisos rápidos |
| 0:30–0:42 | Crear una conexión | Clic en una boca libre → *Conectar esta boca* → clic en otra → eliges Cat6a, etiqueta y nota → Guardar |
| 0:42–0:55 | Capacidad | Señala la regla de U y el bloque verde: *quedan 26 U libres*, y el hueco reservado de 3U |
| 0:55–1:10 | Dibujar el rack | Entra en *Mover bocas*, arrastra dos o tres bocas, selección con Ctrl y botón *Alinear fila* |
| 1:10–1:25 | Sacar la documentación | Menú *Exportar* → PNG y CSV, que se vea la tabla de conexiones abierta en Excel |
| 1:25–1:30 | Cierre | Vuelve al plano general |

Consejos: graba a 1080p, ventana maximizada, sin notificaciones del sistema. Si el vídeo va a LinkedIn, formato horizontal y sin audio: LinkedIn se reproduce en silencio, así que pon rótulos cortos en pantalla.

## 2. Post para LinkedIn

> Llevaba tiempo con el mismo problema en el trabajo: delante de un rack con paneles de 24 y 48 bocas, saber a dónde va un cable concreto significa seguirlo con la vista entre decenas de latiguillos, o tirar de él y cruzar los dedos.
>
> Así que me he montado una herramienta para documentarlo.
>
> Un único archivo HTML. Se abre con doble clic, sin instalar nada, sin servidor y sin que salga un solo dato del equipo.
>
> Qué hace:
>
> → Dibujas tus racks tal y como son: número real de bocas, numeración vertical como los switches de verdad, equipos de 1U, 2U o 4U, cabinas y huecos.
> → Conectas dos bocas con dos clics y le pones tipo de cable, etiqueta y nota.
> → Y lo importante: **clic en cualquier boca y te dice al instante a qué boca exacta va**, en qué rack y con qué cable. Sin seguir el cable con la vista.
> → La regla de U te dice cuántas unidades te quedan libres, así que sabes si te cabe el servidor nuevo sin bajar al CPD.
> → Y lo sacas en PNG, PDF, Excel o JSON para entregar la documentación.
>
> Lo he desarrollado con Claude Code, iterando sobre problemas reales según me los iba encontrando: que los cables tapaban la pantalla, que no se veía la capacidad del rack, que necesitaba varias salas...
>
> Lo dejo en GitHub por si le sirve a alguien más. Es gratis y el código está a la vista.
>
> 👉 [enlace al repositorio]
>
> Y ahora la pregunta que me interesa de verdad: **si documentas racks o infraestructura, ¿qué te falta en tu día a día?** ¿Inventario de equipos, control de garantías, etiquetado, diagramas de red, seguimiento de VLANs? Dímelo en comentarios y lo miro: de las sugerencias han salido ya la mitad de las funciones.
>
> #Sistemas #Redes #Infraestructura #SysAdmin #Datacenter #Documentación #OpenSource

## 3. Antes de publicar, repasa

- [ ] El vídeo no enseña en ningún momento tu sala real ni el desplegable con su nombre.
- [ ] El repositorio no lleva tu `.json` de datos (el `.gitignore` ya los excluye, pero míralo).
- [ ] La captura del README es de la sala de ejemplo.
- [ ] Si tu empresa tiene política sobre publicar herramientas hechas para el trabajo, consúltalo antes.
