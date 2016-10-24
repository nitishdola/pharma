<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

class StockInController extends Controller
{
    public function receive() {
    	$products    = ['0'=>'Select Product'] + Product::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();
	    return view('stocks.in.receive', compact('products'));
    }
}
