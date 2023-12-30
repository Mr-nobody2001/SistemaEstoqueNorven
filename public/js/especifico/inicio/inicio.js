import {validarPesquisaTexto} from "../../validacao/validacaoPesquisa.js";
import {atualizarPagina} from "../../service/indexCRUD.js";
import {verificarMensagensSecao} from "../../avisos/toast.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");
const gridContainer = document.querySelector("#grid-container");

const validarPesquisaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    validarPesquisaTexto(evento, valorPesquisa);
}

const atualizarPaginaProduto = () => {
    const entidade = gridContainer.dataset.url;

    atualizarPagina(entidade);
}

window.onload = () => {
    verificarMensagensSecao();
}

botaoPesquisa.addEventListener("click", validarPesquisaProduto);
botaoAtualizar.addEventListener("click", atualizarPaginaProduto);
