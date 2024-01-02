<?php

namespace App\Http\Controllers;

use App\Http\Requests\loteProduto\AtualizarLoteProdutoRequest;
use App\Http\Requests\loteProduto\CriarLoteProdutoRequest;
use App\services\FornecedorProdutoService;
use App\services\LoteProdutoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class LoteProdutoController extends Controller
{
    public function __construct(
        private readonly LoteProdutoService $loteProdutoService,
        private readonly FornecedorProdutoService $fornecedorProdutoService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $valorPesquisa = null;

        if ($request->numero_lote) {
            $valorPesquisa = $request->numero_lote;
            $paginaLoteProduto = $this->loteProdutoService->encontrarLoteNumero($valorPesquisa);
        } else {
            $paginaLoteProduto = $this->loteProdutoService->listarTodosLotes();
        }

        return view('loteProduto.index-lote-produto', compact('paginaLoteProduto', 'valorPesquisa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $listaTodosFornecedores = $this->fornecedorProdutoService->listarTodosFornecedoresSemPaginacao()->all();

        return view('loteProduto.criacao-lote-produto', compact('listaTodosFornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriarLoteProdutoRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->loteProdutoService->criarLoteProduto($request)) {
            return redirect(route('lote.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('lote.index'))->with(['msg' => 'Lote criado com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $loteProduto = $this->loteProdutoService->encontrarLoteId($id);

        $listaTodosFornecedores = $this->fornecedorProdutoService->listarTodosFornecedoresSemPaginacao()->all();


        return view('loteProduto.atualizacao-lote-produto', compact('loteProduto',
            'listaTodosFornecedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtualizarLoteProdutoRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->loteProdutoService->atualizarLoteProduto($request)) {
            return redirect(route('lote.index'))->with(['msg' => 'Não foi possível atualizar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('lote.index'))->with(['msg' => 'Lote atualizado com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Application|RedirectResponse|Redirector
    {
        if (!$this->loteProdutoService->deletarLoteProduto($id)) {
            return redirect(route('lote.index'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('lote.index'))->with(['msg' => 'Lote removido com sucesso', 'tipo' => 'sucesso']);
    }
}
