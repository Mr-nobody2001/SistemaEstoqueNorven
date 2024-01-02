<?php

namespace App\Http\Controllers;

use App\Http\Requests\registroEstoque\AtualizarRegistroEstoqueRequest;
use App\Http\Requests\registroEstoque\CriarRegistroEstoqueRequest;
use App\services\LoteProdutoService;
use App\services\ProdutoService;
use App\services\RegistroEstoqueService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RegistroEstoqueController extends Controller
{
    public function __construct(private readonly LoteProdutoService     $loteProdutoService,
                                private readonly ProdutoService         $produtoService,
                                private readonly RegistroEstoqueService $registroEstoqueService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $valorPesquisa = null;

        if ($request->data_registro) {
            $valorPesquisa = $request->data_registro;
            $paginaRegistro = $this->registroEstoqueService->encontrarRegistroEstoqueDataRegistro($valorPesquisa);
        } else {
            $paginaRegistro = $this->registroEstoqueService->listarTodosRegistros();
        }

        return view('registroEstoque.index-registro-estoque', compact('paginaRegistro', 'valorPesquisa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $listaTodosLotes = $this->loteProdutoService->listarTodosLotesSemPaginacao();

        $listaTodosProdutos = $this->produtoService->listarTodosProdutosSemPaginacao();

        return view('registroEstoque.criacao-registro-estoque', compact('listaTodosLotes', 'listaTodosProdutos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriarRegistroEstoqueRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->registroEstoqueService->criarRegistroEstoque($request)) {
            return redirect(route('registro.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('registro.index'))->with(['msg' => 'Registro criado com sucesso', 'tipo' => 'sucesso',]);
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
        $registroEstoque = $this->registroEstoqueService->encontrarRegistroEstoqueId($id);

        $listaTodosLotes = $this->loteProdutoService->listarTodosLotesSemPaginacao();

        $listaTodosProdutos = $this->produtoService->listarTodosProdutosSemPaginacao();

        return view('registroEstoque.atualizacao-registro-estoque', compact('registroEstoque', 'listaTodosLotes', 'listaTodosProdutos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtualizarRegistroEstoqueRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->registroEstoqueService->atualizarRegistroEstoque($request)) {
            return redirect(route('registro.index'))->with(['msg' => 'Não foi possível atualizar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('registro.index'))->with(['msg' => 'Registro atualizado com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->registroEstoqueService->deletarRegistroEstoque($id)) {
            return redirect(route('registro.index'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('registro.index'))->with(['msg' => 'Registro removido com sucesso', 'tipo' => 'sucesso']);
    }
}
