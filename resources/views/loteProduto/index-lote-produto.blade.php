@section('titulo', 'Lotes')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/avisos/aviso-escolha.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/indexCrudGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-avisos.aviso-escolha :textoAviso="'Você deseja fazer alguma alteração nesse registro de Lote?'"
                            :idAviso="'escolha-atualizacao-delecao'" :opcao1="'Atualizar Lote'"
                            :opcao2="'Deletar Lote'"/>

    {{-- Inclui as informações da página e as opções de adicionar e de refresh --}}
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'barcode'" :titulo="'Lotes'"/>
        <x-componentesGerais.index.opcoes-index :entidadeRota="'lote'"/>
    </div>


    {{-- Inclui tudo relacionado a pesquisa como a barra de pesquisa e o botão de pesquisa --}}
    <x-componentesGerais.index.pesquisa-index :entidade="'lote'"  :nome="'numero_lote'" :pesquisa="$valorPesquisa"/>

    {{-- Tabela de registros --}}
    <table class="tabela alinhar-centro" data-entidade="lote">
        <thead>
        <tr class="titulo-tabela-destaque">
            <th>Id</th>
            <th>Número do Lote</th>
            <th>Data de Validade</th>
            <th>Preço de Custo</th>
            <th>Nome do Fornecedor</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($paginaLoteProduto as $loteProduto)
            @php
                $dataValidadeFormatada = new DateTime($loteProduto->data_validade);
                $dataValidadeFormatada = $dataValidadeFormatada->format('d/m/Y');
            @endphp

            <tr data-id="{{ $loteProduto->id }}">
                <td>{{ $loteProduto->id }}</td>
                <td>{{ $loteProduto->numero_lote }}</td>
                <td>{{ $dataValidadeFormatada }}</td>
                <td>{{ 'R$ ' . number_format($loteProduto->preco_custo, 2, ',', '.') }}</td>
                <td>{{ $loteProduto->fornecedor->nome_fornecedor }}</td>
            </tr>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
