<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ShoppingCart;
use App\MoneyParser;
use App\Productos;
use App\view_productos_cat;
use App\Categorias;

class ProductosController extends Controller
{
	// $shoppingCart variable for ShoppingCart class
	private $shoppingCart;
	private $global_data;

	public function __construct(){
		$this->shoppingCart = new ShoppingCart();
		$this->global_data = (object) array(
	                             'amount' =>  MoneyParser::parseFancy($this->shoppingCart->getAmount()),
	                             'categorias' => Categorias::all()
	                             );
	}
    public function index(){
        $productos = Productos::all();
        if($this->shoppingCart->getProducts() != null)
        foreach ($productos as $key) {
           if(in_array($key->id, array_keys($this->shoppingCart->getProducts()))){
                $key->inCart = true;
           }
       }
    	return view('productos.index')
    	            ->with('productos', $productos)
    	            ->with('data', $this->global_data);
    }
    public function viewAll(){
        $productos = Productos::all()->orderBy('created_at', 'desc')->get();
        if($this->shoppingCart->getProducts() != null)
        foreach ($productos as $key) {
            if(in_array($key->id, array_keys($this->shoppingCart->getProducts()))){
                $key->inCart = true;
            }
        }
        return view('productos.index')
                    ->with('productos', $productos)
                    ->with('data', $this->global_data);
    }
    public function viewCategorie($categoria){
        $productos = view_productos_cat::all()->where('nombre',$categoria);
        if($this->shoppingCart->getProducts() != null)
        foreach ($productos as $key) {
            if(in_array($key->id, array_keys($this->shoppingCart->getProducts()))){
                $key->inCart = true;
            }
        }
        return view('productos.categoria')
                    ->with('productos', $productos)
                    ->with('data', $this->global_data)
                    ->with('cat', $categoria);
    }
    public function showProducto($id){
    	return view('productos.producto')
    	            ->with('producto', Productos::find($id))
    	            ->with('data', $this->global_data);
    }
    public function showCart(){
    	$sh = new ShoppingCart;
    	$products = $sh->getProducts();
        if($products != null){
            $keys = array_keys($products);
            foreach ($keys as $key) {
                $productos[$key] = Productos::find($key);
                $productos[$key]->cantidad = $products[$key];
                $productos[$key]->total = MoneyParser::parseFancy($productos[$key]->cantidad * $productos[$key]->precio);
            }
        }else
            $productos = false;
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
