<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRules;
use App\Http\Requests\ClienteLoginRules;
use App\MoneyParser;
use App\Categorias;
use App\Clientes;
use App\Session;

class ClientesController extends Controller
{
    private $shoppingCart;
	private $global_data;

	public function __construct(){
		$this->shoppingCart = new ShoppingCart();
		$this->global_data = Session::getData();
	}
	public function index(){
		if(Session::logedIn('cliente')){
			return view('clientes.index')
    	        ->with('data', $this->global_data);
		}else{
			return redirect('cliente/signin')
    	    ->with('data', $this->global_data);
		}
	}
	public function create(ClienteRules $request){
		$cliente = new Clientes();
		$cliente->nombre 		= $request->nombre;
		$cliente->apellido 		= $request->apellido;
		$cliente->correo 		= $request->correo;
		$cliente->telefono 		= $request->telefono;
		$cliente->password 		= hash('sha256', $request->password);
		if($request->password 	== $request->password_confirmation){
			$cliente->save();

			Session::set('cliente', Clientes::where('correo', $cliente->correo)->get()[0]->id);
		}
		return redirect('cliente/profile')
    	    ->with('data', $this->global_data);
	}
	public function signin(){
		return view('clientes.login')
    	    ->with('data', $this->global_data);
	}
	public function signup(){
		return view('clientes.create')
    	    ->with('data', $this->global_data);
	}
	public function signout(){
		Session::del('cliente');
		return redirect('cliente/signin')
    	    ->with('data', $this->global_data);
	}
	public function login(ClienteLoginRules $request){
		$cliente = Clientes::where('correo', $request->correo)->get()[0];
		if($cliente->password == hash('sha256', $request->password)){
			Session::set('cliente',  Clientes::where('correo', $cliente->correo)->get()[0]->id);
		}else{
		}
		return redirect('cliente/profile')
    	    ->with('data', $this->global_data);
	}
	public function new(){
		return view('clientes.create')
    	    ->with('data', $this->global_data);
	}
}
