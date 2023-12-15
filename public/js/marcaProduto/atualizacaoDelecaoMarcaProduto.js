import {exibirAviso, ocultarAviso} from "../avisos/aviso.js";
import {escolherAlteracao} from "../avisos/avisoEscolha.js";
import {limparSelecaoTabela} from "../scriptGeral/indexCRUD.js";

const listaItensMarca = document.querySelectorAll("tbody tr");
const avisoEscolhaAtualizacaoDelecao = document.querySelector("#escolha-atualizacao-delecao");
const botaoFecharAviso = document.querySelector("#botao-fechar-aviso");
const botaoAlterar = document.querySelector("#botao-opcao1");
const linhasTabelaMarca = document.querySelectorAll("tbody tr");


const exibirAvisoEscolhaAtualizacaoDelecao = (evento) => {
    const idMarca = evento.target.parentNode.dataset.id;

    prepararOpcaoAlteracao(idMarca);

    exibirAviso(avisoEscolhaAtualizacaoDelecao)
}

const ocultarAvisoEscolhaAtualizacaoDelecao = () => {
    limparSelecaoTabela(linhasTabelaMarca)

    ocultarAviso(avisoEscolhaAtualizacaoDelecao)
}

const prepararOpcaoAlteracao = (idMarca) => {
    const url = `http://127.0.0.1:8000/marca/${idMarca}/edit`

    escolherAlteracao(url, botaoAlterar);
}

window.onload = () => {
    for (let marca of listaItensMarca) {
        marca.addEventListener("click", exibirAvisoEscolhaAtualizacaoDelecao);
    }
}

botaoFecharAviso.addEventListener("click", ocultarAvisoEscolhaAtualizacaoDelecao);
