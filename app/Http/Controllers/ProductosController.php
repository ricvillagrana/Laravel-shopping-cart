<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ShoppingCart;
use App\MoneyParser;
use App\Productos;
use App\view_productos_cat;
use App\Categorias;
use App\Session;
use App\Cart;
use App\Cart_details;

class ProductosController extends Controller
{
	// $shoppingCart variable for ShoppingCart Controller
	private $cart;
	private $global_data;

	public function __construct(Request $request){
		$this->cart = Cart::where('id_cliente', Session::get('cliente'));
		$this->global_data = Session::getData();
	}
    public function index(){
        $productos = Productos::all();
    	return view('productos.index')
    	            ->with('productos', $productos)
    	            ->with('data', $this->global_data);
    }
    public function getRank($id){
        $producto = Productos::find($id);
        echo $producto->cant_min.",".$producto->cant_max;
    }
    public function viewCategorie($categoria){
        $productos = view_productos_cat::all()->where('nombre',$categoria);
        
        return view('productos.categoria')
                    ->with('productos', $productos)
                    ->with('data', $this->global_data)
                    ->with('cat', $categoria);
    }
    public function search($query){
        $productos = Productos::where('nombre', 'ilike', '%'.$query.'%')
            ->orWhere('descripcion', 'ilike', '%'.$query.'%')
            ->get();
        
        return view('productos.search-result')
                    ->with('productos', $productos)
                    ->with('data', $this->global_data)
                    ->with('query', $query);
    }
    public function showProducto($id){
    	return view('productos.producto')
    	            ->with('producto', Productos::find($id))
    	            ->with('data', $this->global_data);
    }
    public function showCart(){
        if(!Session::logedIn('cliente'))
            return redirect('/cliente/signin');
        $productos = Cart_details::where('id_cliente', Session::get('cliente'))->get();
        if($productos->count() != 0){
            foreach ($productos as $producto) {
                $producto->total = MoneyParser::parseFancy($producto->precio*$producto->cantidad);
                $producto->precioF = MoneyParser::parseFancy($producto->precio);
            }
        }else
            $productos = false;
        //dd($productos);
    	return view('productos.carrito')
    	            ->with('carrito', $productos)
    	            ->with('data', $this->global_data);
    }
    public function newProducto($id_categoria, $nombre, $precio, $descripcion){
    	$Productos = Productos::create(
			array(
	             'id_categoria'	=> $id_categoria,
	             'nombre' 		=> $nombre,
	             'precio' 		=> $precio,
	             'descripcion' 	=> $descripcion
	        ));
    	return view('productos.index')->with('message','Producto creado ID:'.$Producto->getId());
    }
}
