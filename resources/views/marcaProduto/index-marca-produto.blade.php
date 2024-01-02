@section('titulo', 'Marcas')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/indexCrudGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro de Marca?'"
                            :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Marca'"
                            :opcao2="'Deletar Marca'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'copyright'" :titulo="'Marcas'"/>
        <x-componentesGerais.index.opcoes-index :entidadeRota="'marca'"/>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <x-componentesGerais.index.pesquisa-index :rota="route('marca.index')" :nome="'nome_marca'" :placeholder="'Pesquise pelo nome da marca.'" :pesquisa="$valorPesquisa"/>

    {{-- Tabela de registros --}}
    <table class="tabela alinhar-centro" data-entidade="marca">
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
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
