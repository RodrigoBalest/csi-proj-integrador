<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
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
            'cor' => 'required|size:7',
            'icone' => [
                'required',
                Rule::in((new Categoria())->getIcones())
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
            'cor.required' => 'O campo Valor Inicial é obrigatório.',
            'cor.size' => 'O formato do parâmetro Cor deve ser #RRGGBB.',
            'icone.required' => 'O campo Valor Inicial deve ser um número',
            'icone.in' => 'A opção informada para o ícone é inválida.'
        ];
    }
}
