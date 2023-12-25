<form id="formulario-delecao" class="d-none" action="{{ route("$entidadeRota.destroy", [$entidade => $objeto]) }}"
      method="POST">
    @method('DELETE')
    @csrf

    <button type="submit" id="botao-deletar-formulario"></button>
</form>
