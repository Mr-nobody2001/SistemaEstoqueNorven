<div class="d-none aviso animate__animated" id="{{ $idAviso }}" role="alert" aria-live="assertive" aria-atomic="true">
    <button type="button" class="btn-close me-2 mb-3 m-auto" id="botao-fechar-aviso" data-bs-dismiss="toast" aria-label="Close"></button>
    <div class="toast-body">
        {{ $textoAviso }}
        <div class="mt-2 pt-2 border-top" id="opcoes">
            <a type="button" class="btn btn-sm" id="botao-opcao1">{{ $opcao1 }}</a>
            <a type="button" class="btn btn-sm" id="botao-opcao2">{{ $opcao2 }}</a>
        </div>
    </div>
</div>
