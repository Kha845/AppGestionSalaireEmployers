<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'name'=> 'required|string',
            'email' => 'required',
            'password' => 'string'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Le nom est requis',
            'email.required' => 'Le email est requis',
            'email.unique' => 'email est liée à un compte',
            'password.unique' => 'mot de passe existe déja',
        ];
    }
}
