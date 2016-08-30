<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = array('name');
	protected $table    = 'products';
    protected $guarded  = ['_token'];
    public static $rules = [
    	'name'	=>  'required|unique:products|max:255',
    ];
}
