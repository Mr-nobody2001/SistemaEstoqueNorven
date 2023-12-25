@section('titulo', 'Produtos')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/indexCrudGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro de Produto?'"
                            :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Produto'"
                            :opcao2="'Deletar Produto'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'inventory_2'" :titulo="'Produtos'"/>
        <div>
            <a href="{{ route('produto.create') }}"><i class="bi bi-plus-square"></i></a>
            <i class="bi bi-arrow-clockwise"></i>
        </div>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <div id="container-pesquisa">
        <form action="{{ route('produto.index') }}" method="GET">
            <div id="container-barra-pesquisa">
                <input type="text" id="barra-pesquisa" class="form-control" name="nome_produto"
                       VALUE="{{ $valorPesquisa ?? '' }}" placeholder="Pesquise pelo nome de um produto." required>
                <button type="submit" id="botao-pesquisa" class="btn">Pesquisar</button>
            </div>
        </form>
    </div>

    {{-- Tabela de registros --}}
    <table class="tabela alinhar-centro" data-entidade="produto">
        <thead>
        <tr class="titulo-tabela-destaque">
            <th>Id</th>
            <th>Código</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Data de Cadastro</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($paginaProduto as $produto)
            @php
                $dataCriacaoProdutoFormatada = new DateTime($produto->data_cadastro);
                $dataCriacaoProdutoFormatada = $dataCriacaoProdutoFormatada->format('d/m/Y H:i:s')
            @endphp

            <tr data-id="{{ $produto->id }}">
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->codigo_produto }}</td>
                <td>{{ $produto->nome_produto }}</td>
                <td>{{ substr($produto->descricao_produto, 0, 30) . '...' }}</td>
                <td>{{ $produto->categoria->nome_categoria }}</td>
                <td>{{ $produto->marca->nome_marca }}</td>
                <td>{{ $dataCriacaoProdutoFormatada }}</td>
            </tr>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
