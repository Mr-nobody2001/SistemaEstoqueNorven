import {deletar} from "../scriptGeral/alteracaoDelecao.js";
import {validacaoBootstrap} from "../validacao/validacaoPesquisa.js";
import {verificarMensagensSecao} from "../avisos/toast.js";

const botaoDeletar = document.querySelector("#botao-deletar");
const botaoDeletarFormulario = document.querySelector("#botao-deletar-formulario");

const deletarMarcaProduto = (evento) => {
    deletar(evento, botaoDeletarFormulario)
}

window.onload = () => {
    validacaoBootstrap();
    verificarMensagensSecao();
}

botaoDeletar.addEventListener("click", deletarMarcaProduto);
