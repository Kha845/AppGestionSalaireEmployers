<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEmployersRequest extends FormRequest
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
            'departement_id'=>'required|integer',
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'email'=>'required|unique:employes,email',
            'phone'=>'required|unique:employes,contact',
            'number'=>'required|min:3'
        ];
    }

    public function messages()
    {
        return [

            'email.required'=>'le mail est requis',
            'email.unique'=>'le mail est déja pris',
             'phone.required'=>'le numéro est requis',
            'phone.unique'=>'le numéro est déja pris'

        ];
    }
}
