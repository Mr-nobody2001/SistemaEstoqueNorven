@php use App\Enums\TipoTransacao; @endphp
@section('titulo', 'Atualizar Registro')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/atualizacaoDelecao.js') }}"></script>
    <script type="module"
            src="{{ asset('js/especifico/registroEstoque/criacaoAtualizacaoRegistroEstoque.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'inventory'" :titulo="'Atualizar Registro'"/>

    <form id="container-formulario" class="needs-validation"
          action="{{ route('registro.update', ['registro' => $registroEstoque ?? old('id')]) }}" method="POST"
          novalidate>
        @method('PUT')
        @csrf
        <x-componentesGerais.atualizacao.opcoes-atualizacao/>

        <div class="d-none">
            <input type="hidden" name="id" value="{{ $registroEstoque->id ?? old('id') }}">
        </div>

        @php
            $produtoIdPreenchimento = $registroEstoque->produto_id ?? old('produto_id');
        @endphp

        <div>
            <div class="input-group d-flex flex-row w-100">
                <select id="select-produto-id" class="form-select w-25" aria-label="select-produto-id"
                        name="produto_id" required>
                    <option data-texto="null" value="" disabled selected>Informe o produto desse registro</option>
                    @foreach($listaTodosProdutos as $produto)
                        <option value="{{ $produto->id }}" data-texto="{{ $produto->nome_produto }}" @selected($produtoIdPreenchimento ==
                    $produto->id )>{{ $produto->nome_produto }}
                        </option>
                    @endforeach
                </select>

                <input type="text" id="filtro-produto-id" class="form-control"
                       placeholder="Pesquise pelo nome de um produto.">
            </div>

            <span id="aviso-produto-id" class="d-none campo-invalido">
                A presença do produto é obrigatória.
            </span>

            <span class="mt-1 campo-invalido">
                @error('produto_id')
                 A presença do produto é obrigatória.
                @enderror
            </span>
        </div>

        @php
            $loteIdPreenchimento = $registroEstoque->lote_id ?? old('lote_id');
        @endphp

        <div>
            <div class="input-group d-flex flex-row w-100">
                <select id="select-lote-id" class="form-select w-25" aria-label="select-lote-id"
                        name="lote_id" required>
                    <option data-texto="null" value="" disabled selected>Informe o lote desse registro</option>
                    @foreach($listaTodosLotes as $lote)
                        <option value="{{ $lote->id }}" data-texto="{{ $lote->numero_lote }}" @selected($loteIdPreenchimento ==
                        $lote->id )>{{ $lote->numero_lote }}
                        </option>
                    @endforeach
                </select>

                <input type="text" id="filtro-lote-id" class="form-control"
                       placeholder="Pesquise pelo número de um lote.">
            </div>

            <span id="aviso-lote-id" class="d-none campo-invalido">
                A presença do lote é obrigatória.
            </span>

            <span class="mt-1 campo-invalido">
                @error('lote_id')
                 A presença do lote é obrigatória.
                @enderror
            </span>
        </div>

        @php
            $tipoTransacaoPreenchimento = $registroEstoque->tipo_transacao ?? old('tipo_transacao');
        @endphp

        <div>
            <div>
                <select id="select-tipo-transacao" class="form-select" aria-label="select-tipo-transacao"
                        name="tipo_transacao"
                        required>
                    <option value="" disabled selected>Selecione qual é o tipo da transação</option>
                    @foreach(TipoTransacao::getConstants() as $tipoTransacao)
                        <option value="{{ $tipoTransacao }}" @selected($tipoTransacaoPreenchimento == $tipoTransacao)>
                            {{ $tipoTransacao }}</option>
                    @endforeach
                </select>
            </div>

            <span id="aviso-tipo-transacao" class="d-none campo-invalido">
                A presença do tipo de transação é obrigatória.
            </span>

            <span class="mt-1 campo-invalido">
                @error('tipo_transacao')
                A presença do tipo de transação é obrigatória.
                @enderror
            </span>
        </div>

        <div>
            <label for="quantidade-transacao" class="form-label">Insira a quantidade do produto quer será
                transacionado</label>
            <input type="number" id="quantidade-transacao" class="form-control" name="quantidade_transacao"
                   value="{{ $registroEstoque->quantidade_transacao ?? old('quantidade_transacao') }}" min="1" required>
            <div class="invalid-feedback">
                A quantidade da transação não pode ser negativa e nem maior a quantidade do produto do lote em estoque.
            </div>
            <span class="mt-1 campo-invalido">
                @error('quantidade_transacao')
                A quantidade da transação não pode ser negativa e nem maior a quantidade do produto do lote em estoque.
                @enderror
            </span>
        </div>

        @php
            $contemBaixa = $registroEstoque->tipo_transacao === 'baixa' ||  old('tipo_transacao') === 'baixa';
        @endphp

        <div>
            <label for="valor-transacao" class="form-label">Insira o preço de venda do produto quer será
                transacionado</label>
            <div class="d-flex flex-row input-group">
                <span class="input-group-text">$</span>
                <span class="input-group-text">0.00</span>
                <input type="text" id="valor-transacao" class="form-control rounded-end" name="valor_transacao"
                       placeholder="Informe o valor de venda associado a este registro de produto."
                       value="{{ number_format($registroEstoque->valor_transacao, 2) ??
                        number_format(old('valor_transacao'), 2) ?? "0.00" }}" maxlength="9"
                       pattern="^\d{0,8}(\.\d{2})$" @disabled($contemBaixa)>
                <div class="invalid-feedback">
                    O valor de venda não pode ser nulo e deve conter apenas caracteres numéricos e ".".
                </div>
            </div>

            <span class="mt-1 campo-invalido">
            @error('valor_transacao')
            O valor de venda fornecido não está no formato adequado.
            @enderror
            </span>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <x-componentesGerais.atualizacao.formulario-delecao :entidadeRota="'registro'" :entidade="'registro'"
                                                        :objeto="$registroEstoque"/>
</x-layouts.estrutura-basica>
