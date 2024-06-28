<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestEmployers extends FormRequest
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
            'email'=>'required',
            'phone'=>'required',
            'number'=>'required|min:3'
        ];
    }

    public function message()
    {
        return [

            'email.required'=>'le mail est requis',
            'phone.unique'=>'le numéro est déja pris'

        ];
    }
}
