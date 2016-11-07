<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $fillable = array('receive_date', 'receipt_number', 'party_name', 'party_address');
	protected $table    = 'stock_ins';
    protected $guarded  = ['_token'];
    public static $rules = [
    	'receive_date'		=>  'required|date|date_format:Y-m-d',
    	'receipt_number'	=>  'required|max:15',
    	'party_name'		=>  'required|max:50',
    	'party_address'		=>  'required|max:100',
    ];
}
