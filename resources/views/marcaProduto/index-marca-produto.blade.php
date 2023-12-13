@section('titulo', 'Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/marcaProduto/index-marca-produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/marcaProduto/lista-marca.css') }}">
@endsection

<x-layouts.estrutura-basica>
    <section id="secao-principal">
        <div>
            <span class="material-symbols-outlined">branding_watermark</span>
            <h1>
                Marcas
            </h1>
            <i class="bi bi-info-circle"></i>
        </div>

        <form class="row g-3" action="{{ route('marca.index') }}" method="GET">
            <div class="col-6">
                <label for="text" class="visually-hidden">Marca</label>
                <input type="text" class="form-control" id="barra-pesquisa" name="marca"
                    placeholder="Realize uma pesquisa por uma marca.">
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
            </div>
        </form>

        <div id="container-lista-marca">
            <div class="destaque">
                <p>
                    Id
                </p>
    
                <p>
                    Nome
                </p>
            </div>
    
            <x-layouts.marcaProduto.lista-marca>
                @foreach ($paginaMarcaProduto as $marcaProduto)
                    <x-marcaProduto.item-lista-marca :idMarca="$marcaProduto->id" :nomeMarca="$marcaProduto->nome_marca" />
                @endforeach
            </x-layouts.marcaProduto.lista-marca>
        </div>
    </section>
</x-layouts.estrutura-basica>
