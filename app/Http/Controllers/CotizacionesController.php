<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MoneyParser;
use App\Categorias;
use App\Session;

class CotizacionesController extends Controller
{
	private $shoppingCart;
	private $global_data;

	public function __construct(){
		$this->shoppingCart = new ShoppingCart();
		$this->global_data = Session::getData();
	}
    public function index(){

    	return view('cotizaciones.index')
    		->with('data', $this->global_data);
    }
}
