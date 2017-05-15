<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyParser extends Model
{
    public static function parse($amount){
    	return $amount;
    }
    public static function parseFancy($amount){
		return "$".number_format(($amount), 2, '.', ',');
    }
}
