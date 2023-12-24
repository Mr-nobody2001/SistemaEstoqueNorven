import {filtrarOpcoesSelect} from "../../service/alteracaoDelecao.js";

const filtroCategoriaId = document.querySelector("#filtro-categoria-id");
const selectCategoriaId = document.querySelector("#select-categoria-id");
const filtroMarcaId = document.querySelector("#filtro-marca-id");
const selectMarcaId = document.querySelector("#select-marca-id");
const filtrarOpcoesCategoriaSelect = () => {
    const valorPesquisa = filtroCategoriaId.value.toLowerCase();

    filtrarOpcoesSelect(selectCategoriaId, valorPesquisa);
}

const filtrarOpcoesMarcaSelect = () => {
    const valorPesquisa = filtroMarcaId.value.toLowerCase();

    filtrarOpcoesSelect(selectMarcaId, valorPesquisa);
}

filtroCategoriaId.addEventListener("input", filtrarOpcoesCategoriaSelect);
filtroMarcaId.addEventListener("input", filtrarOpcoesMarcaSelect);
