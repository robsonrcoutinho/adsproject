<?php

namespace adsproject\Http\Requests;

class AvaliacaoRequest extends Request
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
            'inicio' => 'required|date',
            'termino' => 'required|date|after:inicio'
        ];
    }
}
