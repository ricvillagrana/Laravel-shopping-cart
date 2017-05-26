<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\MoneyParser;
use App\Session;
use App\Cart;
use App\Cart_details;

class ShoppingCart extends Controller
{
    public function getAmount(){
        $products = Cart_details::where('id_cliente', Session::get('cliente'))->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->precio * $product->cantidad;
        }
        /*if(!isset($_SESSION))
            session_start();
        $total = 0;
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            $keys = array_keys($cart);
            foreach ($keys as $key) {
                $total += Productos::find($key)->precio * $cart[$key];
            }
        }else
            $cart = null;*/
        return $total;
    }
    public function delCart(){
        Cart::where('id_cliente', Session::get('cliente'))->delete();
        /*if(!isset($_SESSION))
            session_start();
        $_SESSION['cart'] = null;*/
        return MoneyParser::parseFancy($this->getAmount());
    }
    public function editProduct($id, $cant){
        $product = Cart::find(Session::get('cliente').$id);
        $article = Productos::find($id);
        if($article->cant_max >= $cant)
            $product->cantidad = $cant;
        else{
            $product->cantidad = $article->cant_max;
            $product->save();
            return MoneyParser::parseFancy($this->getAmount())."E";
        }
        $product->save();
        /*if(!isset($_SESSION))
            session_start();
        $_SESSION['cart'][$id] = $cant;*/
        return MoneyParser::parseFancy($this->getAmount());
    }
    public function deleteProduct($id){
        /*if(!isset($_SESSION))
            session_start();
        unset($_SESSION['cart'][$id]);*/
        Cart::find(Session::get('cliente').$id)->delete();
        return MoneyParser::parseFancy($this->getAmount());
    }
    public function getProducts()
    {
        return Cart::all();
        /*
        if(!isset($_SESSION))
            session_start();
        if(isset($_SESSION['cart']))
            return $_SESSION['cart'];
            */
    }
    public function addProduct($id, $cant)
    {
        if(!Session::logedIn('cliente')){
            return "nouser";
        }
        $product = Cart::find(Session::get('cliente').$id);
        $article = Productos::find($id);
        if(!isset($product)){
            if($article->cant_max < $cant)
                return MoneyParser::parseFancy($this->getAmount())."E";
            $product = new Cart();
            $product->id_cliente = Session::get('cliente');
            $product->id_producto = $id;
            $product->id = $product->id_cliente.$product->id_producto;
            $product->cantidad = $cant;

        }else{
            if($article->cant_max < $cant+$product->cantidad){
                $product->cantidad = $article->cant_max;
                $product->save();
                return MoneyParser::parseFancy($this->getAmount())."E";
            }
            $product->cantidad += $cant;
        }
        
        $product->save(); 
        /* OLD VERSION
        if(!isset($_SESSION))
            session_start();
            if(isset($_SESSION['cart'][$id]))
                $_SESSION['cart'][$id] += $cant;
            else
                $_SESSION['cart'][$id] = $cant;*/
        return MoneyParser::parseFancy($this->getAmount());
    }
}
