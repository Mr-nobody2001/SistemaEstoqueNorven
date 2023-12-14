const listaItensMarca = document.querySelectorAll("tbody tr");
const exibirFormularioAtualizacao = async (evento) => {
    console.log(evento.target.parentNode.dataset.id)
    const apiUrl = `http://localhost:8000/marca/${evento.target.parentNode.dataset.id.toString()}/edit`;

    const paginaHtml = await fetch(apiUrl);

    document.body.innerHTML = await paginaHtml.text();
}

window.onload = () => {
    for (let marca of listaItensMarca) {
        marca.addEventListener("click", exibirFormularioAtualizacao)
    }
}
