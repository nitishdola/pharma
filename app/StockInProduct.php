<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockInProduct extends Model
{
    protected $fillable = array('stock_in_id', 'product_id', 'batch_number', 'expiry_date', 'unit_cost', 'mrp', 'quanity', 'total_cost');
	protected $table    = 'stock_in_products';
    protected $guarded  = ['_token'];
    public static $rules = [
    	'stock_in_id'		=> 'required|exists:stock_ins,id',
        'product_id'		=> 'required|exists:products,id',
        'batch_number'      =>  'required',
    	'expiry_date'       =>  'required|date|date_format:Y-m-d',
    	'unit_cost'	    	=>  'required|numeric',
    	'quanity'			=>  'required|numeric',
    	'total_cost'		=>  'required|numeric',
    ];

    public function stock_in() {
        return $this->belongsTo('App\StockIn', 'stock_in_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
