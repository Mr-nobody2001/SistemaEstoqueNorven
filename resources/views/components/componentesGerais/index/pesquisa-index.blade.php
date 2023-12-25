<div id="container-pesquisa">
    <form action="{{ route("$entidade.index") }}" method="GET">
        <div id="container-barra-pesquisa">
            <input type="text" id="barra-pesquisa" class="form-control" name="{{ $nome }}"
                   VALUE="{{ $pesquisa ?? '' }}" placeholder="Pesquise pelo nome de um {{ $entidade }}." required>
            <button type="submit" id="botao-pesquisa" class="btn">Pesquisar</button>
        </div>
    </form>
</div>
