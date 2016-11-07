<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Product, App\StockIn,App\StockInProduct;

class StockInController extends Controller
{
    public function receive() {
    	$products    = ['0'=>'Select Product'] + Product::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();
        $last_receipt_number = StockIn::orderBy('id', 'DESC')->first();

        if($last_receipt_number) {
            $last_receipt_number = $last_receipt_number->receipt_number;
            $last_receipt_arr = explode('|', $last_receipt_number);
            $digit = $last_receipt_arr[2]+1;
        }else{
            $digit = 1;
        }

        $receipt_number = 'STOCK|RCV|'.$digit;

	    return view('stocks.in.receive', compact('products', 'receipt_number'));
    }

    public function store(Request $request) { 
    	$message = '';
        $data = $request->all();
        $count = 0;

        $validator = Validator::make($data, StockIn::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        DB::beginTransaction();
        $stock_in = StockIn::create($data);

        $data['stock_in_id'] = $stock_in->id;
        if(count($request->product_id)) {
            for ($i=0; $i < count($request->product_id) ; $i++) {

                $data['product_id'] = $request->product_id[$i];
                $data['unit_cost']  = $request->unit_cost[$i];
                $data['quanity']    = $request->quanity[$i];
                $data['total_cost'] = $request->total_cost[$i];

                $validator = Validator::make($data, StockInProduct::$rules);
                if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

                if(StockInProduct::create($data)) {
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
        DB::commit();
        $message .= $count.' products received !';

        return Redirect::route('stock.receive')->with('message', $message);
    }

    public function view_bill( $stock_in_id = NULL) {
        $info = StockIn::findOrFail( $stock_in_id );
        $products = StockInProduct::whereStockInId($stock_in_id)->with('product')->get();

        return view('stocks.in.receipt', compact('info', 'products'));
    }
}
