@section('titulo', 'Cadastrar Lote')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/criacaoGeral.js') }}"></script>
    <script type="module" src="{{ asset('js/especifico/lote/criacaoAtualizacaoLoteProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'barcode'" :titulo="'Cadastrar Lote'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('lote.store') }}" method="POST"
          novalidate>
        @csrf
        <div id="container-botao-salvar">
            <button type="submit" id="botao-salvar" class="btn">Salvar</button>
        </div>

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
        $dataAtual->modify('+1 day')
        @endphp

        <div>
            <label for="data_validade" class="form-label">Data de validade do lote</label>
            <input type="date" id="data-validade" class="form-control" name="data_validade"
                   value="{{ old('data_validade') }}" min="{{ $dataAtual->format('Y-m-d') }}" required>
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
            <div class="d-flex flex-row input-group">
                <span class="input-group-text">$</span>
                <span class="input-group-text">0.00</span>
                <input type="text" id="preco-custo" class="form-control rounded-end" name="preco_custo"
                       placeholder="Informe o valor de custo associado a este lote do produto."
                       value="{{ old('preco_custo') }}" maxlength="9"
                       pattern="^(?!0+(\.0{1,2})?$)\d{0,8}(\.\d{1,2})?$" required>
                <div class="invalid-feedback">
                    O custo não pode ser nulo e deve conter apenas caracteres numéricos e ".".
                </div>
            </div>

            <span class="mt-1 campo-invalido">
                @error('preco_custo')
                 O custo fornecido não está no formato adequado.
                @enderror
            </span>
        </div>

       {{--<div>
            <div class="d-flex flex-row input-group">
                <span class="input-group-text">$</span>
                <span class="input-group-text">0.00</span>
                <input type="text" id="preco-venda" class="form-control rounded-end" name="preco_venda"
                       placeholder="Informe o valor de venda associado a este lote do produto."
                       value="{{ old('preco_venda') }}" maxlength="9"
                       pattern="^(?!0+(\.0{1,2})?$)\d{0,8}(\.\d{1,2})?$" required>
                <div class="invalid-feedback">
                    O valor de venda não pode ser nulo e deve conter apenas caracteres numéricos e ".".
                </div>
            </div>

            <span class="mt-1 campo-invalido">
                @error('preco_venda')
                 O valor de venda fornecido não está no formato adequado.
                @enderror
            </span>
        </div>--}}

        <div class="input-group d-flex flex-row w-100">
            <select id="select-fornecedor-id" class="form-select w-25" aria-label="fornecedor" name="fornecedor_id"
                    required>
                <option data-texto="null" selected>Informe o fornecedor desse lote</option>
                @foreach($listaTodosFornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" data-texto="{{ $fornecedor->nome_fornecedor }}" @selected(old('fornecedor_id') ==
                    $fornecedor->id )>{{ $fornecedor->nome_fornecedor }}
                    </option>
                @endforeach
            </select>

            <input type="text" id="filtro-fornecedor-id" class="form-control"
                   placeholder="Pesquise pelo nome de um fornecedor."
                   aria-label="Recipient's username">
        </div>
    </form>
</x-layouts.estrutura-basica>
