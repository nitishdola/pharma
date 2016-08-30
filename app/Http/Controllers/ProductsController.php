<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Product;

class ProductsController extends Controller
{
    public function create() {
	   return view('master.products.create');
    }
    public function store(Request $request) {
    	$validator = Validator::make($data = $request->all(), Product::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
    	$message = '';
    	if(Product::create($data)) {
            $message .= 'Product added successfully !';
        }else{
            $message .= 'Unable to add Product !';
        }
        return Redirect::route('product.create')->with('message', $message);
    }
}
