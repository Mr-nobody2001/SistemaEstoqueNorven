import {validacaoBootstrap} from "../validacao/validacaoPesquisa.js";
import {verificarMensagensSecao} from "../avisos/toast.js";

window.onload = () => {
    validacaoBootstrap();
    verificarMensagensSecao();
}
