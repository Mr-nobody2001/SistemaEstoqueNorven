@section('titulo', 'Marcas')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/componentesGerais/informacoes-pagina.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/indexCRUD.js') }}"></script>
    <script type="module" src="{{ asset('js/marcaProduto/indexMarcaProduto.js') }}"></script>
    <script type="module" src="{{ asset("js/marcaProduto/atualizacaoDelecaoMarcaProduto.js") }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro de Marca?'"
                                :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Marca'"
                                :opcao2="'Deletar Marca'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Marcas'"/>
        <div>
            <a href="{{ route('marca.create') }}"><i class="bi bi-plus-square"></i></a>
            <i class="bi bi-arrow-clockwise"></i>
        </div>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <div id="container-pesquisa">
        <form action="{{ route('marca.index') }}" method="GET">
            <div id="container-barra-pesquisa">
                <input type="text" class="form-control" id="barra-pesquisa" name="nome_marca"
                       placeholder="Pesquise por uma marca.">
                <button type="submit" class="btn" id="botao-pesquisa">Pesquisar</button>
            </div>
        </form>
    </div>

    {{-- Inclui tudo relacionado com a tabela que contém os registros --}}
    <table class="tabela">
        <thead>
        <tr class="titulo-tabela-destaque">
            <th>Id</th>
            <th>Nome</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($paginaMarcaProduto as $marcaProduto)
            <tr data-id="{{ $marcaProduto->id }}">
                <td>{{ $marcaProduto->id }}</td>
                <td>{{ $marcaProduto->nome_marca }}</td>
            </tr>
        @empty

        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
