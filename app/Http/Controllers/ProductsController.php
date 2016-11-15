<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Product, App\Company;
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
        return Redirect::route('product.index')->with('message', $message);
    }

    public function index() {
        $products = Product::whereStatus(1)->orderBy('name')->with('company')->paginate(30);
        return view('master.products.index', compact('products'));
    }

    public function edit($id = NULL) {
        $companies  = Company::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();
        $product    = Product::findOrFail($id);
        return view('master.products.edit', compact('companies', 'product'));
    }

    public function update(Request $request, $id) { 
        $validator = Validator::make($data = $request->all(), Product::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
        $message = '';
        $product    = Product::findOrFail($id);
        $data = $product->fill($data);
        if($product->save()) {
            $message .= 'Product updated successfully !';
        }else{
            $message .= 'Unable to update product !';
        }
        return Redirect::route('product.index')->with('message', $message);
    }
}
