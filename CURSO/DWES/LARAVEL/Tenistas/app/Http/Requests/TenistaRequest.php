<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenistaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100',Rule::unique(table:'tenistas',column:'nombre')->ignore($this->tenista)],
            'apellidos' => ['required', 'string', 'max:200'],
            'altura' => ['required', 'numeric', 'max:200'],
            'mano' => ['required',Rule::in(['Diestro', 'Zurdo'])],
            'anno_nacimiento' => ['required', 'numeric', 'min:1900', 'max:2025'],

        ];
    }

    public function messages():array
    {
        return[
            'nombre.required'=>'El campo nombre es obligatorio.',
            'nombre.string'=>'El campo nombre debe ser una cadena de texto.',
            'nombre.max'=>'El campo nombre no debe ser mayor a :max caracteres.',
            'apellidos.required'=>'El campo apellidos es obligatorio.',
            'apellidos.string'=>'El campo apellidos debe ser una cadena de texto.',
            'apellidos.max'=>'El campo apellidos no debe ser mayor a :max caracteres.',
            'altura.required'=>'El campo altura es obligatorio.',
            'altura.numeric'=>'El campo altura debe ser un número.',
            'altura.max'=>'El campo altura no debe ser mayor a :max caracteres.',
            'mano.required'=>'El campo mano es obligatorio.',
            'mano.string'=>'El campo mano debe ser una cadena de texto.',
            'mano.max'=>'El campo mano no debe ser mayor a :max caracteres.',
            'anno_nacimiento.required'=>'El campo anno_nacimiento es obligatorio.',
            'anno_nacimiento.numeric'=>'El campo anno_nacimiento debe ser un número.',
            'anno_nacimiento.max'=>'El campo anno_nacimiento no debe ser mayor a :max caracteres.',
        ];
    }
}
