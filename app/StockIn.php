<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $fillable = array('company_id', 'mrp', 'receive_date', 'receipt_number', 'party_name', 'party_address', 'party_dl', 'party_bill_number', 'party_bill_date');
	protected $table    = 'stock_ins';
    protected $guarded  = ['_token'];
    public static $rules = [ 
        'company_id'        =>  'required|exists:companies,id',
    	'receive_date'		=>  'required|date|date_format:Y-m-d',
    	'receipt_number'	=>  'required|max:15',
    	'party_name'		=>  'required|max:50',
    	'party_address'		=>  'required|max:100',
        'party_dl'          => 'required',
        'party_bill_number' => 'required',
        'party_bill_date'   => 'required|date|date_format:Y-m-d'
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
