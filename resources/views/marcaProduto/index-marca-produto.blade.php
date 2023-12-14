@section('titulo', 'Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estiloGeral/index-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/estiloGeral/index-estiloGeral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/informacoes-pagina.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/marcaProduto/indexMarcaProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Marcas'"/>

    <div id="container-pesquisa">
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
        <a href="{{ route('marca.create') }}"><i class="bi bi-plus-square"></i></a>
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
</x-layouts.estrutura-basica>
