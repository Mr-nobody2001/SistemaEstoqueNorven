@section('titulo', 'Atualizar Lote')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/atualizacaoDelecao.js') }}"></script>
    <script type="module" src="{{ asset('js/especifico/lote/criacaoAtualizacaoLoteProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'barcode'" :titulo="'Atualizar Lote'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('lote.update',
        ['lote' => $loteProduto ?? old('id')]) }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <x-componentesGerais.atualizacao.opcoes-atualizacao/>

        <div class="d-none">
            <input type="hidden" name="id" value="{{ $loteProduto->id ?? old('id') }}">
        </div>

        <div>
            <label for="numero_lote" class="form-label">Número do lote</label>
            <input type="text" id="numero-lote" class="form-control" name="numero_lote"
                   value="{{ $loteProduto->numero_lote ?? old('numero_lote') }}"
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

        <div>
            <label for="data_validade" class="form-label">Data de validade do lote</label>
            <input type="date" id="data-validade" class="form-control" name="data_validade"
                   value="{{ $loteProduto->data_validade ?? old('data_validade') }}" required>
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
                       value="{{ number_format($loteProduto->preco_custo, 2) ??
                       number_format(old('preco_custo'), 2) }}" maxlength="9"
                       pattern="^(?!0+(\.0{2})$)\d{0,8}(\.\d{2})$" required>
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

        @php
            $fornecedorIdPreenchimento = $loteProduto->fornecedor_id ?? old('fornecedor_id');
        @endphp

        <div>
            <div class="input-group d-flex flex-row w-100">
                <select id="select-fornecedor-id" class="form-select w-25" aria-label="select-fornecedor-id"
                        name="fornecedor_id"
                        required>
                    <option data-texto="null" disabled selected>Informe o fornecedor desse lote</option>
                    @foreach($listaTodosFornecedores as $fornecedor)
                        <option value="{{ $fornecedor->id }}" data-texto="{{ $fornecedor->nome_fornecedor }}" @selected($fornecedorIdPreenchimento ==
                    $fornecedor->id )>{{ $fornecedor->nome_fornecedor }}
                        </option>
                    @endforeach
                </select>

                <span id="aviso-fornecedor-id" class="d-none campo-invalido">
                     A presença do fornecedor é obrigatória.
                </span>

                <input type="text" id="filtro-fornecedor-id" class="form-control"
                       placeholder="Pesquise pelo nome de um fornecedor.">
            </div>

            <span class="mt-1 campo-invalido">
                @error('fornecedor_id')
                 A presença do fornecedor é obrigatória.
                @enderror
            </span>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <x-componentesGerais.atualizacao.formulario-delecao :entidadeRota="'lote'" :entidade="'lote'" :objeto="$loteProduto"/>
</x-layouts.estrutura-basica>
