import {validarPesquisa} from "../validacao/validacaoPesquisa.js";
import {atualizarPagina, indicarSelecaoElementoTabela} from "../scriptGeral/indexCRUD.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");
const linhasTabelaMarca = document.querySelectorAll("tbody tr");

const validarPesquisaMarcaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    validarPesquisa(evento, valorPesquisa);
}

const atualizarPaginaMarcaProduto = () => {
    atualizarPagina();
}

const indicarSelecaoElementoTabelaMarca = (evento) => {
    const linhaTabelaMarcaSelecionada = evento.target.parentNode;

    indicarSelecaoElementoTabela(linhasTabelaMarca, linhaTabelaMarcaSelecionada)
}


for (let linhaTabelaMarca of linhasTabelaMarca) {
    linhaTabelaMarca.addEventListener("click", indicarSelecaoElementoTabelaMarca)
}

botaoPesquisa.addEventListener("click", validarPesquisaMarcaProduto);
botaoAtualizar.addEventListener("click", atualizarPaginaMarcaProduto);
