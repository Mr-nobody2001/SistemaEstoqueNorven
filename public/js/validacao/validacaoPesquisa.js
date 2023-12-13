const aviso = document.querySelector("#avisos")
export const validarPesquisa = (evento, valorPesquisa) => {
    // alfanumérica, permitindo espaços e exigindo que tenha pelo menos três caracteres
    const regex = /^(?=.*[a-zA-Z0-9])[\w\s]{3,}$/;

    if (!regex.test(valorPesquisa)) {
        evento.preventDefault();
        alert("A string não é alfanumérica ou não atende aos requisitos.");
    }
}
