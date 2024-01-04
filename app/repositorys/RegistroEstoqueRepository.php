<?php

namespace App\repositorys;

use App\Models\RegistroEstoque;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class RegistroEstoqueRepository
{
    public function calcularTotalReceita(string $produtoId, Carbon $mesPassado): float|null
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->where('data_registro', '>=', $mesPassado)
            ->selectRaw('SUM(quantidade_transacao * valor_transacao) as receita_total')
            ->value('receita_total');
    }

    public function calcularTotalTransacao(string $produtoId): int|null
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->sum('quantidade_transacao');
    }

    public function encontrarRegistroEstoqueIdProdutoCompra(string $produtoId): LengthAwarePaginator
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'compra')
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function encontrarRegistroEstoqueIdProdutoVenda(string $produtoId): LengthAwarePaginator
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function calcularTotalArmazenado(string $produtoId): int|null
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'compra')
            ->sum('quantidade_transacao');
    }

    public function calcularTotalArmazenadoLote(string $loteId): int|null
    {
        return RegistroEstoque::where('lote_id', $loteId)
            ->where('tipo_transacao', 'compra')
            ->sum('quantidade_transacao');
    }

    public function calcularTotalRetirado(string $produtoId): int|null
    {
        return RegistroEstoque::where(function ($query) use ($produtoId) {
            $query->where('produto_id', $produtoId)
                ->where('tipo_transacao', 'venda');
        })->orWhere(function ($query) use ($produtoId) {
            $query->where('produto_id', $produtoId)
                ->where('tipo_transacao', 'baixa');
        })->sum('quantidade_transacao');
    }

    public function calcularTotalRetiradoLote(string $loteId): int|null
    {
        return RegistroEstoque::where(function ($query) use ($loteId) {
            $query->where('lote_id', $loteId)
                ->where('tipo_transacao', 'venda');
        })->orWhere(function ($query) use ($loteId) {
            $query->where('lote_id', $loteId)
                ->where('tipo_transacao', 'baixa');
        })->sum('quantidade_transacao');
    }

    public function calcularTotalVendasMesAtual(string $produtoId, Carbon $dataAtual): int|null
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->where('data_registro', '>=', $dataAtual->subDays(30))
            ->sum('quantidade_transacao');
    }

    public function calcularTotalVendasMesPassado(string $produtoId, Carbon $dataAtual): int|null
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->whereBetween('data_registro', [$dataAtual->subDays(60), $dataAtual->subDays(30)])
            ->sum('quantidade_transacao');
    }
}
