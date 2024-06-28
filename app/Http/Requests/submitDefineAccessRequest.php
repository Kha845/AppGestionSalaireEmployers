<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submitDefineAccessRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|exists:reset_code_passwords,code',
            'password' => 'required|same:password_confirm',
            'password_confirm' => 'required|same:password',
        ];

    }

    public function messages(){
        return [
            'code.required' =>'le code de validation est requis',
            'code.exists' =>'le code n\'est pas valide',
            'password.same' =>'les mots de passe ne correspondent pas',
            'confim_password'=>'les mots de passe ne correspondent'
        ];
    }
}
