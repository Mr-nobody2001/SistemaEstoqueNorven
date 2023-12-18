@section('titulo', 'Atualizar Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/atualizacaoDelecao.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'branding_watermark'" :titulo="'Atualizar Marca'"/>

    <form class="needs-validation" id="container-formulario"
          action="{{ route('marca.update', ['marca' => $marcaProduto]) }}" method="POST"
          novalidate>
        @method('PUT')
        @csrf
        <div id="container-botao-atualizar-deletar">
            <button class="btn" type="submit" id="botao-atualizar">Atualizar</button>
            <button class="btn" id="botao-deletar">Deletar</button>
        </div>

        <div>
            <div>
                <input type="hidden" name="id" value="{{ $marcaProduto->id }}">
            </div>
            <label for="nome_marca" class="form-label">Nome da marca</label>
            <input type="text" class="form-control" value="{{ $marcaProduto->nome_marca }}" name="nome_marca"
                   maxlength="50" id="nome_marca" required
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$">
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <form class="d-none" id="formulario-delecao" action="{{ route('marca.destroy', ['marca' => $marcaProduto->id]) }}"
          method="POST">
        @method('DELETE')
        @csrf

        <button id="botao-deletar-formulario" type="submit"></button>
    </form>
</x-layouts.estrutura-basica>
