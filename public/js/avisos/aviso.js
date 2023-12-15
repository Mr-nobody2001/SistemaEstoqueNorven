export const exibirAviso = (aviso) => {
    if (!aviso.classList.contains("animate__fadeInUp")) aviso.classList.add("animate__fadeInUp");
    if (aviso.classList.contains("d-none")) aviso.classList.remove("d-none");
}

export const ocultarAviso = (aviso) => {
    if (aviso.classList.contains("animate__fadeInUp")) aviso.classList.remove("animate__fadeInUp");
    if (!aviso.classList.contains("d-none")) aviso.classList.add("d-none");
}
