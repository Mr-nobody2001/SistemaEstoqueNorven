<?php

namespace App\Http\Requests\produto;

use App\Enums\UnidadeMedidaEnergia;
use App\Enums\UnidadeMedidaMassa;
use App\Enums\UnidadeMedidaVolume;
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
            // Informaçẽos gerais do produto
            'codigo_produto' => 'required|string|regex:/^[0-9]+$/|unique:produtos,codigo_produto',
            'nome_produto' => 'required|string|max:50|unique:produtos,nome_produto|
            regex:/^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&\'\-\s]*$/',
            'descricao_produto' => 'nullable|string',
            'unidade_medida' => ['required', Rule::in(array_merge(UnidadeMedidaMassa::getConstants(), UnidadeMedidaVolume::getConstants(), UnidadeMedidaQuantidade::getConstants()))],
            'categoria_id' => 'required|numeric|min:1',
            'marca_id' => 'required|numeric|min:1',

            //Informaçẽos nutricionais
            'quantidade_porcao' => 'required|numeric|min:1',
            'unidade_medida_porcao' => ['required', 'requiredIf:quantidade_porcao,min:1', Rule::in(array_merge(UnidadeMedidaMassa::getConstants(), UnidadeMedidaVolume::getConstants(), UnidadeMedidaQuantidade::getConstants()))],
            'quantidade_energia' => 'required|numeric|min:1',
            'unidade_medida_energia' => ['required', Rule::in(array_merge(UnidadeMedidaEnergia::getConstants()))],
            'quantidade_proteina' => 'required|numeric|min:0',
            'unidade_medida_proteina' => ['required', Rule::in(array_merge(UnidadeMedidaMassa::getConstants()))],
            'quantidade_gordura' => 'required|numeric|min:0',
            'unidade_medida_gordura' => ['required', Rule::in(array_merge(UnidadeMedidaMassa::getConstants()))],
            'quantidade_acucar' => 'required|numeric|min:0',
            'unidade_medida_acucar' => ['required', Rule::in(array_merge(UnidadeMedidaMassa::getConstants()))],
            'quantidade_sodio' => 'required|numeric|min:0',
            'unidade_medida_sodio' => ['required', Rule::in(array_merge(UnidadeMedidaMassa::getConstants()))],

            // Alérgenos
            'leite' => 'string|in:leite',
            'ovos' => 'string|in:ovos',
            'amendoim' => 'string|in:amendoim',
            'nozes' => 'string|in:nozes',
            'trigo' => 'string|in:trigo',
            'soja' => 'string|in:soja',
            'mostarda' => 'string|in:mostarda',
            'sulfitos' => 'string|in:sulfitos',
            'sementes_gergelim' => 'string|in:sementes_gergelim',
        ];
    }
}
