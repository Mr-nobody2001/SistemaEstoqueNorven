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
