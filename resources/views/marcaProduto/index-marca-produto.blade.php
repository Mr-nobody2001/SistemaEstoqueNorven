@section('titulo', 'Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/marcaProduto/index-marca-produto.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/marcaProduto/marcaProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <section id="secao-principal">
        <div id="container-informacoes-pagina">
            <span class="material-symbols-outlined">branding_watermark</span>
            <h1>
                Marcas
            </h1>
            <i class="bi bi-info-circle"></i>
        </div>

        <div id="container-formulario">
            <form action="{{ route('marca.index') }}" method="GET">
                <div>
                    <label for="text" class="visually-hidden">Marca</label>
                    <input type="text" class="form-control" id="barra-pesquisa" name="marca"
                           placeholder="Pesquise por uma marca.">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mb-3" id="botao-pesquisa">Pesquisar</button>
                </div>
            </form>
            <i class="bi bi-arrow-clockwise"></i>
        </div>

        <table id="container-tabela-marca">
            <thead class="tabela">
            <tr class="destaque">
                <th>Id</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($paginaMarcaProduto as $marcaProduto)
                <tr>
                    <td>{{ $marcaProduto->id }}</td>
                    <td>{{ $marcaProduto->nome_marca }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</x-layouts.estrutura-basica>
