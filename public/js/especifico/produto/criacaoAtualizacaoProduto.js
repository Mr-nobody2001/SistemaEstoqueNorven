import {filtrarOpcoesSelect} from "../../service/alteracaoDelecao.js";
import {validarSelect} from "../../validacao/validacaoPesquisa.js";

const filtroCategoriaId = document.querySelector("#filtro-categoria-id");
const selectCategoriaId = document.querySelector("#select-categoria-id");
const avisoCategoriaId = document.querySelector("#aviso-categoria-id");
const selectMarcaId = document.querySelector("#select-marca-id");
const filtroMarcaId = document.querySelector("#filtro-marca-id");
const avisoMarcaId = document.querySelector("#aviso-marca-id");
const unidadeMedida = document.querySelector("#unidade-medida");
const avisoUnidadeMedida = document.querySelector("#aviso-unidade-medida");
const containerFormulario = document.querySelector("#container-formulario");

const filtrarOpcoesCategoriaSelect = () => {
    const valorPesquisa = filtroCategoriaId.value.toLowerCase();

    filtrarOpcoesSelect(selectCategoriaId, valorPesquisa);
}

const filtrarOpcoesMarcaSelect = () => {
    const valorPesquisa = filtroMarcaId.value.toLowerCase();

    filtrarOpcoesSelect(selectMarcaId, valorPesquisa);
}

const validarSelectsProduto = () => {
    validarSelect(unidadeMedida, avisoUnidadeMedida);
    unidadeMedida.addEventListener("change", () => {
        unidadeMedida.classList.remove("border-danger");
        unidadeMedida.classList.add("border-success");
        avisoUnidadeMedida.classList.add("d-none");
    });

    validarSelect(selectCategoriaId, avisoCategoriaId, filtroCategoriaId);
    selectCategoriaId.addEventListener("change", () => {
        selectCategoriaId.classList.remove("border-danger");
        selectCategoriaId.classList.add("border-success");
        filtroCategoriaId.classList.remove("border-danger");
        filtroCategoriaId.classList.add("border-success");
        avisoCategoriaId.classList.add("d-none");
    });

    validarSelect(selectMarcaId, avisoMarcaId, filtroMarcaId);
    selectMarcaId.addEventListener("change", () => {
        selectMarcaId.classList.remove("border-danger");
        selectMarcaId.classList.add("border-success");
        filtroMarcaId.classList.remove("border-danger");
        filtroMarcaId.classList.add("border-success");
        avisoMarcaId.classList.add("d-none");
    });
}

filtroCategoriaId.addEventListener("input", filtrarOpcoesCategoriaSelect);
filtroMarcaId.addEventListener("input", filtrarOpcoesMarcaSelect);
containerFormulario.addEventListener("submit", validarSelectsProduto);
