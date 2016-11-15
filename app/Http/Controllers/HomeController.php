<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Product, App\Company, App\StockIn,App\StockOut;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::whereStatus(1)->orderBy('name')->get();
        $stock_in_bills = StockIn::where('status',1)->orderBy('receive_date', 'DESC')->with('company')->take(5)->get();

        $stock_out_bills = StockOut::with('company')->orderBy('dispatch_date', 'DESC')->take(5)->get();
        return view('home', compact('products', 'stock_in_bills', 'stock_out_bills'));
    }
}
