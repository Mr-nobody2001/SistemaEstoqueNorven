import {exibirToast} from "../avisos/toast.js";

const forms = document.querySelectorAll('.needs-validation');
export const validarPesquisa = (evento, valorPesquisa) => {
    // alfanumérica, permitindo espaços e exigindo que tenha pelo menos três caracteres
    const regex = /^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$/;

    if (!regex.test(valorPesquisa) || !valorPesquisa) {
        evento.preventDefault();

        exibirToast("A string não é alfanumérica ou não atende aos requisitos.", "erro");
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
