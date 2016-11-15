<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Excel;
use DB, Validator, Redirect, Auth, Crypt;
use App\StockIn, App\StockOut;


class ExcelController extends Controller
{
    public function download_stock_receive() {
    	Excel::create('StockIn', function( $excel) {
			$excel->sheet('Stok-receive-data', function($sheet) {
			  $sheet->setTitle('Pharma Soft');

			  $sheet->cells('A1:E1', function($cells) {
			    $cells->setFontWeight('bold');
			  });
			  $results = StockIn::select('party_name as PartyName', 'party_address as PartyAddress', 'party_dl as PartyDL', 'receive_date as ReceiveDate', 'receipt_number as Receipt Number')->orderBy('receive_date', 'DESC')->get()->toArray();
			  
			  $sheet->fromArray($results, null, 'A1', false, true);
			});
		})->download('xlsx');
    }

    public function download_stock_send() {
    	Excel::create('StockOut', function( $excel) {
			$excel->sheet('Stok-dispatch-data', function($sheet) {
			  $sheet->setTitle('Pharma Soft');

			  $sheet->cells('A1:E1', function($cells) {
			    $cells->setFontWeight('bold');
			  });
			  $results = StockOut::select('party_name as PartyName', 'party_address as PartyAddress', 'party_dl as PartyDL', 'dispatch_date as DispatchDate', 'receipt_number as Receipt Number', 'avat as AVAT', 'special_discount as SpecialDiscount')->orderBy('dispatch_date', 'DESC')->get()->toArray();
			  
			  $sheet->fromArray($results, null, 'A1', false, true);
			});
		})->download('xlsx');
    }
}
