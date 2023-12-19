export const exibirToast = (mensagem, tipoAlerta) => {
    let corToast = null;

    switch (tipoAlerta) {
        case "sucesso":
            corToast = "#C8E584";
            break;
        case "alerta":
            corToast = "#FBE286";
            break;
        case "erro":
            corToast = "#FE4847";
            break;
    }

    Toastify({
        text: mensagem,
        duration: 1000 * 10,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: `linear-gradient(to right, ${corToast}, ${corToast})`,
        },
    }).showToast();
}

export const verificarMensagensSecao = () => {
    const avisoSecao = document.querySelector(".aviso-secao")

    if (avisoSecao) exibirToast(avisoSecao.dataset.mensagem, avisoSecao.dataset.tipo);
}
