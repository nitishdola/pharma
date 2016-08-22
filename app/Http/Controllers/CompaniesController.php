<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect, Auth, Crypt;
use App\Company;

class CompaniesController extends Controller
{
    public function create() {
	return view('master.companies.create');
    }
    public function store(Request $request) {
    	$validator = Validator::make($data = $request->all(), Company::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
    	$message = '';
    	if(Company::create($data)) {
            $message .= 'Company added successfully !';
        }else{
            $message .= 'Unable to add Company !';
        }
        return Redirect::route('company.create')->with('message', $message);
    }
}
