<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentosMesRequest extends FormRequest
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
            'mes' => 'integer|between:1,12',
            'ano' => 'integer'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function prepareForValidation()
    {
        $mes = $this->input('mes');
        $ano = $this->input('ano');

        if (is_null($mes) || is_null($ano)) {
            $now = now();
            $mes = $mes ?: $now->format('n');
            $ano = $ano ?: $now->format('Y');

            $this->merge([
                'mes' => $mes,
                'ano' => $ano
            ]);
        }
    }
}
