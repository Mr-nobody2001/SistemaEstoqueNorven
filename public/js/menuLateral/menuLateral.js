const menuLateral = document.querySelector("#menu-lateral");
const listaMenuLateral = document.querySelector("#lista-menu-lateral");
const listaItemMenu = document.querySelectorAll(".item-menu-lateral");
const iconeHamburguer = document.querySelector("#icone-hamburguer");
let abaAtual;

// Animação do menu lateral
const animarMenu = () => {
    if (menuLateral.dataset.expandido === "true") {
        retrairMenu();
    } else {
        expandirMenu();
    }
}

const retrairMenu = () => {
    menuLateral.classList.remove("expandir-menu-lateral");
    menuLateral.classList.add("retrair-menu-lateral");
    menuLateral.dataset.expandido = "false";
}

const expandirMenu = () => {
    menuLateral.classList.remove("retrair-menu-lateral");
    menuLateral.classList.add("expandir-menu-lateral");
    menuLateral.dataset.expandido = "true";
}

// Animação dos itens do menu lateral
const agitarItemMenu = (e) => {
    if (e.target.classList.contains("animate__pulse")) {
        e.target.classList.remove("animate__pulse");
    }

    e.target.classList.add("animate__pulse");
}

const retirarAnimacao = (e) => {
    e.target.classList.remove("animate__pulse");
}

const estilizarAbaAtual = () => {
    abaAtual.classList.add("aba-atual");
}

const retirarAbaAtual = () => {
    if (!abaAtual) {
        for (let itemMenu of listaItemMenu) {
            if (itemMenu.classList.contains("aba-atual")) {
                itemMenu.classList.remove("aba-atual");
                abaAtual = itemMenu;
            }
        }
    } else {
        abaAtual.classList.remove("aba-atual")
    }
}

listaMenuLateral.addEventListener("mouseleave", estilizarAbaAtual);
listaMenuLateral.addEventListener('mouseover', retirarAbaAtual);
iconeHamburguer.addEventListener("click", animarMenu);

window.onload = () => {
    for (let itemMenu of listaItemMenu) {
        itemMenu.addEventListener("mouseover", agitarItemMenu);
        itemMenu.addEventListener("animationend", retirarAnimacao);
    }
};
