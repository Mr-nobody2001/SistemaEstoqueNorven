import {validarPesquisaData, validarPesquisaTexto} from "../validacao/validacaoPesquisa.js";
import {atualizarPagina, indicarSelecaoElementoTabela} from "../service/indexCRUD.js";
import {ocultarAvisoEscolhaAtualizacaoDelecao} from "../service/indexCRUD.js";
import {prepararOpcaoAlteracao} from "../service/indexCRUD.js";
import {exibirAvisoEscolhaAtualizacaoDelecao} from "../service/indexCRUD.js";
import {verificarMensagensSecao} from "../avisos/toast.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");
const linhasTabela = document.querySelectorAll("tbody tr");
const tabela = document.querySelector(".tabela");
const avisoEscolhaAtualizacaoDelecao = document.querySelector("#escolha-atualizacao-delecao");
const botaoAlterar = document.querySelector("#botao-opcao1");
const botaoEscondido = document.querySelector("#botao-opcao2");
const botaoFecharAviso = document.querySelector("#botao-fechar-aviso");

const validarPesquisaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    barraPesquisa.type === "date" ? validarPesquisaData(evento, valorPesquisa) :
        validarPesquisaTexto(evento, valorPesquisa);
}

const atualizarPaginaProduto = () => {
    const entidade = tabela.dataset.entidade;

    atualizarPagina(entidade);
}

const indicarSelecaoElementoTabelaProduto = (evento) => {
    const linhaTabelaSelecionada = evento.target.parentNode;

    if (linhaTabelaSelecionada.tagName === 'TR') indicarSelecaoElementoTabela(linhasTabela, linhaTabelaSelecionada, avisoEscolhaAtualizacaoDelecao);
}

const prepararOpcaoAlteracaoProduto = (evento) => {
    const entidade = tabela.dataset.entidade;
    const id = evento.target.parentNode.dataset.id;

    prepararOpcaoAlteracao(entidade, id, botaoAlterar);
}

const exibirAvisoEscolhaAtualizacaoDelecaoProduto = (evento) => {
    if (evento.target.parentNode.tagName !== "TR") return;

    prepararOpcaoAlteracaoProduto(evento);

    exibirAvisoEscolhaAtualizacaoDelecao(botaoEscondido, avisoEscolhaAtualizacaoDelecao)
}

const ocultarAvisoEscolhaAtualizacaoDelecaoProduto = () => {
    ocultarAvisoEscolhaAtualizacaoDelecao(linhasTabela, avisoEscolhaAtualizacaoDelecao)
}

window.onload = () => {
    for (let linhaTabela of linhasTabela) {
        linhaTabela.addEventListener("click", exibirAvisoEscolhaAtualizacaoDelecaoProduto);
        linhaTabela.addEventListener("click", indicarSelecaoElementoTabelaProduto)
    }

    verificarMensagensSecao();
}

botaoPesquisa.addEventListener("click", validarPesquisaProduto);
botaoAtualizar.addEventListener("click", atualizarPaginaProduto);
botaoFecharAviso.addEventListener("click", ocultarAvisoEscolhaAtualizacaoDelecaoProduto);
