import {deletar} from "../scriptGeral/alteracaoDelecao.js";

const botaoDeletar = document.querySelector("#botao-deletar");
const botaoDeletarFormulario = document.querySelector("#botao-deletar-formulario");

const deletarMarcaProduto = (evento) => {
    deletar(evento, botaoDeletarFormulario)
}

botaoDeletar.addEventListener("click", deletarMarcaProduto);
