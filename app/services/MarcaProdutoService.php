<?php

namespace App\services;

use App\Http\Requests\CriarMarcaProdutoRequest;
use App\Models\MarcaProduto;
use App\repositorys\MarcaProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class MarcaProdutoService
{
    public function __construct(private MarcaProdutoRepository $marcaProdutoRepository)
    {
    }

    public function listarTodasMarcas(): LengthAwarePaginator
    {
        return MarcaProduto::paginate(20);
    }

    public function encontrarMarcaId(string $id): MarcaProduto
    {
        return MarcaProduto::where('id', $id)->first();
    }

    public function encontrarMarcaNome(string $nomeMarca): LengthAwarePaginator
    {
        return $this->marcaProdutoRepository->encontrarMarcasNome($nomeMarca);
    }

    public function criarMarcaProduto(CriarMarcaProdutoRequest $request): bool
    {
        $requestValidada = $request->validated();

        try {
            MarcaProduto::create($requestValidada);
        } catch (Exception) {
            return false;
        }

        return true;
    }

    public function atualizarMarcaProduto(CriarMarcaProdutoRequest $request): bool
    {
        $id = $request->id;

        $requestValidada = $request->validated();

        $linhasAfetadas = MarcaProduto::where('id', $id)
            ->update(['nome_marca' => $requestValidada['nome_marca']]);

        return $linhasAfetadas > 0;
    }

    public function deletarMarcaProduto(string $id): bool
    {
        $colunasAfetadas = MarcaProduto::destroy($id);

        return $colunasAfetadas > 0;
    }
}
