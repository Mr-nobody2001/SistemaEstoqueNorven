@section('titulo', 'Cadastrar Lote')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/criacaoGeral.js') }}"></script>
    <script type="module" src="{{ asset('js/especifico/loteProduto/criacaoAtualizacaoLoteProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'barcode'" :titulo="'Cadastrar Lote'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('lote.store') }}" method="POST"
          novalidate>
        @csrf
        <x-componentesGerais.criacao.opcao-salvar/>

        <div>
            <label for="numero_lote" class="form-label">Número do lote</label>
            <input type="text" id="numero-lote" class="form-control" name="numero_lote"
                   value="{{ old('numero_lote') ?? '' }}"
                   pattern="^[a-zA-Z0-9]+$" required>
            <div class="invalid-feedback">
                O número do lote não pode ser nulo e deve conter apenas caracteres alfanuméricos.
            </div>
            <span class="mt-1 campo-invalido">
                @error('numero_lote')
                 O número do lote fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        @php
            $dataAtual = new DateTime();
            $dataAtual->modify('+1 day');
        @endphp

        <div>
            <label for="data_validade" class="form-label">Data de validade do lote</label>
            <input type="date" id="data-validade" class="form-control" name="data_validade"
                   value="{{ old('data_validade') }}" min="{{ $dataAtual->format('Y-m-d') }}">
            <div class="invalid-feedback">
                A data de validade não pode ser nula.
            </div>
            <span class="mt-1 campo-invalido">
                @error('data_validade')
                 A data de validade não pode ser nula e deve ser posterior ao dia atual.
                @enderror
            </span>
        </div>

        <div>
            <div class="input-group d-flex flex-row w-100">
                <select id="select-fornecedor-id" class="form-select w-25" aria-label="select-fornecedor-id"
                        name="fornecedor_id" required>
                    <option data-texto="null" value="" disabled selected>Informe o fornecedor desse lote</option>
                    @foreach($listaTodosFornecedores as $fornecedor)
                        <option value="{{ $fornecedor->id }}" data-texto="{{ $fornecedor->nome_fornecedor }}" @selected(old('fornecedor_id') ==
                    $fornecedor->id )>{{ $fornecedor->nome_fornecedor }}
                        </option>
                    @endforeach
                </select>

                <input type="text" id="filtro-fornecedor-id" class="form-control"
                       placeholder="Pesquise pelo nome de um fornecedor.">
            </div>

            <span id="aviso-fornecedor-id" class="d-none campo-invalido">
                A presença do fornecedor é obrigatória.
            </span>

            <span class="mt-1 campo-invalido">
                @error('fornecedor_id')
                 A presença do fornecedor é obrigatória.
                @enderror
            </span>
        </div>
    </form>
</x-layouts.estrutura-basica>
