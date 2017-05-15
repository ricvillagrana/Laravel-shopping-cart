<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class view_productos_cat extends Model
{
    public function getPrecio(){
    	return MoneyParser::parseFancy($this->precio);
    }
}
