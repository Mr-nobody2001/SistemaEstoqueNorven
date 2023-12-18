@section('titulo', 'Cadastrar Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/criacaoGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Cadastrar Marca'"/>

    <form class="needs-validation" id="container-formulario" action="{{ route('marca.store') }}" method="POST"
          novalidate>
        @csrf
        <div id="container-botao-salvar">
            <button class="btn" type="submit" id="botao-salvar">Salvar</button>
        </div>

        <div>
            <label for="nome_marca" class="form-label">Nome da marca</label>
            <input type="text" class="form-control" name="nome_marca" maxlength="50" id="nome_marca"
                   value="{{ session('nome_marca') ?? '' }}" required
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$">
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>
    </form>
</x-layouts.estrutura-basica>
