@section('titulo', 'Atualizar Categoria')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/atualizacaoDelecao.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'category'" :titulo="'Atualização Categoria'"/>

    <form id="container-formulario" class="needs-validation"
          action="{{ route('categoria.update', ['categorium' => old('id') ?? $categoriaProduto]) }}" method="POST"
          enctype="multipart/form-data" novalidate>
        @method('PUT')
        @csrf
        <x-componentesGerais.atualizacao.opcoes-atualizacao/>

        <div class="d-none">
            <input type="hidden" name="id" value="{{ old('id') ?? $categoriaProduto->id }}">
        </div>

        <div>
            <label for="nome_categoria" class="form-label">Nome da categoria</label>
            <input type="text" id="nome_categoria" class="form-control" name="nome_categoria"
                   value="{{ old('nome_categoria') ?? $categoriaProduto->nome_categoria }}" maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
            <span class="mt-1 campo-invalido">
                @error('nome_categoria')
                O nome fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        <div>
            <label for="descricao_categoria" class="form-label">Descrição da categoria</label>
            <textarea id="descricao_categoria" class="form-control" name="descricao_categoria"
                      rows="3" required>{{ old('descricao_categoria')  ?? $categoriaProduto->descricao_categoria }}</textarea>
            <div class="invalid-feedback">
                Por favor, forneça uma descrição válida.
            </div>
            <span class="mt-1 campo-invalido">
                @error('descricao_categoria')
                Por favor, forneça uma descrição válida.
                @enderror
            </span>
        </div>

        <div>
            <label for="imagem_categoria" class="form-label">Insira a imagem da categoria</label>
            <div id="container-file" class="input-group">
                <input type="file" id="imagem_categoria" class="form-control" name="imagem_categoria"
                       accept="image/jpeg, image/jpg" max="2048000">
                <div class="invalid-feedback">
                    Por favor, forneça uma foto válida.
                </div>
            </div>
            <span class="mt-1 campo-invalido">
                @error('imagem_produto')
                Por favor, forneça uma foto válida.
                @enderror
            </span>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <x-componentesGerais.atualizacao.formulario-delecao :entidadeRota="'categoria'" :entidade="'categorium'" :objeto="$categoriaProduto"/>
</x-layouts.estrutura-basica>

