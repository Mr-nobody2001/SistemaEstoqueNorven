<?php

namespace App\services;

use App\Http\Requests\CriarMarcaProdutoRequest;
use App\repositorys\MarcaProdutoRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MarcaProdutoService
{
    public function __construct(private MarcaProdutoRepository $marcaProdutoRepository)
    {}

    public function listarTodasMarcas(Request $request): LengthAwarePaginator
    {
        return $this->marcaProdutoRepository->listarTodasMarcas($request);
    }

    public function criarMarcaProduto(CriarMarcaProdutoRequest $request) : bool
    {
        $requestValidada = $request->validated();

        return $this->marcaProdutoRepository->criarMarcaProduto($requestValidada);
    }
}
