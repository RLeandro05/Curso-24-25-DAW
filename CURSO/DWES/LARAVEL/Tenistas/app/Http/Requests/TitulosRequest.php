<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TitulosRequest extends FormRequest
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
    public function rules()
    {
        return [
            'anno' => [
                'required',
                'integer',
                'min:1900',
                'max:' . date('Y'),
                function ($attribute, $value, $fail) {
                    if (
                        \App\Models\Titulos::where([
                            ['anno', '=', $value],
                            ['tenista_id', '=', request('tenista_id')],
                            ['torneo_id', '=', request('torneo_id')]
                        ])->exists()
                    ) {
                        $fail('El torneo ya ha sido asignado a otro tenista en el mismo año.');
                    }
                },
            ],
            'tenista_id' => 'required|exists:tenistas,id',
            'torneo_id' => 'required|exists:torneos,id',
        ];
    }

}
