<?php

namespace App\services;

use App\Http\Requests\registroEstoque\AtualizarRegistroEstoqueRequest;
use App\Http\Requests\registroEstoque\CriarRegistroEstoqueRequest;
use App\Models\RegistroEstoque;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class RegistroEstoqueService
{
    public function listarTodosRegistros(): LengthAwarePaginator
    {
        return RegistroEstoque::orderBy('id')->paginate(20);
    }

    public function encontrarRegistroEstoqueId(string $id): RegistroEstoque
    {
        return RegistroEstoque::where('id', $id)->first();
    }

    public function encontrarRegistroEstoqueDataRegistro(string $dataRegistro): Collection
    {
        return RegistroEstoque::where('data_registro', 'ilike', '%' . $dataRegistro . '%')->get();
    }

    public function encontrarRegistroEstoqueIdProdutoCompra(string $produtoId): LengthAwarePaginator
    {
        return RegistroEstoque::where('produto_id', $produtoId)->where('tipo_transacao', 'compra')->orderBy('id', 'desc')->paginate(20);
    }

    public function encontrarRegistroEstoqueIdProdutoVenda(string $produtoId): LengthAwarePaginator
    {
        return RegistroEstoque::where('produto_id', $produtoId)->where('tipo_transacao', 'venda')->orderBy('id', 'desc')->paginate(20);
    }

    public function calcularTicketMedio(string $produtoId): float
    {
        $dataAtual = Carbon::now();

        $mesPassado = $dataAtual->subDays(30);

        $receitaTotal = RegistroEstoque::where('produto_id', $produtoId)->where('tipo_transacao', 'venda')
            ->where('data_registro', '>=', $mesPassado)
            ->selectRaw('SUM(quantidade_transacao * preco_venda) as receita_total')
            ->value('receita_total');

        $totalTransacao = RegistroEstoque::where('produto_id', $produtoId)->where('tipo_transacao', 'venda')
            ->sum('quantidade_transacao');

        if ($totalTransacao === 0) {
            $totalTransacao = 1;
        }

        return ($receitaTotal / $totalTransacao);
    }

    public function calcularQuantidadeEstoqueProduto(string $produtoId): float
    {
        $totalArmazenado = RegistroEstoque::where('produto_id', $produtoId)->where('tipo_transacao', 'compra')
            ->sum('quantidade_transacao');

        $totalRetirado = RegistroEstoque::where('produto_id', $produtoId)->where('tipo_transacao', 'venda')
            ->orWhere('tipo_transacao', 'baixa')
            ->selectRaw('SUM(quantidade_transacao) as total_retirado')->value('total_retirado');

        return ($totalArmazenado - $totalRetirado);
    }

    public function calcularVolumeVendas(string $produtoId): float
    {
        $dataAtual = Carbon::now();

        $totalVendasMesAtual = RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->where('data_registro', '>=', $dataAtual->subDays(30))
            ->sum('quantidade_transacao');

        $totalVendasMesPassado = RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->whereBetween('data_registro', [$dataAtual->subDays(60), $dataAtual->subDays(30)])
            ->sum('quantidade_transacao');

        return $totalVendasMesAtual - $totalVendasMesPassado;
    }

    public function criarRegistroEstoque(CriarRegistroEstoqueRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            RegistroEstoque::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarRegistroEstoque(AtualizarRegistroEstoqueRequest $request): bool
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            RegistroEstoque::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }

    public function deletarRegistroEstoque(string $id): bool
    {
        try {
            RegistroEstoque::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
