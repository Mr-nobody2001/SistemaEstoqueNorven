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

    <form id="container-formulario" class="needs-validation" action="{{ route('marca.update',
        ['marca' => $marcaProduto]) }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div id="container-botao-atualizar-deletar">
            <button type="submit" id="botao-atualizar" class="btn">Atualizar</button>
            <button id="botao-deletar" class="btn">Deletar</button>
        </div>

        <div>
            <div>
                <input type="hidden" name="id" value="{{ old('id') ?? $marcaProduto->id }}">
            </div>
            <label for="nome_marca" class="form-label">Nome da marca</label>
            <input type="text" id="nome_marca" class="form-control" name="nome_marca"
                   value="{{ old('nome_marca') ?? $marcaProduto->nome_marca }}"
                   maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <form id="formulario-delecao" class="d-none" action="{{ route('marca.destroy', ['marca' => $marcaProduto->id]) }}"
          method="POST">
        @method('DELETE')
        @csrf

        <button type="submit" id="botao-deletar-formulario"></button>
    </form>
</x-layouts.estrutura-basica>
