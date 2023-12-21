<?php

namespace App\Http\Controllers;

use App\Http\Requests\fornecedorProduto\AtualizarFornecedorProdutoRequest;
use App\Http\Requests\fornecedorProduto\CriarFornecedorProdutoRequest;
use App\services\FornecedorProdutoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class FornecedorProdutoController extends Controller
{
    public function __construct(public FornecedorProdutoService $fornecedorProdutoService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if ($request->nome_fornecedor) {
            $paginaFornecedorProduto = $this->fornecedorProdutoService->encontrarFornecedorNome($request->nome_fornecedor);
        } else {
            $paginaFornecedorProduto = $this->fornecedorProdutoService->listarTodosFornecedores();
        }

        return view('fornecedorProduto.index-fornecedor-produto', compact('paginaFornecedorProduto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('fornecedorProduto.criacao-fornecedor-produto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriarFornecedorProdutoRequest $request): View|Application|RedirectResponse|Redirector
    {
        if (!$this->fornecedorProdutoService->criarFornecedorProduto($request)) {
            return redirect(route('fornecedor.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('fornecedor.index'))->with(['msg' => 'Fornecedor criada com sucesso', 'tipo' => 'sucesso']);
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
    public function edit(string $id)
    {
        $fornecedorProduto = $this->fornecedorProdutoService->encontrarFornecedorId($id);

        return view('fornecedorProduto.atualizacao-fornecedor-produto', compact('fornecedorProduto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtualizarFornecedorProdutoRequest $request)
    {
        if (!$this->fornecedorProdutoService->atualizarFornecedorProduto($request)) {
            return redirect(route('fornecedor.index'))->with(['msg' => 'Não foi possível atualizar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('fornecedor.index'))->with(['msg' => 'Fornecedor atualizada com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->fornecedorProdutoService->deletarFornecedorProduto($id)) {
            return redirect(route('fornecedor.index'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('fornecedor.index'))->with(['msg' => 'Fornecedor removida com sucesso', 'tipo' => 'sucesso']);
    }
}
