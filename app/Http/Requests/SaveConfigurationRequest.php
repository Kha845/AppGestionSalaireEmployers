<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveConfigurationRequest extends FormRequest
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
            'type' => 'required|unique:configurations,type',
            'value' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'type.required' => 'Le type de configuration est requis',
            'type.unique' => 'Cette configuration existe déja',
            'value.required' => 'La valeur de la configuration est requis',
        ];
    }
}
