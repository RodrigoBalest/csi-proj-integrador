<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Somente o usuário anônimo pode tentar se registrar
     *
     * @return bool
     */
    public function authorize()
    {
        return ! Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:App\Models\Usuario,email',
            'senha' => ['required', 'confirmed', Rules\Password::defaults()]
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'email' => 'E-mail',
            'senha' => 'Senha'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Este e-mail já está em uso.'
        ];
    }
}
