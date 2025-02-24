<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TorneoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Cambiar a lógica de autorización si es necesario
    }

    /**
     * Obtiene las reglas de validación que se aplicarán a la solicitud.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255|unique:torneos,nombre,' . $this->route('torneo'),
            'ciudad' => 'required|string|max:255',
            'superficie_id' => 'required|integer|between:1,3', // Superficie debe ser 1, 2 o 3
        ];
    }

    /**
     * Mensajes de error personalizados para las reglas de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del torneo es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',
            'nombre.unique' => 'Este torneo ya existe.',

            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.string' => 'La ciudad debe ser un texto.',
            'ciudad.max' => 'La ciudad no puede superar los 255 caracteres.',

            'superficie_id.required' => 'Debes seleccionar una superficie.',
            'superficie_id.integer' => 'El valor de la superficie no es válido.',
            'superficie_id.between' => 'El valor de la superficie debe ser 1 (arcilla), 2 (césped) o 3 (cemento).',
        ];
    }
}
