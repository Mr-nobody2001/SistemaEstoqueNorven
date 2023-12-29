@php use Illuminate\Support\Facades\Storage; @endphp

@section('titulo', 'Página Inicial - Pesquisa por Produto')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/especifico/inicio/inicio.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'home'"
                                                :titulo="'Página Inicial - Pesquisa por Produto'"/>
        <div>
            <i class="bi bi-arrow-clockwise"></i>
        </div>
    </div>

    <x-componentesGerais.index.pesquisa-index :rota="route('inicio.pesquisa', ['categoriaId' => $categoriaId])" :nome="'nome_produto'"
                                              :placeholder="'Pesquise pelo nome do produto.'" :pesquisa="$valorPesquisa"/>

    <div id="grid-container" data-url="inicio-pesquisa/{{ $categoriaId }}">
        @forelse($paginaProduto as $produto)
            @php
                $dataCriacaoProdutoFormatada = new DateTime($produto->data_cadastro);
                $dataCriacaoProdutoFormatada = $dataCriacaoProdutoFormatada->format('d/m/Y')
            @endphp

            <div class="card animate__animated animate__fadeIn" style="width: 18rem;">
                <img src={{ Storage::url($produto->caminho_imagem) }} class="card-img-top" width="200px"
                     height="200px" alt={{ $produto->nome_produto }}>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Código: {{ $produto->codigo_produto }}</li>
                    <li class="list-group-item">Marca: {{ $produto->marca->nome_marca }}</li>
                    <li class="list-group-item">Data de Cadastro: {{ $dataCriacaoProdutoFormatada }}</li>
                </ul>
                <div class="card-body">
                    <h5 class="card-title">{{ $produto->nome_produto }}</h5>
                    <p class="card-text">{{ $produto->descricao_produto }}</p>
                    <a href="{{ route('inicio.pesquisa', ['categoriaId' => $produto->id]) }}"
                       class="btn btn-dark">Detalhes do Produto</a>
                </div>
            </div>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
    </div>
</x-layouts.estrutura-basica>
