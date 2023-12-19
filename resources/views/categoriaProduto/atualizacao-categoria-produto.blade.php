@section('titulo', 'Atualizar Categoria')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/atualizacaoDelecao.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'category'" :titulo="'Atualização Categoria'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('categoria.update') }}" method="POST"
          enctype="multipart/form-data" novalidate>
        @method('PUT')
        @csrf
        <div id="container-botao-atualizar-deletar">
            <button type="submit" id="botao-atualizar" class="btn">Atualizar</button>
            <button id="botao-deletar" class="btn">Deletar</button>
        </div>

        <div>
            <label for="nome_categoria" class="form-label">Nome da categoria</label>
            <input type="text" id="nome_categoria" class="form-control" name="nome_categoria"
                   value="" maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
            <span class="mt-1 campo-invalido" data-nomecategoria>
                @error('nome_categoria')
                Esta categoria já existe no banco de dados e não pode ser inserida novamente.
                @enderror
            </span>
        </div>

        <div>
            <label for="descricao_categoria" class="form-label">Descrição da categoria</label>
            <textarea id="descricao_categoria" class="form-control" name="descricao_categoria"
                      rows="3">{{ old('descricao_categoria') ?? '' }}</textarea>
            <div class="invalid-feedback">
                Por favor, forneça uma descrição válida.
            </div>
        </div>

        <div id="container-file" class="input-group">
            <input type="file" id="imagem_categoria" class="form-control" name="imagem_categoria"
                   accept="image/jpeg, image/jpg" max="2048000">
            <div class="invalid-feedback">
                Por favor, forneça uma foto válida.
            </div>
        </div>
    </form>
</x-layouts.estrutura-basica>

