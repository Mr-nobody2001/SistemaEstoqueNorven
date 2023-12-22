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
        <div id="container-botao-atualizar-deletar">
            <button type="submit" id="botao-atualizar" class="btn">Atualizar</button>
            <button id="botao-deletar" class="btn">Deletar</button>
        </div>

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
                       value="{{ number_format($loteProduto->preco_custo, 2, '.', ',') ??
                       number_format(old('preco_custo'), 2, '.', ',') }}" maxlength="9"
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

        <div class="input-group d-flex flex-row w-100">
            <select id="select-fornecedor-id" class="form-select w-25" aria-label="fornecedor" name="fornecedor_id"
                    required>
                <option data-texto="null" selected>Informe o fornecedor desse lote</option>
                @foreach($listaTodosFornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" data-texto="{{ $fornecedor->nome_fornecedor }}" @selected($loteProduto->fornecedor_id ?? old('fornecedor_id') ==
                    $fornecedor->id )>{{ $fornecedor->nome_fornecedor }}
                    </option>
                @endforeach
            </select>

            <input type="text" id="filtro-fornecedor-id" class="form-control"
                   placeholder="Pesquise pelo nome de um fornecedor."
                   aria-label="Recipient's username">
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <form id="formulario-delecao" class="d-none" action="{{ route('lote.destroy', ['lote' => $loteProduto]) }}"
          method="POST">
        @method('DELETE')
        @csrf

        <button type="submit" id="botao-deletar-formulario"></button>
    </form>
</x-layouts.estrutura-basica>
