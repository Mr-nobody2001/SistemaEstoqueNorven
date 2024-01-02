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
    <div id="container-pesquisa">
        <form class="d-flex flex-column" action="{{ route('registro.index') }}" method="GET">
            <label for="barra-pesquisa" class="form-label">Pesquise pela data de cadastro do registro.</label>
            <div id="container-barra-pesquisa">
                <input type="date" id="barra-pesquisa" class="form-control" name="data_registro"
                       VALUE="{{ $valorPesquisa ?? '' }}" required>
                <button type="submit" id="botao-pesquisa" class="btn">Pesquisar</button>
            </div>
        </form>
    </div>

    {{-- Tabela de registros --}}
    <table class="tabela alinhar-centro" data-entidade="registro">
        <thead>
        <tr class="titulo-tabela-destaque">
            <th>Id</th>
            <th>Lote Produto</th>
            <th>Nome Produto</th>
            <th>Tipo da Transação</th>
            <th>Quantidade Transacionada</th>
            <th>Preço de Venda do Produto</th>
            <th>Data de Registro</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($paginaRegistro as $registro)
            @php
                $dataRegistro = new DateTime($registro->data_registro);
                $dataRegistro = $dataRegistro->format('d/m/Y H:i:s')
            @endphp

            <tr data-id="{{ $registro->id }}">
                <td>{{ $registro->id }}</td>
                <td>{{ $registro->lote->numero_lote }}</td>
                <td>{{ $registro->produto->nome_produto }}</td>
                <td>{{ $registro->tipo_transacao }}</td>
                <td>{{ $registro->quantidade_transacao }}</td>
                <td>{{ 'R$ ' . number_format($registro->preco_venda , 2, ',', '.') }}</td>
                <td>{{ $dataRegistro }}</td>
            </tr>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
        </tbody>
    </table>
</x-layouts.estrutura-basica>
