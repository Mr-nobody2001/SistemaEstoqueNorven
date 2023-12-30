<?php

namespace App\Http\Requests\registroEstoque;

use App\Enums\TipoTransacao;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtualizarRegistroEstoqueRequest extends FormRequest
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
            'produto_id' => 'required|numeric|min:1',
            'lote_id' => 'required|numeric|min:1',
            'tipo_transacao' => ['required', Rule::in(TipoTransacao::getConstants())],
            'quantidade_transacao' => 'required|numeric|min:1',
            'preco_venda' => 'required|decimal:2|min:0',
        ];
    }
}
