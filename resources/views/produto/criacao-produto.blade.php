@php use App\Enums\UnidadeMedidaEnergia;use App\Enums\UnidadeMedidaMassa;use App\Enums\UnidadeMedidaVolume;use App\Enums\UnidadeMedidaQuantidade; @endphp
@section('titulo', 'Cadastrar Produto')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/criacaoGeral.js') }}"></script>
    <script type="module" src="{{ asset('js/especifico/produto/criacaoAtualizacaoProduto.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'inventory_2'" :titulo="'Cadastrar Produto'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('produto.store') }}" method="POST"
          enctype="multipart/form-data" novalidate>
        @csrf
        <x-componentesGerais.criacao.opcao-salvar/>

        <fieldset>
            <legend class="titulo-destaque">Informaçẽos gerais do produto</legend>

            <div>
                <label for="codigo-produto" class="form-label">Código do produto</label>
                <input type="text" id="codigo-produto" class="form-control" name="codigo_produto"
                       value="{{ old('codigo_produto') ?? '' }}"
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
                       value="{{ old('nome_produto') ?? '' }}" maxlength="50"
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
                          rows="3">{{ old('descricao_produto') ?? '' }}</textarea>
                <div class="invalid-feedback">
                    Por favor, forneça uma descrição válida.
                </div>
                <span class="mt-1 campo-invalido">
                @error('descricao_produto')
                Por favor, forneça uma descrição válida.
                @enderror
            </span>
            </div>

            <div>
                <select id="unidade-medida" class="form-select" aria-label="unidade-medida" name="unidade_medida"
                        required>
                    <option value="" disabled selected>Selecione a unidade de medida para o produto</option>
                    @foreach(UnidadeMedidaQuantidade::getConstants() as $unidadeMedida)
                        <option value="{{ $unidadeMedida }}" @selected(old('unidade_medida') ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                    @endforeach
                    @foreach(UnidadeMedidaMassa::getConstants() as $unidadeMedida)
                        <option value="{{ $unidadeMedida }}" @selected(old('unidade_medida') ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                    @endforeach
                    @foreach(UnidadeMedidaVolume::getConstants() as $unidadeMedida)
                        <option value="{{ $unidadeMedida }}" @selected(old('unidade_medida') ==
                        $unidadeMedida)>{{ $unidadeMedida }}</option>
                    @endforeach
                </select>

                <span id="aviso-unidade-medida" class="d-none campo-invalido">
                    A presença da unidade de medida é obrigatória.
                </span>

                <span class="mt-1 campo-invalido">
                @error('unidade_medida')
                A presença da unidade de medida é obrigatória.
                @enderror
                </span>
            </div>

            <div>
                <div class="input-group d-flex flex-row w-100">
                    <select id="select-categoria-id" class="form-select w-25" aria-label="select-categoria-id"
                            name="categoria_id" required>
                        <option data-texto="null" value="" disabled selected>Informe a categoria desse produto</option>
                        @foreach($listaTodasCategorias as $categoria)
                            <option value="{{ $categoria->id }}" data-texto="{{ $categoria->nome_categoria }}" @selected(old('categoria_id') ==
                            $categoria->id )>{{ $categoria->nome_categoria }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" id="filtro-categoria-id" class="form-control"
                           placeholder="Pesquise pelo nome de uma categoria.">
                </div>

                <span id="aviso-categoria-id" class="d-none campo-invalido">
                 A presença da categoria é obrigatória.
                </span>

                <span class="mt-1 campo-invalido">
                @error('categoria_id')
                 A presença da categoria é obrigatória.
                @enderror
                </span>
            </div>

            <div>
                <div class="input-group d-flex flex-row w-100">
                    <select id="select-marca-id" class="form-select w-25" aria-label="select-marca-id"
                            name="marca_id" required>
                        <option data-texto="null" value="" disabled selected>Informe a marca desse produto</option>
                        @foreach($listaTodasMarcas as $marca)
                            <option value="{{ $marca->id }}" data-texto="{{ $marca->nome_marca }}" @selected(old('marca_id') ==
                            $marca->id )>{{ $marca->nome_marca }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" id="filtro-marca-id" class="form-control"
                           placeholder="Pesquise pelo nome de uma marca.">
                </div>

                <span id="aviso-marca-id" class="d-none campo-invalido">
                    A presença da marca é obrigatória.
                </span>

                <span class="mt-1 campo-invalido">
                @error('marca_id')
                 A presença da marca é obrigatória.
                @enderror
                </span>
            </div>

            <div>
                <label for="imagem_produto" class="form-label">Insira a imagem do produto</label>
                <div id="container-file" class="input-group">
                    <input type="file" id="imagem_produto" class="form-control" name="imagem_produto"
                           accept="image/jpeg, image/jpg" max="2048000" required>
                    <div class="invalid-feedback">
                        Por favor, forneça uma foto válida.
                    </div>
                </div>

                <span class="mt-1 campo-invalido">
                    @error('imagem_produto')
                    Por favor, forneça uma foto válida.
                    @enderror
                </span>
            </div>
        </fieldset>

        <fieldset>
            <legend class="titulo-destaque">Informações nutricionais do produto</legend>

            <div class="d-flex flex-column w-100">
                <label for="quantidade-porcao" class="form-label">Informe o tamanho da porção</label>

                @php
                    $unidadeMedidaPorcaoPreenchimento = old('unidade_medida_porcao') ?? UnidadeMedidaMassa::GRAMA;
                @endphp

                <div class="input-group d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-porcao" class="form-control w-25" name="quantidade_porcao"
                           value="{{ old('quantidade_porcao') ?? '0.0' }}" maxlength="9"
                           pattern="^\d{0,8}(\.\d{1})?$" required>
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
                $unidadeMedidaEnergiaPreenchimento = old('unidade_medida_energia') ?? UnidadeMedidaEnergia::QUILOCALORIA;
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-energia" class="form-label">Informe a quantidade de energia da porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-energia" class="form-control w-25" name="quantidade_energia"
                           value="{{ old('quantidade_energia') ?? '0.0' }}" maxlength="9"
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
                $unidadeMedidaProteinaPreenchimento = old('unidade_medida_proteina') ?? UnidadeMedidaMassa::GRAMA;
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-proteina" class="form-label">Informe a quantidade de proteína da porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-proteina" class="form-control w-25" name="quantidade_proteina"
                           value="{{ old('quantidade_proteina') ?? '0.0' }}" maxlength="9"
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
                $unidadeMedidaGorduraPreenchimento = old('unidade_medida_gordura') ?? UnidadeMedidaMassa::GRAMA;
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-gordura" class="form-label">Informe a quantidade de gorduras totais da
                    porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-gordura" class="form-control w-25" name="quantidade_gordura"
                           value="{{ old('quantidade_gordura') ?? '0.0' }}" maxlength="9"
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
                $unidadeMedidaAcucarPreenchimento = old('unidade_medida_acucar') ?? UnidadeMedidaMassa::GRAMA;
            @endphp

            <div class="d-flex flex-column">
                <label for="quantidade-acucar" class="form-label">Informe a quantidade de açucares da
                    porção</label>

                <div class="input-group  d-flex flex-row align-items-center w-100">
                    <input type="text" id="quantidade-acucar" class="form-control w-25" name="quantidade_acucar"
                           value="{{ old('quantidade_acucar') ?? '0.0' }}" maxlength="9"
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
                $unidadeMedidaSodioPreenchimento = old('unidade_medida_sodio') ?? UnidadeMedidaMassa::MILIGRAMA;
            @endphp

            <div class="d-flex flex-column w-100">
                <label for="quantidade-sodio" class="form-label">Informe a quantidade de sódio da
                    porção</label>

                <div class="input-group  d-flex flex-row align-items-center">
                    <input type="text" id="quantidade-sodio" class="form-control w-25" name="quantidade_sodio"
                           maxlength="9"
                           value="{{ old('quantidade_sodio') ?? '0.0' }}"
                           pattern="^\d{0,8}(\.\d{1})?$" required>
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
        </fieldset>

        <fieldset>
            <legend class="titulo-destaque">Alérgenos</legend>
            <div>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="leite" name="leite"
                               value="leite" @checked(old('leite'))>
                        <label class="form-check-label" for="leite">Leite</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ovos" name="ovos"
                               value="ovos" @checked(old('ovos'))>
                        <label class="form-check-label" for="ovos">Ovos</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="amendoim" name="amendoim"
                               value="amendoim" @checked(old('amendoim'))>
                        <label class="form-check-label" for="amendoim">Amendoim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nozes" name="nozes"
                               value="nozes" @checked(old('nozes'))>
                        <label class="form-check-label" for="nozes">Nozes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="trigo" name="trigo"
                               value="trigo" @checked(old('trigo'))>
                        <label class="form-check-label" for="trigo">Trigo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="soja" name="soja"
                               value="soja" @checked(old('soja'))>
                        <label class="form-check-label" for="soja">Soja</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="mostarda" name="mostarda"
                               value="mostarda" @checked(old('mostarda'))>
                        <label class="form-check-label" for="mostarda">Mostarda</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="sulfitos" name="sulfitos"
                               value="sulfitos" @checked(old('sulfitos'))>
                        <label class="form-check-label" for="sulfitos">Sulfitos</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="sementes_gergelim"
                               name="sementes_gergelim"
                               value="sementes_gergelim" @checked(old('sementes_gergelim'))>
                        <label class="form-check-label" for="sementes_gergelim">Sementes de Gergelim</label>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</x-layouts.estrutura-basica>

