<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function dashboard(){
        $products = Cart::where('product_id', '!=', null)->get();
        $services = Cart::where('service_id', '!=', null)->get();
      
      return view('frontviews.index', compact('products', 'services'));
    }
}
