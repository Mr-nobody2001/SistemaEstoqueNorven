@section('titulo', 'Cadastrar Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/componentesGerais/informacoes-pagina.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/marcaProduto/criacaoMarcaProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-componentesGerais.informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Cadastrar Marca'"/>

    <form class="needs-validation" id="container-formulario" action="{{ route('marca.store') }}" method="POST" novalidate>
        @csrf
        <div>
            <div>
                <button class="btn" type="submit" id="botao-salvar">Salvar</button>
            </div>

            <label for="nome_marca" class="form-label">Nome da marca</label>
            <input type="text" class="form-control" name="nome_marca" maxlength="50" id="nome_marca" required
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ\-]*$">
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>
    </form>
</x-layouts.estrutura-basica>
