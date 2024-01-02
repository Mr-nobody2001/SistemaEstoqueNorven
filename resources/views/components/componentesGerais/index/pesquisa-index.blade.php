<div id="container-pesquisa">
    <form action="{{ $rota }}" method="GET">
        <div id="container-barra-pesquisa">
            <input type="text" id="barra-pesquisa" class="form-control" name="{{ $nome }}"
                   VALUE="{{ $pesquisa ?? '' }}" placeholder="{{ $placeholder }}" required>
            <button type="submit" id="botao-pesquisa" class="btn">Pesquisar</button>
        </div>
    </form>
</div>
