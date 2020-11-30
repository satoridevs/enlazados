<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // if ($this->method() == 'PUT') {
        //     // Edit Form
        //     return [
        //         'name'           => 'required',
        //         'lastname'       => 'required',
        //         'documentnumber' => 'required|unique:users,documentnumber'.$this->id,
        //         'email'          => 'required|email',
        //         'phone'          => 'required|numeric',
        //         'birthdate'      => 'required|date',
        //         'gender'         => 'required',
        //         'photo'          => 'max:1000',                    
        //     ];
        // } else {
        //     // Create Form
        //     return [
        //         'name'           => 'required',
        //         'lastname'       => 'required',
        //         'documentnumber' => 'required|unique:users',
        //         'email'          => 'required|email',
        //         'phone'          => 'required|numeric',
        //         'birthdate'      => 'required|date',
        //         'gender'         => 'required',
        //         'photo'          => 'max:1000',   
        //     ];
        // }

        return [
                 'name'           => 'required',
                 'lastname'       => 'required',
                 'documentnumber' => 'required|unique:users',
                 'email'          => 'required|email',
                 'phone'          => 'required|numeric',
                 'birthdate'      => 'required|date',
                 'gender'         => 'required',                 
                 'photo'          => 'max:1000',
                 'password'       => 'required|min:6|confirmed',   
             ]; 
    }

    public function messages() {
        return [
            'name.required' => 'El campo "name" es obligatorio.',
            'documentnumber.unique' => 'El campo "documentnumber" debe ser unico',
            'email.required'    => 'El campo "Correo Electrónico" es obligatorio.'
        ];
    }
}
