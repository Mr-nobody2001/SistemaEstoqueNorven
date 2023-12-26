<?php

namespace App\Http\Requests\loteProduto;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarLoteProdutoRequest extends FormRequest
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
            'numero_lote' => 'required|alpha_num',
            'data_validade' => 'required|date|after:now',
            'preco_custo' => 'required|decimal:2|min:0|max:99999999',
            'fornecedor_id' => 'required|numeric|min:1',
        ];
    }
}
