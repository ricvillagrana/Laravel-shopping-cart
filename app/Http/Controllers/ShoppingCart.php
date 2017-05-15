<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use Session;
use App\MoneyParser;

class ShoppingCart extends Controller
{
    public function getAmount(){
        if(!isset($_SESSION))
            session_start();
        $total = 0;
        //Session::put('cart', array(1,2,4,2,5));
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            $keys = array_keys($cart);
            foreach ($keys as $key) {
                $total += Productos::find($key)->precio * $cart[$key];
            }
        }else
            $cart = null;
        return $total;
    }
    public function delCart(){
        if(!isset($_SESSION))
            session_start();
        $_SESSION['cart'] = null;
        return MoneyParser::parseFancy($this->getAmount());
    }
    public function editProduct($id, $cant){
        if(!isset($_SESSION))
            session_start();
        $_SESSION['cart'][$id] = $cant;
        return MoneyParser::parseFancy($this->getAmount());
    }
    public function deleteProduct($id){
        if(!isset($_SESSION))
            session_start();
        unset($_SESSION['cart'][$id]);
        return MoneyParser::parseFancy($this->getAmount());
    }
    public function getProducts()
    {
        if(!isset($_SESSION))
            session_start();
        if(isset($_SESSION['cart']))
            return $_SESSION['cart'];
    }
    public function addProduct($id, $cant)
    {
        if(!isset($_SESSION))
            session_start();
            if(isset($_SESSION['cart'][$id]))
                $_SESSION['cart'][$id] += $cant;
            else
                $_SESSION['cart'][$id] = $cant;
        return MoneyParser::parseFancy($this->getAmount());
    }
}
