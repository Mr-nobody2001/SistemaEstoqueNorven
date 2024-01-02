<?php

namespace App\Http\Requests\categoriaProduto;

use Illuminate\Foundation\Http\FormRequest;

class CriarCategoriaProdutoRequest extends FormRequest
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
            'nome_categoria' => 'required|regex:/^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&\'\-\s]*$/|
            unique:categoria_produtos,nome_categoria|string|max:50',
            'descricao_categoria' => 'nullable|string',
            'imagem_categoria' => 'required|file|mimes:jpeg,jpg|max:2048',
        ];

    }
}
