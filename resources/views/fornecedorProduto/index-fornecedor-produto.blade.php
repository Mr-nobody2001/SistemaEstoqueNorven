@section('titulo', 'Fornecedores')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/componentesGerais/informacoes-pagina.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/indexCrudGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro de Fornecedor?'"
                            :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Fornecedor'"
                            :opcao2="'Deletar Fornecedor'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'local_shipping'" :titulo="'Fornecedores'"/>
        <x-componentesGerais.index.opcoes-index :entidadeRota="'fornecedor'"/>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <x-componentesGerais.index.pesquisa-index :rota="route('fornecedor.index')" :nome="'nome_fornecedor'" :placeholder="'Pesquise pelo nome do fornecedor.'" :pesquisa="$valorPesquisa"/>

    {{-- Tabela de registros --}}
    <table class="tabela" data-entidade="fornecedor">
        <thead>
        <tr class="titulo-tabela-destaque">
            <th>Id</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>CNPJ</th>
            <th>CPF</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($paginaFornecedorProduto as $fornecedorProduto)
            <tr data-id="{{ $fornecedorProduto->id }}">
                <td>{{ $fornecedorProduto->id }}</td>
                <td>{{ $fornecedorProduto->nome_fornecedor }}</td>
                <td>{{ $fornecedorProduto->telefone }}</td>
                <td>{{ $fornecedorProduto->email }}</td>
                <td>{{ $fornecedorProduto->cnpj ?? "..." }}</td>
                <td>{{ $fornecedorProduto->cpf ?? "..." }}</td>
            </tr>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
