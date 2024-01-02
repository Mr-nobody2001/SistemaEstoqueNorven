export const deletar = (evento, botaoDeletarFormulario) => {
    evento.preventDefault();

    botaoDeletarFormulario.click();
}

export const filtrarOpcoesSelect = (select, valorPesquisa) => {
    for (let opcao of select.children) {
        if (!(opcao.dataset.texto.toLowerCase().includes(valorPesquisa) && opcao.dataset.texto)) {
            opcao.classList.add("d-none");
        } else {
            if (opcao.classList.contains("d-none")) {
                opcao.classList.remove("d-none");
            }
        }
    }
}
