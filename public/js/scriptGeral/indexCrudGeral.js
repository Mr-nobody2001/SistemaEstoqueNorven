import {validarPesquisa} from "../validacao/validacaoPesquisa.js";
import {atualizarPagina, indicarSelecaoElementoTabela} from "../scriptService/indexCRUD.js";
import {ocultarAvisoEscolhaAtualizacaoDelecao} from "../scriptService/indexCRUD.js";
import {prepararOpcaoAlteracao} from "../scriptService/indexCRUD.js";
import {exibirAvisoEscolhaAtualizacaoDelecao} from "../scriptService/indexCRUD.js";
import {verificarMensagensSecao} from "../avisos/toast.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");
const linhasTabela = document.querySelectorAll("tbody tr");
const listaItens = document.querySelectorAll("tbody tr");
const tabela = document.querySelector(".tabela");
const avisoEscolhaAtualizacaoDelecao = document.querySelector("#escolha-atualizacao-delecao");
const botaoAlterar = document.querySelector("#botao-opcao1");
const botaoEscondido = document.querySelector("#botao-opcao2");
const botaoFecharAviso = document.querySelector("#botao-fechar-aviso");

const validarPesquisaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    validarPesquisa(evento, valorPesquisa);
}

const atualizarPaginaProduto = () => {
    const entidade = tabela.dataset.entidade;

    atualizarPagina(entidade);
}

const indicarSelecaoElementoTabelaProduto = (evento) => {
    const linhaTabelaSelecionada = evento.target.parentNode;

    indicarSelecaoElementoTabela(linhasTabela, linhaTabelaSelecionada, avisoEscolhaAtualizacaoDelecao);
}

const prepararOpcaoAlteracaoProduto = (evento) => {
    const entidade = tabela.dataset.entidade;
    const id = evento.target.parentNode.dataset.id;

    prepararOpcaoAlteracao(entidade, id, botaoAlterar);
}

const exibirAvisoEscolhaAtualizacaoDelecaoProduto = (evento) => {
    prepararOpcaoAlteracaoProduto(evento);

    exibirAvisoEscolhaAtualizacaoDelecao(botaoEscondido, avisoEscolhaAtualizacaoDelecao)
}

const ocultarAvisoEscolhaAtualizacaoDelecaoProduto = () => {
    ocultarAvisoEscolhaAtualizacaoDelecao(linhasTabela, avisoEscolhaAtualizacaoDelecao)
}

window.onload = () => {
    for (let listaIten of listaItens) {
        listaIten.addEventListener("click", exibirAvisoEscolhaAtualizacaoDelecaoProduto);
        listaIten.addEventListener("click", indicarSelecaoElementoTabelaProduto)
    }

    verificarMensagensSecao();
}

botaoPesquisa.addEventListener("click", validarPesquisaProduto);
botaoAtualizar.addEventListener("click", atualizarPaginaProduto);
botaoFecharAviso.addEventListener("click", ocultarAvisoEscolhaAtualizacaoDelecaoProduto);
