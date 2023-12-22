import {filtrarOpcoesSelect} from "../../service/alteracaoDelecao.js";

const filtroFornecedorId = document.querySelector("#filtro-fornecedor-id")
const selectFornecedorId = document.querySelector("#select-fornecedor-id");

const filtrarOpcoesFornecedorSelect = () => {
    const valorPesquisa = filtroFornecedorId.value.toLowerCase();

    filtrarOpcoesSelect(selectFornecedorId, valorPesquisa);
}



filtroFornecedorId.addEventListener("input", filtrarOpcoesFornecedorSelect);
