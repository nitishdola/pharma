<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Product, App\StockOut;
class StockOutController extends Controller
{
    public function dispatch() {
    	$products    = ['0'=>'Select Product'] + Product::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();
	    return view('stocks.out.dispatch', compact('products'));
    }

    public function store(Request $request) { 
    	$validator = Validator::make($data = $request->all(), StockIn::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
    	$message = '';
    	if(StockIn::create($data)) {
    		//update product table
    		$product = Product::findOrFail($data['product_id']);

    		$current_stock = $product->stock_in_hand;

    		$updated_stock = $current_stock + $data['quanity'];

    		$product->stock_in_hand = $updated_stock;

    		$product->save();

            $message .= 'Stock added successfully !';
        }else{
            $message .= 'Unable to add Stock !';
        }
        return Redirect::route('stock.receive')->with('message', $message);
    }
}
