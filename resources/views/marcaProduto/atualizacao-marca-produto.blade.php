@section('titulo', 'Atualizar Marca')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/atualizacaoDelecao.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'copyright'" :titulo="'Atualizar Marca'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('marca.update',
        ['marca' => $marcaProduto ?? old('id')]) }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <x-componentesGerais.atualizacao.opcoes-atualizacao/>

        <div class="d-none">
            <input type="hidden" name="id" value="{{ $marcaProduto->id ?? old('id') }}">
        </div>

        <div>
            <label for="nome_marca" class="form-label">Nome da marca</label>
            <input type="text" id="nome_marca" class="form-control" name="nome_marca"
                   value="{{ $marcaProduto->nome_marca ?? old('nome_marca') }}"
                   maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
            <span class="mt-1 campo-invalido">
                @error('nome_marca')
                 O nome fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <x-componentesGerais.atualizacao.formulario-delecao :entidadeRota="'marca'" :entidade="'marca'" :objeto="$marcaProduto"/>
</x-layouts.estrutura-basica>
