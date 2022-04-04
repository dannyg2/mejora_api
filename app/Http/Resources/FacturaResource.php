<?php

namespace App\Http\Resources;

use App\Http\Resources\FacturaItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FacturaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "num_factura"=>$this->id,
            "fecha"=>$this->fecha,
            "emisor_nombre"=>$this->emisor_nombre,
            "emisor_num_doc"=>$this->emisor_num_doc,
            "emisor_num_doc_dv"=>$this->emisor_num_doc_dv,
            "comprador_nombre"=>$this->comprador_nombre,
            "comprador_num_doc"=>$this->comprador_num_doc,
            "comprador_num_doc_dv"=>$this->comprador_num_doc_dv,
            "subtotal"=>$this->subtotal,
            "iva"=>$this->iva,
            "iva_value"=>$this->iva_value,
            "total"=>$this->total,
            "items" => FacturaItemResource::collection($this->items)
        ];
    }
}
