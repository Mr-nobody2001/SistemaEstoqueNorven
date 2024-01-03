<?php

namespace App\services;

use App\Http\Requests\registroEstoque\AtualizarRegistroEstoqueRequest;
use App\Http\Requests\registroEstoque\CriarRegistroEstoqueRequest;
use App\Models\LoteProduto;
use App\Models\RegistroEstoque;
use App\repositorys\RegistroEstoqueRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class RegistroEstoqueService
{
    public function __construct(private readonly RegistroEstoqueRepository $registroEstoqueRepository)
    {
    }

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
        return $this->registroEstoqueRepository->encontrarRegistroEstoqueIdProdutoCompra($produtoId);
    }

    public function encontrarRegistroEstoqueIdProdutoVenda(string $produtoId): LengthAwarePaginator
    {
        return $this->registroEstoqueRepository->encontrarRegistroEstoqueIdProdutoVenda($produtoId);
    }

    public function verificarEstoqueTotalmenteVendido(string $loteId): bool
    {
        $lote = LoteProduto::find($loteId);

        if ($lote->totalmente_vendido) {
            return false;
        }

        $quantidadeLoteArmazenado = $this->registroEstoqueRepository->calcularTotalArmazenadoLote($loteId);

        $quantidadeLoteRetirado = $this->registroEstoqueRepository->calcularTotalRetiradoLote($loteId);

        if (is_null($quantidadeLoteArmazenado) || is_null($quantidadeLoteRetirado)) {
            return false;
        }

        return $quantidadeLoteArmazenado - $quantidadeLoteRetirado === 0;
    }

    public function calcularTicketMedio(string $produtoId): float
    {
        $dataAtual = Carbon::now();

        $mesPassado = $dataAtual->subDays(30);

        $receitaTotal = $this->registroEstoqueRepository->calcularTotalReceita($produtoId, $mesPassado);

        $totalTransacao = $this->registroEstoqueRepository->calcularTotalTransacao($produtoId);

        if ($totalTransacao === 0) {
            $totalTransacao = 1;
        }

        return ($receitaTotal / $totalTransacao);
    }

    public function calcularQuantidadeEstoqueProduto(string $produtoId): int
    {
        $quantidadeProdutoArmazenado = $this->registroEstoqueRepository->calcularTotalArmazenado($produtoId);

        $quantidadeProdutoRetirado = $this->registroEstoqueRepository->calcularTotalRetirado($produtoId);

        return ($quantidadeProdutoArmazenado - $quantidadeProdutoRetirado);
    }

    public function calcularVolumeVendas(string $produtoId): int
    {
        $dataAtual = Carbon::now();

        $totalVendasMesAtual = $this->registroEstoqueRepository->calcularTotalVendasMesAtual($produtoId, $dataAtual);

        $totalVendasMesPassado = $this->registroEstoqueRepository->calcularTotalVendasMesPassado($produtoId, $dataAtual);

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
