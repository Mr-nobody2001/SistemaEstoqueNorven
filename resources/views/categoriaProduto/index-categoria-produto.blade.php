@section('titulo', 'Categorias')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/componentesGerais/informacoes-pagina.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/indexCrudGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro de Categoria?'"
                            :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Categoria'"
                            :opcao2="'Deletar Categoria'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'category'" :titulo="'Categorias'"/>
        <div>
            <a href="{{ route('categoria.create') }}"><i class="bi bi-plus-square"></i></a>
            <i class="bi bi-arrow-clockwise"></i>
        </div>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <div id="container-pesquisa">
        <form action="{{ route('categoria.index') }}" method="GET">
            <div id="container-barra-pesquisa">
                <input type="text" class="form-control" id="barra-pesquisa" name="nome_categoria"
                       placeholder="Pesquise por uma categoria.">
                <button type="submit" class="btn" id="botao-pesquisa">Pesquisar</button>
            </div>
        </form>
    </div>

    {{-- Tabela de registros --}}
    <table class="tabela" data-entidade="categoria">
        <thead>
        <tr class="titulo-tabela-destaque">
            <th>Id</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Imagem</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($paginaCategoriaProduto as $categoriaProduto)
            <tr data-id="{{ $categoriaProduto->id }}">
                <td>{{ $categoriaProduto->id }}</td>
                <td>{{ $categoriaProduto->nome_categoria }}</td>
                <td>{{ substr($categoriaProduto->descricao_categoria, 0, 30) . ' . . .' }}</td>
                <td>{{ substr($categoriaProduto->caminho_imagem, 0, 25) . ' . . .' }}</td>
            </tr>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
