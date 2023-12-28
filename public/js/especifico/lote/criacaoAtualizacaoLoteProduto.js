import {filtrarOpcoesSelect} from "../../service/alteracaoDelecao.js";
import {validarSelect} from "../../validacao/validacaoPesquisa.js";

const filtroFornecedorId = document.querySelector("#filtro-fornecedor-id");
const selectFornecedorId = document.querySelector("#select-fornecedor-id");
const containerFormulario = document.querySelector("#container-formulario");
const avisoFornecedorId = document.querySelector("#aviso-fornecedor-id");

const filtrarOpcoesFornecedorSelect = () => {
    const valorPesquisa = filtroFornecedorId.value.toLowerCase();

    filtrarOpcoesSelect(selectFornecedorId, valorPesquisa);
}

const validarSelectFornecedor = () => {
    validarSelect(selectFornecedorId, avisoFornecedorId, filtroFornecedorId);
    selectFornecedorId.addEventListener("change", () => {
        selectFornecedorId.classList.remove("border-danger");
        selectFornecedorId.classList.add("border-success");
        filtroFornecedorId.classList.remove("border-danger");
        filtroFornecedorId.classList.add("border-success");
        avisoFornecedorId.classList.add("d-none");
    });
}

filtroFornecedorId.addEventListener("input", filtrarOpcoesFornecedorSelect);
containerFormulario.addEventListener("submit", validarSelectFornecedor);
