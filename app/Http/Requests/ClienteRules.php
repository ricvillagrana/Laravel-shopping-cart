<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRules extends FormRequest
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
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'correo' => 'required|unique:clientes|email',
            'telefono' => 'regex:/[0-9]+$/|unique:clientes|min:10|max:10',
            'password'  =>'Required|Between:6,30|Confirmed',
            'password_confirmation'=>'same:password'
        ];
    }
    /*public function messages()
    {
        return [
            'nombre.required' => 'Nombre inválido',
            'apellido.required' => 'Apellido inválido',
            'correo.required' => 'Correo electrónico inválido',
            'telefono.regex' => 'Teléfono inválido',
            'telefono.min' => 'Teléfono inválido',
            'password.required' => 'Contraseña inválida',
            'password_confirmation.required' => 'La confirmación de la contraseña no es correcta'
        ];
    }*/
}
