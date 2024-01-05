<?php

namespace App\Console\Commands;

use App\Models\LoteProduto;
use App\Models\Produto;
use App\Models\RegistroEstoque;
use App\services\RegistroEstoqueService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class VerificarProdutos extends Command
{
    public function __construct(private readonly RegistroEstoqueService $registroEstoqueService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verificar-produtos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $listaProdutos = Produto::all();

        $this->indicarProdutoEstoqueBaixo($listaProdutos);

        $listaRegistroEstoque = RegistroEstoque::all();

        $this->indicarProdutoVencido($listaRegistroEstoque);

        $horarioAtual = Carbon::now();

        $this->info("O comando app:verificar-produtos foi executado com sucesso ($horarioAtual).");
    }

    private function indicarProdutoEstoqueBaixo(Collection $listaProdutos): void
    {
        foreach ($listaProdutos as $produto) {
            $quantiedadeProduto = $this->registroEstoqueService->calcularQuantidadeEstoqueProdutoId($produto->id);

            $produto->quantidade_baixa = $quantiedadeProduto < 100;

            $produto->save();
        }
    }

    private function indicarProdutoVencido(Collection $listaRegistroEstoque): void
    {
        foreach ($listaRegistroEstoque as $registroEstoque) {
            $this->indicarLoteFinalizado($registroEstoque);

            if (!$registroEstoque->lote->lote_finalizado) {
                $dataAtual = Carbon::now('America/Sao_Paulo');

                $dataValidade = $registroEstoque->lote->data_validade;

                if (!is_null($dataValidade)) {
                    $dataValidade = Carbon::createFromFormat('Y-m-d', $registroEstoque->lote->data_validade);
                }

                if ($dataAtual->greaterThan($dataValidade)) {
                    $registroEstoque->lote->lote_vencido = true;

                    $registroEstoque->lote->save();
                }
            }
        }
    }

    private function indicarLoteFinalizado(RegistroEstoque $registroEstoque): void
    {
        if ($this->registroEstoqueService->verificarLoteFinalizado($registroEstoque->lote->id)) {
            $registroEstoque->lote->lote_finalizado = true;

            $registroEstoque->lote->save();
        }
    }
}
