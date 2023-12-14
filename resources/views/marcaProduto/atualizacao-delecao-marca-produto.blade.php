@section('titulo', 'Cadastrar Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/estilo-estilosGerais-marca-produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/marcaProduto/criacao-atualizacao-delecao-marca-produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/componentesGerais/informacoes-pagina.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/marcaProduto/criacaoMarcaProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Cadastrar Marca'"/>

    <form class="needs-validation" id="container-formulario" action="{{ route('marca.store') }}" method="POST" novalidate>
        @csrf
        <div>
            <div>
                <button class="btn btn-primary" type="submit" id="botao-pesquisa">Salvar</button>
            </div>

            <label for="validationCustom01" class="form-label">Nome da marca</label>
            <input type="text" class="form-control" name="nome_marca" maxlength="50" id="validationCustom01" required
                   pattern="^(?=.*[a-zA-Z0-9])[\w\s]{3,}$">
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>
    </form>
</x-layouts.estrutura-basica>
