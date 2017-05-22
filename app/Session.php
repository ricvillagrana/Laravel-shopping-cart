<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Clientes;
use App\Http\Controllers\ShoppingCart;

class Session extends Model
{
	public function __construct(){
		session_start();
	}
	public function __autoload(){

	}
    public static function set($name, $data){
    	if(!isset($_SESSION))	
    		session_start();
		$_SESSION[$name] = $data;
    }
    public static function get($name){
    	if(!isset($_SESSION))	
    		session_start();
    	if(isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return null;
    }
    public static function logedIn($name){
    	if(!isset($_SESSION))	
    		session_start();
    	return (isset($_SESSION[$name]));
    }
    public static function del($name){
        if(!isset($_SESSION))   
            session_start();
        $_SESSION[$name] = null;    
    }

    public static function getData(){
        $shoppingCart = new ShoppingCart();
        return (object) array(
                'amount' =>  MoneyParser::parseFancy($shoppingCart->getAmount()),
                'flatAmount' =>  $shoppingCart->getAmount(),
                'categorias' => Categorias::all(),
                'session' => (Session::logedIn('cliente')) ? Clientes::find(Session::get('cliente')) : null
            );
    }
}
