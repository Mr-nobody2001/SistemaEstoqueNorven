@section('titulo', 'Cadastrar Fornecedor')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/criacaoGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'category'" :titulo="'Cadastrar Fornecedor'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('fornecedor.store') }}" method="POST"
          enctype="multipart/form-data" novalidate>
        @csrf
        <div id="container-botao-salvar">
            <button type="submit" id="botao-salvar" class="btn">Salvar</button>
        </div>

        <div>
            <label for="nome_fornecedor" class="form-label">Nome do fornecedor</label>
            <input type="text" id="nome_fornecedor" class="form-control" name="nome_fornecedor"
                   value="" maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
            <span class="mt-1 campo-invalido">
                @error('nome_fornecedor')
                Este fornecedor já existe no banco de dados e não pode ser inserido novamente.
                @enderror
            </span>
        </div>
    </form>
</x-layouts.estrutura-basica>

