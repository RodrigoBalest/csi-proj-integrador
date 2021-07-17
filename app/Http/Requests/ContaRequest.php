<?php

namespace App\Http\Requests;

use App\Models\Conta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'valor_inicial' => 'required|numeric',
            'icone' => [
                'required',
                Rule::in(array_keys(((new Conta())->getIcones())))
            ]
        ];
    }

    /**
     * Define mensagens de validação personalizadas.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório.',
            'valor_inicial.required' => 'O campo Valor Inicial é obrigatório.',
            'valor_inicial.numeric' => 'O campo Valor Inicial deve ser um número',
            'icone.required' => 'É necessário selecionar um ícone.',
            'icone.in' => 'A opção informada para o ícone é inválida.'
        ];
    }
}
