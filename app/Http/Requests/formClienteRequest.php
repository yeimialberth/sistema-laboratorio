<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formClienteRequest extends FormRequest
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
        $rules = [
            'numID'                  => 'required|numeric',
            'nombreCliente'          => 'required',
//            'telefonoContacto'       => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'nombreCliente.required'            => 'Debes ingresar un nombre para el cliente',
            'numID.required'                    => 'Debes ingresar un RUC ó DNI para el cliente',
            'numID.numeric'                    => 'El RUC ó DNI del cliente debe ser numerico',
//            'telefonoContacto.required'         => 'Debes ingresar un telefono para el cliente',
//            'telefonoContacto.numeric'         => 'El telefono del cliente debe ser numerico',
        ];

        return $messages;
    }
}
