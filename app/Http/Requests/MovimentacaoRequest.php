<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use App\Models\Conta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovimentacaoRequest extends FormRequest
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
            'tipo' => [
                'required',
                Rule::in(['receita', 'despesa'])
            ],
            'nome' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'categoria' => [
                'required',
                // Pega somente os ids das categorias que pertencem ao usuário logado.
                Rule::in(Categoria::all()->map->getKey()->toArray())
            ],
            'conta' => [
                'required',
                // Pega somente os ids das categorias que pertencem ao usuário logado.
                Rule::in(Conta::all()->map->getKey()->toArray())
            ],
            'vencimento' => 'required|date_format:Y-m-d',
        ];
    }

    public function attributes()
    {
        return [
            'tipo' => 'Tipo',
            'nome' => 'Nome',
            'valor' => 'Valor',
            'categoria' => 'Categoria',
            'conta' => 'Conta',
            'vencimento' => 'Vencimento'
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'É necessário informar um tipo de movimentação.',
            'tipo.in' => 'O tipo de movimentação informado não é válido.',
            'nome.required' => 'É necessário informar um nome para a movimentação',
            'nome.string' => 'O nome deve ser um texto.',
            'valor.required' => 'É necessário informar um valor.',
            'valor.min' => 'O valor deve ser um número positivo.',
            'categoria.in' => 'A categoria informada não é válida.',
            'conta.in' => 'A conta informada não é válida.',
            'vencimento.date_format' => 'A data de vencimento deve estar no formato Y-m-d.'
        ];
    }
}
