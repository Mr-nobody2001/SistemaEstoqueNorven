<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarMarcaProdutoRequest;
use App\Models\MarcaProduto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarcaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $paginaMarcaProduto = MarcaProduto::query()->when($request->marca, function (Builder $builder) use ($request) {
            $builder->where('nome_marca', 'ilike', "%$request->marca%");
        })->paginate(20);

        return view('marcaProduto.index-marca-produto', compact('paginaMarcaProduto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('marcaProduto.criacao-marca-produto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalvarMarcaProdutoRequest $request) : View
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
