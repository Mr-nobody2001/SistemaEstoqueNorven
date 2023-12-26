import {validarPesquisa} from "../../validacao/validacaoPesquisa.js";
import {atualizarPagina} from "../../service/indexCRUD.js";
import {verificarMensagensSecao} from "../../avisos/toast.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");

const validarPesquisaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    validarPesquisa(evento, valorPesquisa);
}

const atualizarPaginaProduto = () => {
    atualizarPagina();
}

window.onload = () => {
    verificarMensagensSecao();
}

botaoPesquisa.addEventListener("click", validarPesquisaProduto);
botaoAtualizar.addEventListener("click", atualizarPaginaProduto);
