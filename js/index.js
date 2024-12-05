const $ = (id) => document.getElementById(id);
const $$ = (element) => document.querySelectorAll(element);

const mensajeContenedor = document.querySelector('.mensaje-cotizacion');
const textoMensajeElemento = $('contenido-mensaje-cotizacion');

const contenedorResultados = $('contenedor_resultados');
const contenedorResultadosLista = $('contenedor_resultados_lista');
const botonCotizar = $('boton-cotizar');
const botonesCatalogo = $$('.agregar-producto');

let agregados = [];
let catalogoIds = [];

let idUsuario = null;

for (let i = 0; i < botonesCatalogo.length; i++) {
    const nombreProducto = botonesCatalogo[i].dataset.nombre;
    const idCatalogo = Number(botonesCatalogo[i].dataset.catalogo);

    idUsuario = Number(botonesCatalogo[i].dataset.usuario);

    botonesCatalogo[i].addEventListener('click', () => {
        if (agregados.includes(nombreProducto)) return;

        contenedorResultadosLista.innerHTML += `<li><h3>${nombreProducto}</h3></li>`;
        agregados.push(nombreProducto);
        catalogoIds.push(idCatalogo);

        if (agregados.length > 0) contenedorResultados.style = 'display: block;';
    })
}

botonCotizar.addEventListener('click', async () => {
    const response = await fetch('/proyecto_sena/controller/cotizacion.php', {
        method: 'POST',
        body: JSON.stringify({ idUsuario, catalogo: catalogoIds }),
    });

    const data = await response.json();

    mensajeContenedor.style = 'display: block; margin-top: 15px;';
    textoMensajeElemento.innerText = data.mensaje;

    agregados = [];
    catalogoIds = [];

    contenedorResultados.style = 'display: none;';
});