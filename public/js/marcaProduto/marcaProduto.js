import {validarPesquisa} from "../validacao/validacaoPesquisa.js";

const barraPesquisa = document.querySelector("#barra-pesquisa");
const botaoPesquisa = document.querySelector("#botao-pesquisa");
const botaoAtualizar = document.querySelector(".bi-arrow-clockwise");

const validarPesquisaMarcaProduto = (evento) => {
    const valorPesquisa = barraPesquisa.value;

    validarPesquisa(evento, valorPesquisa);
}

const atualizarPagina = () => {
    // Cria um formulário dinamicamente
    const formulario = document.createElement('form');
    formulario.method = "GET";
    formulario.action = "http://localhost:8000/marca";

    // Adiciona campos ao formulário
    const input = document.createElement('input');
    input.type = "text";
    input.name = "marca";
    input.value = " ";
    formulario.appendChild(input);

    formulario.style.display = "none";
    document.body.appendChild(formulario);

    // Submete o formulário
    formulario.submit();
}

botaoPesquisa.addEventListener("click", validarPesquisaMarcaProduto);
botaoAtualizar.addEventListener("click", atualizarPagina);

