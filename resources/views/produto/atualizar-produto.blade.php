@php use App\Enums\UnidadeMedidaEnergia;use App\Enums\UnidadeMedidaMassa;use App\Enums\UnidadeMedidaVolume;use App\Enums\UnidadeMedidaQuantidade; @endphp
@section('titulo', 'Atualizar Produto')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/atualizacaoDelecao.js') }}"></script>
    <script type="module" src="{{ asset('js/especifico/produto/criacaoAtualizacaoProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'inventory_2'" :titulo="'Atualizar Produto'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('produto.update',
        ['produto' => $produto ?? old('id')]) }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <x-componentesGerais.atualizacao.opcoes-atualizacao/>

        <div class="d-none">
            <input type="hidden" name="id" value="{{ $produto->id ?? old('id') }}">
        </div>

        <fieldset>
            <legend class="titulo-destaque">Informaçẽos gerais do produto</legend>

            <div>
                <label for="codigo-produto" class="form-label">Código do produto</label>
                <input type="text" id="codigo-produto" class="form-control" name="codigo_produto"
                       value="{{ $produto->codigo_produto ?? old('codigo_produto') }}"
                       pattern="^[0-9]+$" required>
                <div class="invalid-feedback">
                    O número do produto não pode ser nulo e deve conter apenas caracteres alfanuméricos.
                </div>
                <span class="mt-1 campo-invalido">
                @error('codigo_produto')
                 O código do produto fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
            </div>

            <div>
                <label for="nome-produto" class="form-label">Nome do produto</label>
                <input type="text" id="nome-produto" class="form-control" name="nome_produto"
                       value="{{ $produto->nome_produto ?? old('nome_produto') }}" maxlength="50"
                       pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
                <div class="invalid-feedback">
                    O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
                </div>
                <span class="mt-1 campo-invalido">
                @error('nome_produto')
                 O nome fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
                </span>
            </div>

            <div>
                <label for="descricao-produto" class="form-label">Descrição do produto</label>
                <textarea id="descricao-produto" class="form-control" name="descricao_produto"
                          rows="3">{{ $produto->descricao_produto ?? old('descricao_produto') }}</textarea>
                <div class="invalid-feedback">
                    Por favor, forneça uma descrição válida.
                </div>
                <span class="mt-1 campo-invalido">
                @error('descricao_produto')
                Por favor, forneça uma descrição válida.
                @enderror
            </span>
            </div>

            @php
                $unidadeMedidaPreenchimento = $produto->unidade_medida ?? old('unidade_medida');
            @endphp

            <div>
                <select class="form-select" aria-label="unidade-medida" name="unidade_medida">
                    <option disabled selected>Selecione a unidade de medida para o produto</option>
                    @foreach(UnidadeMedidaQuantidade::getConstants() as $unidadeMedida)
                        <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                    @endforeach
                    @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                        <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                    @endforeach
                    @foreach(UnidadeMedidaVolume::getConstants() as $unidadeMedida)
                        <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                    @endforeach
                </select>

                <div class="invalid-feedback">
                    A presença da unidade de medida é obrigatória.
                </div>
                <span class="mt-1 campo-invalido">
                @error('unidade_medida')
                A presença da unidade de medida é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $categoriaPreenchimento = $produto->categoria_id ?? old('categoria_id');
            @endphp

            <div>
                <div class="input-group d-flex flex-row w-100">
                    <select id="select-categoria-id" class="form-select w-25" aria-label="select-categoria-id"
                            name="categoria_id" required>
                        <option data-texto="null" disabled selected>Informe a categoria desse produto</option>
                        @foreach($listaTodasCategorias as $categoria)
                            <option value="{{ $categoria->id }}" data-texto="{{ $categoria->nome_categoria }}" @selected($categoriaPreenchimento ==
                            $categoria->id )>{{ $categoria->nome_categoria }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" id="filtro-categoria-id" class="form-control"
                           placeholder="Pesquise pelo nome de uma categoria.">
                </div>

                <span class="mt-1 campo-invalido">
                @error('categoria_id')
                 A presença da categoria é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $marcaPreenchimento = $produto->marca_id ?? old('marca_id');
            @endphp

            <div>
                <div class="input-group d-flex flex-row w-100">
                    <select id="select-marca-id" class="form-select w-25" aria-label="select-marca-id"
                            name="marca_id" required>
                        <option data-texto="null" disabled selected>Informe a marca desse produto</option>
                        @foreach($listaTodasMarcas as $marca)
                            <option value="{{ $marca->id }}" data-texto="{{ $marca->nome_marca }}" @selected($marcaPreenchimento ==
                            $marca->id )>{{ $marca->nome_marca }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" id="filtro-marca-id" class="form-control"
                           placeholder="Pesquise pelo nome de uma marca.">
                </div>

                <span class="mt-1 campo-invalido">
                @error('marca_id')
                 A presença da marca é obrigatória.
                @enderror
                </span>
            </div>
        </fieldset>

        <fieldset>
            <legend class="titulo-destaque">Informações nutricionais do produto</legend>

            @php
                $informacoesNutricionais = json_decode($produto->informacoes_nutricionais, 512, JSON_THROW_ON_ERROR);
                $unidadeMedidaPorcaoPreenchimento = $informacoesNutricionais['unidade_medida_porcao'];
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-porcao" class="form-label">Informe o tamanho da porção</label>

                <div class="input-group d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-porcao" class="form-control w-25" name="quantidade_porcao"
                           value="{{ $informacoesNutricionais['quantidade_porcao'] ?? old('quantidade_porcao') }}" maxlength="9"
                           pattern="^\d{0,8}(\.\d{1})?$">
                    <select class="form-select" aria-label="unidade-medida-porcao" name="unidade_medida_porcao"
                    >
                        <option disabled selected>Selecione a unidade de medida para a porção</option>
                        @foreach(UnidadeMedidaQuantidade::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaPorcaoPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                        @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaPorcaoPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                        @foreach(UnidadeMedidaVolume::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaPorcaoPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mt-1 campo-invalido">
                @error('quantidade_porcao')
                 A presença da quantidade de porção é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $unidadeMedidaEnergiaPreenchimento = $informacoesNutricionais['unidade_medida_energia'] ?? old('unidade_medida_energia');
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-energia" class="form-label">Informe a quantidade de energia da porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-energia" class="form-control w-25" name="quantidade_energia"
                           value="{{ $informacoesNutricionais['quantidade_energia'] ?? old('quantidade_energia') }}" maxlength="9"
                           pattern="^\d{0,8}(\.\d{1})?$" required>
                    <select class="form-select" aria-label="unidade-medida-energia" name="unidade_medida_energia"
                            required>
                        <option disabled selected>Selecione a unidade de medida da quantidade de energia</option>
                        @foreach(UnidadeMedidaEnergia::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaEnergiaPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mt-1 campo-invalido">
                @error('quantidade_energia')
                 A presença da quantidade de energia é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $unidadeMedidaProteinaPreenchimento = $informacoesNutricionais['unidade_medida_proteina'] ?? old('unidade_medida_proteina');
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-proteina" class="form-label">Informe a quantidade de proteína da porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-proteina" class="form-control w-25" name="quantidade_proteina"
                           value="{{ $informacoesNutricionais['quantidade_proteina'] ?? old('quantidade_proteina') }}" maxlength="9"
                           pattern="^\d{0,8}(\.\d{1})?$" required>
                    <select class="form-select" aria-label="unidade-medida-proteina" name="unidade_medida_proteina"
                            required>
                        <option disabled selected>Selecione a unidade de medida da quatidade de proteína</option>
                        @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaProteinaPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mt-1 campo-invalido">
                @error('quantidade_proteina')
                 A presença da quantidade de proteína é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $unidadeMedidaGorduraPreenchimento = $informacoesNutricionais['unidade_medida_gordura'] ?? old('unidade_medida_gordura');
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-gordura" class="form-label">Informe a quantidade de gorduras totais da
                    porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-gordura" class="form-control w-25" name="quantidade_gordura"
                           value="{{ $informacoesNutricionais['quantidade_gordura'] ?? old('quantidade_gordura') }}" maxlength="9"
                           pattern="^\d{0,8}(\.\d{1})?$" required>
                    <select class="form-select" aria-label="unidade-medida-gordura" name="unidade_medida_gordura"
                            required>
                        <option disabled selected>Selecione a unidade de medida da quatidade de gordura</option>
                        @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaGorduraPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mt-1 campo-invalido">
                @error('quantidade_gordura')
                 A presença da quantidade de gorduras totais é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $unidadeMedidaAcucarPreenchimento = $informacoesNutricionais['unidade_medida_acucar'] ?? old('unidade_medida_acucar');
            @endphp

            <div class="d-flex flex-column">
                <label for="quantidade-acucar" class="form-label">Informe a quantidade de açucares da
                    porção</label>

                <div class="input-group  d-flex flex-row align-items-center w-100">
                    <input type="text" id="quantidade-acucar" class="form-control w-25" name="quantidade_acucar"
                           value="{{ $informacoesNutricionais['quantidade_acucar'] ?? old('quantidade_acucar') }}" maxlength="9"
                           pattern="^\d{0,8}(\.\d{1})?$" required>
                    <select class="form-select" aria-label="unidade-medida-acucar" name="unidade_medida_acucar"
                            required>
                        <option disabled selected>Selecione a unidade de medida da quatidade de açucar</option>
                        @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaAcucarPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mt-1 campo-invalido">
                @error('quantidade_acucar')
                A presença da quantidade de açucar é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $unidadeMedidaSodioPreenchimento = $informacoesNutricionais['unidade_medida_sodio'] ?? old('unidade_medida_sodio');
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-sodio" class="form-label">Informe a quantidade de sódio da
                    porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-sodio" class="form-control w-25" name="quantidade_sodio"
                           maxlength="9"
                           value="{{ $informacoesNutricionais['quantidade_sodio'] ?? old('quantidade_sodio') }}"
                           pattern="^\d{0,8}(\.\d{1})?$">
                    <select class="form-select" aria-label="unidade-medida-sodio"
                            name="unidade_medida_sodio">
                        <option disabled selected>Selecione a unidade de medida da quatidade de sódio</option>
                        @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                            <option value="{{ $unidadeMedida }}" @selected($unidadeMedidaSodioPreenchimento ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mt-1 campo-invalido">
                @error('quantidade_sodio')
                A presença da quantidade de sódio é obrigatória.
                @enderror
                </span>
            </div>

            @php
                $alergenos = $informacoesNutricionais['alergenos'];
            @endphp

            <fieldset>
                <legend class="titulo-destaque">Alérgenos</legend>
                <div>
                    <div>

                        @php
                            $temLeite = $alergenos['leite'] ?? old('leite') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="leite" name="leite"
                                   value="leite" @checked($temLeite)>
                            <label class="form-check-label" for="leite">Leite</label>
                        </div>

                        @php
                            $temOvos = $alergenos['ovos'] ?? old('ovos') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="ovos" name="ovos"
                                   value="ovos" @checked($temOvos)>
                            <label class="form-check-label" for="ovos">Ovos</label>
                        </div>

                        @php
                            $temAmendoim = $alergenos['amendoim'] ?? old('amendoim') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="amendoim" name="amendoim"
                                   value="amendoim" @checked($temAmendoim)>
                            <label class="form-check-label" for="amendoim">Amendoim</label>
                        </div>

                        @php
                            $temNozes = $alergenos['nozes'] ?? old('nozes') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="nozes" name="nozes"
                                   value="nozes" @checked($temNozes)>
                            <label class="form-check-label" for="nozes">Nozes</label>
                        </div>

                        @php
                            $temTrigo = $alergenos['trigo'] ?? old('trigo') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="trigo" name="trigo"
                                   value="trigo" @checked($temTrigo)>
                            <label class="form-check-label" for="trigo">Trigo</label>
                        </div>

                        @php
                            $temSoja = $alergenos['soja'] ?? old('soja') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="soja" name="soja"
                                   value="soja" @checked($temSoja)>
                            <label class="form-check-label" for="soja">Soja</label>
                        </div>

                        @php
                            $temMostarda = $alergenos['mostarda'] ?? old('mostarda') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="mostarda" name="mostarda"
                                   value="mostarda" @checked($temMostarda)>
                            <label class="form-check-label" for="mostarda">Mostarda</label>
                        </div>

                        @php
                            $temSulfitos = $alergenos['sulfitos'] ?? old('sulfitos') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="sulfitos" name="sulfitos"
                                   value="sulfitos" @checked($temSulfitos)>
                            <label class="form-check-label" for="sulfitos">Sulfitos</label>
                        </div>

                        @php
                            $temGergelim = $alergenos['sementes_gergelim'] ?? old('sementes_gergelim') ?? '';
                        @endphp

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="sementes_gergelim"
                                   name="sementes_gergelim"
                                   value="sementes_gergelim" @checked($temGergelim)>
                            <label class="form-check-label" for="sementes_gergelim">Sementes de Gergelim</label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </fieldset>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <x-componentesGerais.atualizacao.formulario-delecao :entidadeRota="'produto'" :entidade="'produto'"
                                                        :objeto="$produto"/>
</x-layouts.estrutura-basica>

