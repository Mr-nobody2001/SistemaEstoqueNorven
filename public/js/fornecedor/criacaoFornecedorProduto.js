const containerInputCpf = document.querySelector("#container-input-cpf");
const inputCpf = document.querySelector("#container-input-cpf > input");
const containerInputCpnj = document.querySelector("#container-input-cnpj");
const inputCnpj = document.querySelector("#container-input-cnpj > input");
const tipoFornecedor = document.querySelector("#tipo_fornecedor");

const exibirContainerInput = (evento) => {
    if (evento.target.checked) {
        containerInputCpnj.classList.add("d-none");
        containerInputCpf.classList.remove("d-none");
        inputCpf.required = true;
        inputCnpj.required = false;
        inputCnpj.value = "";
    } else {
        containerInputCpnj.classList.remove("d-none");
        containerInputCpf.classList.add("d-none");
        inputCpf.required = false;
        inputCnpj.required = true;
        inputCpf.value = "";
    }
}

tipoFornecedor.addEventListener("click", exibirContainerInput);
