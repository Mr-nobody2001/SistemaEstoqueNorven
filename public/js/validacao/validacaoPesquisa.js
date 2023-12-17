const forms = document.querySelectorAll('.needs-validation');
export const validarPesquisa = (evento, valorPesquisa) => {
    // alfanumérica, permitindo espaços e exigindo que tenha pelo menos três caracteres
    const regex = /^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'-]*$/;

    if (!regex.test(valorPesquisa) || !valorPesquisa) {
        evento.preventDefault();

        Toastify({
            text: "A string não é alfanumérica ou não atende aos requisitos.",
            duration: 1000 * 10,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #FE4847, #FE4847)",
            },
        }).showToast();
    }
}

export const validacaoBootstrap = () => {
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
}
