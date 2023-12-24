<?php

namespace App\Http\Requests\fornecedorProduto;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarFornecedorProdutoRequest extends FormRequest
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
             string|max:50',
            'email' => 'required|email|max:50',
            'telefone' => 'required|string|min:14|max:15',
            'cpf' => 'nullable|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|string|min:14|max:14',
            'cnpj' => 'nullable|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/|string|min:18|max:18',
        ];
    }
}
