<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MoneyParser;
use App\Categorias;

class CotizacionesController extends Controller
{
	private $shoppingCart;
	private $global_data;

	public function __construct(){
		$this->shoppingCart = new ShoppingCart();
		$this->global_data = (object) array(
	                             'amount' =>  MoneyParser::parseFancy($this->shoppingCart->getAmount()),
	                             'cant' => $this->shoppingCart->getAmount(),
	                             'categorias' => Categorias::all()
	                             );
	}
    public function index(){

    	return view('cotizaciones.index')
    		->with('data', $this->global_data);
    }
}
