<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $fillable = array('product_id', 'receive_date', 'unit_cost', 'quanity', 'total_cost');
	protected $table    = 'stock_ins';
    protected $guarded  = ['_token'];
    public static $rules = [
        'product_id'		=> 'required|exists:products,id',
    	'receive_date'		=>  'required|date|date_format:Y-m-d',
    	'unit_cost'	    	=>  'required|numeric',
    	'quanity'			=>  'required|numeric',
    	'total_cost'		=>  'required|numeric',
    ];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
