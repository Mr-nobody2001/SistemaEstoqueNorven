<?php

namespace App\Console\Commands;

use App\Models\LoteProduto;
use App\Models\Produto;
use App\Models\RegistroEstoque;
use App\services\RegistroEstoqueService;
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

        foreach ($listaRegistroEstoque as $registroEstoque) {
            if ($this->registroEstoqueService->verificarEstoqueVendidoTotalmente($registroEstoque->id)) {
                $registroEstoque->lote->totalmente_vendido = true;

                $registroEstoque->lote->save();
            }
        }

        $this->info('O comando app:verificar-produtos foi executado com sucesso.');
    }

    private function indicarProdutoEstoqueBaixo(Collection $listaProdutos): void
    {
        foreach ($listaProdutos as $produto) {
            $quantiedadeProduto = $this->registroEstoqueService->calcularQuantidadeEstoqueProduto($produto->id);

            $produto->quantidade_baixa = $quantiedadeProduto < 100;

            $produto->save();
        }
    }
}
