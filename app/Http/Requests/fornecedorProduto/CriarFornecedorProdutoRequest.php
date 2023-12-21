<?php

namespace App\Http\Requests\fornecedorProduto;

use Illuminate\Foundation\Http\FormRequest;

class CriarFornecedorProdutoRequest extends FormRequest
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
            'nome_fornecedor' => 'required|regex:/^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&\'\-\s]*$/|
            unique:fornecedor_produtos,nome_fornecedor|string|max:50',
            'email' => 'required|email|unique:fornecedor_produtos,email|max:50',
            'telefone' => 'required|unique:fornecedor_produtos,telefone|string|min:14|max:15',
            'cpf' => 'nullable|unique:fornecedor_produtos,cpf|string|min:14|max:14',
            'cnpj' => 'nullable|unique:fornecedor_produtos,cnpj|string|min:18|max:18',
        ];
    }
}
