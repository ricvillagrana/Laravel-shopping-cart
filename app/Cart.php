<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['id_cliente', 'id_producto', 'cantidad'];
}
