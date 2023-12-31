<?php

namespace App\repositorys;

use App\Models\RegistroEstoque;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class RegistroEstoqueRepository
{
    public function calcularTotalReceita(string $produtoId, Carbon $mesPassado): float
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->where('data_registro', '>=', $mesPassado)
            ->selectRaw('SUM(quantidade_transacao * preco_venda) as receita_total')
            ->value('receita_total');
    }

    public function calcularTotalTransacao(string $produtoId): int
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

    public function calcularTotalArmazenado(string $produtoId): int
    {
        return  RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'compra')
            ->sum('quantidade_transacao');
    }

    public function calcularTotalRetirado(string $produtoId): int
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->orWhere('tipo_transacao', 'baixa')
            ->selectRaw('SUM(quantidade_transacao) as total_retirado')->value('total_retirado');
    }

    public function calcularTotalVendasMesAtual(string $produtoId, Carbon $dataAtual): int
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->where('data_registro', '>=', $dataAtual->subDays(30))
            ->sum('quantidade_transacao');
    }

    public function calcularTotalVendasMesPassado(string $produtoId, Carbon $dataAtual): int
    {
        return RegistroEstoque::where('produto_id', $produtoId)
            ->where('tipo_transacao', 'venda')
            ->whereBetween('data_registro', [$dataAtual->subDays(60), $dataAtual->subDays(30)])
            ->sum('quantidade_transacao');
    }
}