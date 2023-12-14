<div class="d-none aviso" id="{{ $idAviso }}" role="alert" aria-live="assertive" aria-atomic="true">
    <button type="button" class="btn-close me-2 mb-3 m-auto" id="botao-fechar-aviso" data-bs-dismiss="toast" aria-label="Close"></button>
    <div class="toast-body">
        {{ $textoAviso }}
        <div class="mt-2 pt-2 border-top" id="opcoes-confirmacao">
            <button type="button" class="btn btn-sm">{{ $opcao1 }}</button>
            <button type="button" class="btn btn-sm">{{ $opcao2 }}</button>
        </div>
    </div>
</div>
