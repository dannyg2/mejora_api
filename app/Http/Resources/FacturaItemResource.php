<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacturaItemResource extends JsonResource
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
            "descripcion"=> $this->descripcion,
            "cantidad"=> $this->cantidad,
            "valor"=> $this->valor,
            "total"=> $this->total,
        ];
    }
}
