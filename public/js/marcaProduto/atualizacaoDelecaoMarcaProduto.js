import {exibirAviso, ocultarAviso} from "../avisos/aviso.js";

const listaItensMarca = document.querySelectorAll("tbody tr");
const avisoConfirmacaoAtualizacaoDelecao = document.querySelector("#confirmacao-atualizacao-delecao");
const botaoFecharAviso = document.querySelector("#botao-fechar-aviso");

const exibirAvisoConfirmacaoAtualizacaoDelecao = () => {
    exibirAviso(avisoConfirmacaoAtualizacaoDelecao)
}

const ocultarAvisoConfirmacaoAtualizacaoDelecao = () => {
    ocultarAviso(avisoConfirmacaoAtualizacaoDelecao)
}

window.onload = () => {
    for (let marca of listaItensMarca) {
        marca.addEventListener("click", exibirAvisoConfirmacaoAtualizacaoDelecao);
    }

    botaoFecharAviso.addEventListener("click", ocultarAvisoConfirmacaoAtualizacaoDelecao);
}
