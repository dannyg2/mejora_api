<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NuevaFacturaRequest extends FormRequest
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
            "emisor_nombre"=>"required",
            "emisor_num_doc"=>"required|integer",
            "emisor_num_doc_dv"=>"required",
            "comprador_nombre"=>"required",
            "comprador_num_doc"=>"required",
            "comprador_num_doc_dv"=>"required",
            "iva"=>"nullable|integer",
            "items" =>"required|array"
        ];
    }
}
