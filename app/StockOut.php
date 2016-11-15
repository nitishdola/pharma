<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $fillable = array('company_id', 'dispatch_date', 'receipt_number', 'party_name', 'party_dl', 'party_address', 'avat', 'special_discount');
	protected $table    = 'stock_outs';
    protected $guarded  = ['_token'];
    public static $rules = [
        'company_id'        =>  'required|exists:companies,id',
    	'dispatch_date'		=>  'required|date|date_format:Y-m-d',	
    	'receipt_number'	=>  'required|max:15',
    	'party_name'		=>  'required|max:50',
        //'party_dl'          =>  'required|max:50',
    	'party_address'		=>  'required|max:100',
    	'avat'				=>  'required',
        
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
