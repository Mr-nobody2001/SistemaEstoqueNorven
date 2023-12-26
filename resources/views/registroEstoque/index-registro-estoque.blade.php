@section('titulo', 'Registros')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/indexCrudGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro?'"
                            :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Registro'"
                            :opcao2="'Deletar Registro'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'inventory'" :titulo="'Registros'"/>
        <x-componentesGerais.index.opcoes-index :entidadeRota="'registro'"/>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <x-componentesGerais.index.pesquisa-index :entidade="'registro'" :nome="'nome_registro'" :pesquisa="$valorPesquisa"/>

    {{-- Tabela de registros --}}
    {{--<table class="tabela alinhar-centro" data-entidade="produto">
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
    </table>--}}
</x-layouts.estrutura-basica>
