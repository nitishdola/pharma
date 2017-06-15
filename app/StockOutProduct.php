<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOutProduct extends Model
{
    protected $fillable = array('stock_out_id', 'product_id', 'expiry_date', 'batch_number', 'quanity', 'free', 'unit_cost', 'flat_rate', 'mrp',  'total_cost');
	protected $table    = 'stock_out_products';
    protected $guarded  = ['_token'];
    public static $rules = [
    	'stock_out_id'		=>  'required|exists:stock_outs,id',
        'product_id'		=>  'required|exists:products,id',
    	'expiry_date'		=>  'required|date|date_format:Y-m-d',
    	'batch_number' 		=>  'required',
    	'free'			    =>  'numeric',
    	'unit_cost'	    	=>  'required|numeric',
    	'flat_rate'	    	=>  'numeric',
    	'quanity'			=>  'required|numeric',
    	'total_cost'		=>  'required|numeric',
    ];

    public function stock_out() {
        return $this->belongsTo('App\StockOut', 'stock_out_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
