<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = array('name');
	protected $table    = 'companies';
    protected $guarded  = ['_token'];
    public static $rules = [
    	'name'	=>  'required|unique:companies|max:255',
    ];

}
