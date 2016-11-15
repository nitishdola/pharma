<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

class RestController extends Controller
{
    public function get_product_info() {
    	if(isset($_GET['product_id']) && $_GET['product_id'] != '') {
    		return Product::findOrFail($_GET['product_id']);
    	}
    }
}
