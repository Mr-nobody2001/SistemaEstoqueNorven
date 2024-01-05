@php use Carbon\Carbon;use Illuminate\Support\Facades\Storage; @endphp

@section('titulo', 'Página Inicial - Detalhes do Produto')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/inicio/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio/inicio-detalhe-produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/index-geral.css') }}">
@endsection

@section('script')
@endsection

<x-layouts.estrutura-basica>
    <x-componentesGerais.informacoes-pagina :textoIcone="'home'"
                                            :titulo="'Página Inicial - Detalhes do Produto'"/>

    <div class="container-detalhes-produto d-flex flex-column">
        <h2 class="titulo-destaque align-self-center">Informaçẽos gerais do produto</h2>

        <div class="d-flex align-items-center justify-content-center border">
            <div class="ms-3 me-3">
                <img src="{{ Storage::disk('public')->url($produto->caminho_imagem) }}" height="400px" alt="">
            </div>

            @php
                $dataCriacaoProdutoFormatada = new DateTime($produto->data_cadastro);
                $dataCriacaoProdutoFormatada = $dataCriacaoProdutoFormatada->format('d/m/Y H:i:s')
            @endphp

            <div class="w-100">
                <table class="tabela alinhar-centro w-100">
                    <tbody>
                    <tr>
                        <th>Informação Produto</th>
                        <th>Valor</th>
                    </tr>
                    <tr>
                        <th>Id</th>
                        <td>{{ $produto->id }}</td>
                    </tr>
                    <tr>
                        <th>Código</th>
                        <td>{{ $produto->codigo_produto }}</td>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <td>{{ $produto->nome_produto }}</td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td>{{ $produto->descricao_produto }}</td>
                    </tr>
                    <tr>
                        <th>Categoria</th>
                        <td>{{ $produto->categoria->nome_categoria }}</td>
                    </tr>
                    <tr>
                        <th>Marca</th>
                        <td>{{ $produto->marca->nome_marca }}</td>
                    </tr>
                    <tr>
                        <th>Unidade de Medida</th>
                        <td>{{ $produto->unidade_medida }}</td>
                    </tr>
                    <tr>
                        <th>Data de Cadastro</th>
                        <td>{{ $dataCriacaoProdutoFormatada }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @php
            $informacoesNutricionais = json_decode($produto->informacoes_nutricionais, 512, JSON_THROW_ON_ERROR);
        @endphp

        <h2 class="titulo-destaque align-self-center">Informações nutricionais</h2>

        <div class="d-flex flex-column">
            <table class="tabela alinhar-centro">
                <tbody>
                <tr>
                    <th>Informação</th>
                    <td>Porção</td>
                    <td>Calorias</td>
                    <td>Carboidratos</td>
                    <td>Proteínas</td>
                    <td>Gorduras Totais</td>
                    <td>Sódio</td>
                </tr>
                <tr>
                    <th>Valor</th>
                    <td>{{ number_format($informacoesNutricionais['quantidade_porcao'], 1, ',', '.') }}
                        {{ $informacoesNutricionais['unidade_medida_porcao'] }}</td>
                    <td>{{ number_format($informacoesNutricionais['quantidade_energia'], 1, ',', '.') }}
                        {{ $informacoesNutricionais['unidade_medida_energia'] }}</td>
                    <td>{{ number_format($informacoesNutricionais['quantidade_acucar'], 1, ',', '.') }}
                        {{ $informacoesNutricionais['unidade_medida_acucar'] }}</td>
                    <td>{{ number_format($informacoesNutricionais['quantidade_proteina'], 1, ',', '.') }}
                        {{ $informacoesNutricionais['unidade_medida_proteina'] }}</td>
                    <td>{{ number_format($informacoesNutricionais['quantidade_gordura'], 1, ',', '.') }}
                        {{ $informacoesNutricionais['unidade_medida_gordura'] }}</td>
                    <td>{{ number_format($informacoesNutricionais['quantidade_sodio'], 1, ',', '.') }}
                        {{ $informacoesNutricionais['unidade_medida_sodio'] }}</td>
                </tr>

                @php
                    $quantidadeEnergiaDouble = (double) number_format($informacoesNutricionais['quantidade_energia'], 1, ',', '.');
                    $valorDiarioEnergia = $informacoesNutricionais['unidade_medida_energia'] === 'Kcal' ?
                    $quantidadeEnergiaDouble / 2000 :
                    $quantidadeEnergiaDouble / 8400;
                    $valorDiarioEnergia *= 100;
                @endphp

                <tr>
                    <th>Percentagem diária</th>
                    <td>%VD*</td>
                    <td>{{ number_format($valorDiarioEnergia, 1, ',', '.') . ' %' }}</td>
                </tr>
                </tbody>
            </table>

            @php
                $contemAlergenos = (bool) $informacoesNutricionais['alergenos'];
            @endphp

            <p @class(["mt-3", 'd-none' => !$contemAlergenos])>Este produto pode incluir os seguintes alérgenos: {{ implode(', ',
            $informacoesNutricionais['alergenos']) }}</p>
        </div>

        <h2 class="titulo-destaque align-self-center">Histórico de Compras do Produto</h2>

        <div class="container-historico-lote w-100">
            <table class="tabela alinhar-centro w-100">
                <thead>
                <tr class="titulo-tabela-destaque">
                    <th>Id</th>
                    <th>Lote Produto</th>
                    <th>Nome Produto</th>
                    <th>Tipo da Transação</th>
                    <th>Quantidade Transacionada</th>
                    <th>Preço de Compra/Venda</th>
                    <th>Data de Registro</th>
                    <th>Data de Validade do Lote</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($listaRegistroEstoqueCompra as $registro)
                    @php
                        $dataValidadeFormatada = $registro->lote->data_validade;

                       if (!is_null($dataValidadeFormatada)) {
                           $dataValidadeFormatada = new DateTime($registro->lote->data_validade);
                           $dataValidadeFormatada = $dataValidadeFormatada->format('d/m/Y');
                       }

                       // Formata a data de registro
                       $dataRegistro = new DateTime($registro->data_registro);
                       $dataRegistro = $dataRegistro->format('d/m/Y H:i:s');

                       // Define se o lote está finalizado
                       $loteFinalizado = $registro->lote->lote_finalizado;

                       // Define se o lote está vencido
                       $loteVencido = $registro->lote->lote_vencido;

                       if ($registro->lote->lote_finalizado && $registro->lote->lote_vencido) {
                           $loteVencido = false;
                       }
                    @endphp

                    <tr @class(['lote-finalizado' => $loteFinalizado, 'produto-vencido' =>
                        $loteVencido]) data-id="{{ $registro->id }}">
                        <td>{{ $registro->id }}</td>
                        <td>{{ $registro->lote->numero_lote }}</td>
                        <td>{{ $registro->produto->nome_produto }}</td>
                        <td>{{ $registro->tipo_transacao }}</td>
                        <td>{{ $registro->quantidade_transacao }}</td>
                        <td>{{ 'R$ ' . number_format($registro->valor_transacao , 2, ',', '.') }}</td>
                        <td>{{ $dataRegistro }}</td>
                        <td>{{ $dataValidadeFormatada ?? 'Não perecível' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Nenhum registro foi encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <h2 class="titulo-destaque align-self-center">Histórico de Vendas do Produto</h2>

        <div class="container-historico-lote w-100">
            <table class="tabela alinhar-centro w-100">
                <thead>
                <tr class="titulo-tabela-destaque">
                    <th>Id</th>
                    <th>Lote Produto</th>
                    <th>Nome Produto</th>
                    <th>Tipo da Transação</th>
                    <th>Quantidade Transacionada</th>
                    <th>Preço de Compra/Venda</th>
                    <th>Data de Registro</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($listaRegistroEstoqueVenda as $registro)
                    @php
                        $dataRegistro = new DateTime($registro->data_registro);
                        $dataRegistro = $dataRegistro->format('d/m/Y H:i:s');
                    @endphp

                    <tr data-id="{{ $registro->id }}">
                        <td>{{ $registro->id }}</td>
                        <td>{{ $registro->lote->numero_lote }}</td>
                        <td>{{ $registro->produto->nome_produto }}</td>
                        <td>{{ $registro->tipo_transacao }}</td>
                        <td>{{ $registro->quantidade_transacao }}</td>
                        <td>{{ 'R$ ' . number_format($registro->preco_venda , 2, ',', '.') }}</td>
                        <td>{{ $dataRegistro }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Nenhum registro foi encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <table class="tabela alinhar-centro w-100">
            <thead>
            <tr class="titulo-tabela-destaque">
                <th>Quantidade em Estoque</th>
                <th>Ticket Médio (mês atual)</th>
                <th>Volume vendas (mês atual comparado ao mês anterior)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @php
                    $quantidadeInvalida = $quantidadeEstoque < 100;

                    if ($volumeVendas == 0) {
                        $volumeAumentou = $volumeDiminuiu = true;
                    } else {
                        $volumeAumentou = $volumeVendas > 0;
                        $volumeDiminuiu = $volumeVendas <= 0;
                    }
                @endphp

                <td @class(['quantidade-baixa' => $quantidadeInvalida])>{{ $quantidadeEstoque . ' Unidade(s)' }}</td>
                <td>{{ 'R$ ' . number_format($ticketMedio, 2, ',', '.') }}</td>
                <td>
                    {{ number_format($volumeVendas, 0, ',', '.') }} Unidade(s)

                    <i @class(['bi', 'bi-arrow-up', 'positivo','d-none' => $volumeDiminuiu])></i>
                    <i @class(['bi', 'bi-arrow-down', 'negativo','d-none' => $volumeAumentou])></i>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-layouts.estrutura-basica>
