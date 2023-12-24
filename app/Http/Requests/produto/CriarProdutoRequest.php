<?php

namespace App\Http\Requests\produto;

use App\Enums\UnidadeMedidaMassaVolume;
use App\Enums\UnidadeMedidaQuantidade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CriarProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo_produto' => 'required|regex:/^[0-9]+$/|unique:produtos,codigo_produto',
            'nome_produto' => 'required|string|max:50|unique:produtos,nome_produto|
            regex:/^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&\'\-\s]*$/',
            'descricao_produto' => 'nullable|string',
            'unidade_medida' => ['required', Rule::in(array_merge(UnidadeMedidaMassaVolume::getConstants(), UnidadeMedidaQuantidade::getConstants()))],
            'categoria_id' => 'required|numeric|min:1',
            'marca_id' => 'required|numeric|min:1',
        ];
    }
}
