<?php

namespace App\Http\Controllers;

use App\Models\MarcaProduto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MarcaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginaMarcaProduto = MarcaProduto::query()->when($request->nome, function (Builder $builder) use ($request) {
            $builder->where('nome_marca', 'ilike', "%$request->nome%");
        })->paginate(5);

        return view('marcaProduto.index-marca-produto', compact('paginaMarcaProduto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcaProduto.criacao-marca-produto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
