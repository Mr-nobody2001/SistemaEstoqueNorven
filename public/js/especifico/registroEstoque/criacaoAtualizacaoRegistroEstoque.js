import {filtrarOpcoesSelect} from "../../service/alteracaoDelecao.js";
import {validarSelect} from "../../validacao/validacaoPesquisa.js";

const selectProdutoId = document.querySelector("#select-produto-id");
const selectLoteId = document.querySelector("#select-lote-id");
const selectTipoTransacao = document.querySelector("#select-tipo-transacao");
const filtroProdutoId = document.querySelector("#filtro-produto-id");
const filtroLoteId = document.querySelector("#filtro-lote-id");
const avisoProdutoId = document.querySelector("#aviso-produto-id");
const avisoLoteId = document.querySelector("#aviso-lote-id");
const avisoTipoTransacao = document.querySelector("#aviso-tipo-transacao");
const containerFormulario = document.querySelector("#container-formulario");

const filtrarOpcoesProdutoSelect = () => {
    const valorPesquisa = filtroProdutoId.value.toLowerCase();

    filtrarOpcoesSelect(selectProdutoId, valorPesquisa);
}

const filtrarOpcoesLoteSelect = () => {
    const valorPesquisa = filtroLoteId.value.toLowerCase();

    filtrarOpcoesSelect(selectLoteId, valorPesquisa);
}

const validarSelectsRegistroEstoque = () => {
    validarSelect(selectProdutoId, avisoProdutoId, filtroProdutoId);
    selectProdutoId.addEventListener("change", () => {
        selectProdutoId.classList.remove("border-danger");
        selectProdutoId.classList.add("border-success");
        filtroProdutoId.classList.remove("border-danger");
        filtroProdutoId.classList.add("border-success");
        avisoProdutoId.classList.add("d-none");
    });

    validarSelect(selectLoteId, avisoLoteId, filtroLoteId);
    selectLoteId.addEventListener("change", () => {
        selectLoteId.classList.remove("border-danger");
        selectLoteId.classList.add("border-success");
        filtroLoteId.classList.remove("border-danger");
        filtroLoteId.classList.add("border-success");
        avisoLoteId.classList.add("d-none");
    });

    validarSelect(selectTipoTransacao, avisoTipoTransacao);
    selectTipoTransacao.addEventListener("change", () => {
        selectTipoTransacao.classList.remove("border-danger");
        selectTipoTransacao.classList.add("border-success");
        avisoTipoTransacao.classList.add("d-none");
    });
}

filtroProdutoId.addEventListener("input", filtrarOpcoesProdutoSelect);
filtroLoteId.addEventListener("input", filtrarOpcoesLoteSelect);
containerFormulario.addEventListener("submit", validarSelectsRegistroEstoque);
