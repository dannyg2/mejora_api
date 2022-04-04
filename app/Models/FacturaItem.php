<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "descripcion",
        "cantidad",
        "valor",
        "total",
    ];
}
