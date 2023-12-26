@php use Illuminate\Support\Facades\Storage; @endphp

@section('titulo', 'Página Inicial')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/especifico/inicio/inicio.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <div id="topo-secao-principal">
        <x-componentesGerais.informacoes-pagina :textoIcone="'home'" :titulo="'Página Inicial'"/>
        <div>
            <i class="bi bi-arrow-clockwise"></i>
        </div>
    </div>

    <x-componentesGerais.index.pesquisa-index :rota="route('inicio')" :nome="'nome_categoria'"
                                              :placeholder="'Pesquise pelo nome da categoria.'" :pesquisa="''"/>

    <div id="grid-container">
        @forelse($paginaCategoriaProduto as $categoriaProduto)
            <div class="card" style="width: 18rem;">
                <img src={{ Storage::url($categoriaProduto->caminho_imagem) }} class="card-img-top" width="150px"
                     height="150px" alt={{ $categoriaProduto->nome_categoria }}>
                <div class="card-body">
                    <h5 class="card-title">{{ $categoriaProduto->nome_categoria }}</h5>
                    <p class="card-text">{{ $categoriaProduto->descricao_categoria }}</p>
                    <a href="#" class="btn btn-dark">Ir para {{ $categoriaProduto->nome_categoria }}</a>
                </div>
            </div>
        @empty
            <p class="aviso-secao d-none" data-mensagem="Nenhum registro foi encontrado" data-tipo="alerta"></p>
        @endforelse
    </div>
</x-layouts.estrutura-basica>
