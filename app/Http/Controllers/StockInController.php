<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Product, App\StockIn;

class StockInController extends Controller
{
    public function receive() {
    	$products    = ['0'=>'Select Product'] + Product::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();
	    return view('stocks.in.receive', compact('products'));
    }

    public function store(Request $request) { 
    	$message = '';
        $data = $request->all();
        $count = 0;

        if(count($request->product_id)) {
            for ($i=0; $i < count($request->product_id) ; $i++) {

                $data['product_id'] = $request->product_id[$i];
                $data['unit_cost']  = $request->unit_cost[$i];
                $data['quanity']    = $request->quanity[$i];
                $data['total_cost'] = $request->total_cost[$i];

                $validator = Validator::make($data, StockIn::$rules);
                if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

                if(StockIn::create($data)) {
                    //update product table
                    $product = Product::findOrFail($data['product_id']);

                    $current_stock = $product->stock_in_hand;

                    $updated_stock = $current_stock + $data['quanity'];

                    $product->stock_in_hand = $updated_stock;

                    $product->save();

                    $count++;
                }


            }
            
        }

        $message .= $count.' products received !';

        return Redirect::route('stock.receive')->with('message', $message);
    }
}
