@section('titulo', 'Atualizar Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/estilo-estilosGerais-marca-produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/componentesGerais/informacoes-pagina.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/marcaProduto/criacaoMarcaProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-componentesGerais.informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Atualizar Marca'"/>

    <form class="needs-validation" id="container-formulario" action="{{ route('marca.store') }}" method="POST"
          novalidate>
        @csrf
        <div>
            <div>
                <button class="btn" type="submit" id="botao-atualizar">Atualizar</button>
            </div>

            <label for="validationCustom01" class="form-label">Nome da marca</label>
            <input type="text" class="form-control" value="{{ $marcaProduto->nome_marca }}" name="nome_marca"
                   maxlength="50" id="validationCustom01" required
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ\-]*$">
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>
    </form>
</x-layouts.estrutura-basica>
