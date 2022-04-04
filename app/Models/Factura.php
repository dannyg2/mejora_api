<?php

namespace App\Models;

use App\Models\FacturaItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha", 
        "emisor_nombre", 
        "emisor_num_doc", 
        "emisor_num_doc_dv", 
        "comprador_nombre", 
        "comprador_num_doc", 
        "comprador_num_doc_dv", 
        "subtotal", 
        "iva", 
        "iva_value", 
        "total",  
    ];

    public function items(){
        return  $this->hasMany(FacturaItem::class);
    }

 
}
