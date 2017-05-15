<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MoneyParser;

class Productos extends Model
{
    protected $fillable = ['id_categoria', 'nombre', 'precio', 'descripcion'];

    public function getPrecio(){
    	return MoneyParser::parseFancy($this->precio);
    }
    public function getCategoria(){
    	return Categorias::find($this->id_categoria)->nombre;
    }
}
