import {validarPesquisa} from "../validacao/validacaoPesquisa.js";
import {atualizarPagina, indicarSelecaoElementoTabela} from "../scriptGeral/indexCRUD.js";
import {ocultarAvisoEscolhaAtualizacaoDelecao} from "../scriptGeral/indexCRUD.js";
import {prepararOpcaoAlteracao} from "../scriptGeral/indexCRUD.js";
import {exibirAvisoEscolhaAtualizacaoDelecao} from "../scriptGeral/indexCRUD.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");
const linhasTabelaMarca = document.querySelectorAll("tbody tr");
const listaItensMarca = document.querySelectorAll("tbody tr");
const avisoEscolhaAtualizacaoDelecao = document.querySelector("#escolha-atualizacao-delecao");
const botaoEscondido = document.querySelector("#botao-opcao2");
const botaoAlterar = document.querySelector("#botao-opcao1");
const botaoFecharAviso = document.querySelector("#botao-fechar-aviso");

const validarPesquisaMarcaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    validarPesquisa(evento, valorPesquisa);
}

const atualizarPaginaMarcaProduto = () => {
    atualizarPagina();
}

const indicarSelecaoElementoTabelaMarca = (evento) => {
    const linhaTabelaMarcaSelecionada = evento.target.parentNode;

    indicarSelecaoElementoTabela(linhasTabelaMarca, linhaTabelaMarcaSelecionada, avisoEscolhaAtualizacaoDelecao);
}

const prepararOpcaoAlteracaoMarcaProduto = (evento) => {
    const idMarca = evento.target.parentNode.dataset.id;

    prepararOpcaoAlteracao('marca', idMarca, botaoAtualizar);
}

const exibirAvisoEscolhaAtualizacaoDelecaoMarcaProduto = (evento) => {
    exibirAvisoEscolhaAtualizacaoDelecao(evento, botaoEscondido, botaoAlterar, avisoEscolhaAtualizacaoDelecao)
}

const ocultarAvisoEscolhaAtualizacaoDelecaoMarcaProduto = () => {
    ocultarAvisoEscolhaAtualizacaoDelecao(linhasTabelaMarca, avisoEscolhaAtualizacaoDelecao)
}

window.onload = () => {
    for (let listaItenMarca of listaItensMarca) {
        listaItenMarca.addEventListener("click", exibirAvisoEscolhaAtualizacaoDelecaoMarcaProduto);
        listaItenMarca.addEventListener("click", indicarSelecaoElementoTabelaMarca)
    }
}

botaoPesquisa.addEventListener("click", validarPesquisaMarcaProduto);
botaoAtualizar.addEventListener("click", atualizarPaginaMarcaProduto);
botaoFecharAviso.addEventListener("click", ocultarAvisoEscolhaAtualizacaoDelecaoMarcaProduto);
