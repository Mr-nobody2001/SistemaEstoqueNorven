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

    <form class="needs-validation" id="container-formulario" action="" method="POST"
          novalidate>
        @csrf
        <div id="container-botao-atualizar-deletar">
            <button class="btn" type="submit" id="botao-atualizar">Atualizar</button>
            <button class="btn" id="botao-deletar">Deletar</button>
        </div>

        <div>
            <label for="nome_categoria" class="form-label">Nome da categoria</label>
            <input type="text" class="form-control" name="nome_categoria" maxlength="50" id="nome_categoria"
                   value="{{ $categoriaProduto->nome_categoria }}"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required
                   data-validadorequest>
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>

        <div>
            <label for="descricao" class="form-label">Descrição da categoria</label>
            <textarea class="form-control" name="descricao_categoria" id="descricao"
                      rows="3">{{ $categoriaProduto->descricao_categoria }}</textarea>
            <div class="invalid-feedback">
                Por favor, forneça uma descrição válida.
            </div>
        </div>

        <div id="container-file" class="input-group">
            <input type="file" id="foto_categoria" class="form-control" name="imagem_categoria"
                   accept="image/jpeg, image/jpg" max="2048000" required>
            <div class="invalid-feedback">
                Por favor, forneça uma foto válida.
            </div>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <form class="d-none" id="formulario-delecao"
          action="{{ route('categoria.destroy', ['categorium' => $categoriaProduto]) }}"
          method="POST">
        @method('DELETE')
        @csrf

        <button id="botao-deletar-formulario" type="submit"></button>
    </form>
</x-layouts.estrutura-basica>

