import {exibirAviso, ocultarAviso} from "../avisos/aviso.js";
import {escolherAlteracao} from "../avisos/avisoEscolha.js";
import {exibirToast} from "../avisos/toast.js";

export const atualizarPagina = () => {
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

export const limparSelecaoTabela = (linhasTabela) => {
    for (let linhaTabela of linhasTabela)
        if (linhaTabela.classList.contains("linha-selecionada")) linhaTabela.classList.remove("linha-selecionada");
}

export const indicarSelecaoElementoTabela = (linhasTabela, linhaTabelaSelecionada) => {
    limparSelecaoTabela(linhasTabela);

    if (!linhaTabelaSelecionada.classList.contains("linha-selecionada")) linhaTabelaSelecionada.classList.add("linha-selecionada");
}

export const ocultarAvisoEscolhaAtualizacaoDelecao = (linhasTabelaMarca, avisoEscolhaAtualizacaoDelecao) => {
    limparSelecaoTabela(linhasTabelaMarca)

    ocultarAviso(avisoEscolhaAtualizacaoDelecao)
}
export const prepararOpcaoAlteracao = (entidade, id, botaoAlterar) => {
    const url = `http://127.0.0.1:8000/${entidade}/${id}/edit`;

    escolherAlteracao(url, botaoAlterar);
}

export const exibirAvisoEscolhaAtualizacaoDelecao = (evento, botaoEscondido, botaoAlterar, avisoEscolhaAtualizacaoDelecao) => {
    const id = evento.target.parentNode.dataset.id;

    botaoEscondido.classList.add("d-none");
    botaoEscondido.classList.add("d-none");

    prepararOpcaoAlteracao("marca", id, botaoAlterar);

    exibirAviso(avisoEscolhaAtualizacaoDelecao)
}
