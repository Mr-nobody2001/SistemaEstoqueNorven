<?php

namespace App\Http\Controllers;

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
            $paginaRegistro = $this->registroEstoqueService->encontrarRegistroNome($valorPesquisa);
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
        if (!$this->registroEstoqueService->criarRegistro($request)) {
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
    public function edit(string $id)
    {
        dd();
        /*if (!$this->produtoService->criarProduto($request)) {
            return redirect(route('produto.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('produto.index'))->with(['msg' => 'Produto criado com sucesso', 'tipo' => 'sucesso',]);*/
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
