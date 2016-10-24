<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = array('company_id', 'name', 'unit', 'mrp', 'trade', 'stock_in_hand');
	protected $table    = 'products';
    protected $guarded  = ['_token'];
    public static $rules = [
        'company_id'=> 'required|exists:companies,id',
    	'name'		=>  'required|max:255',
    	'unit'	    =>  'required|max:255',
    	'mrp'		=>  'required|max:255',
    	'trade'		=>  'required|max:255',
    	'stock_in_hand' => 'required|max:255',
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
