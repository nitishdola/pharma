<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Product, App\Company, App\StockIn,App\StockInProduct;

class StockInController extends Controller
{
    public function index(Request $request) {
        $where = [];
        $data_from  = '1970-01-01';
        $data_to    = date('Y-m-d');

        if($request->company_id) {

        }

        if($request->receipt_number) {
            
        }

        if($request->data_from) {
            $data_from = $request->data_from;
        } 

        if($request->data_to) {
            $data_to = $request->data_to;
        }    

        $stock_in_bills = StockIn::where($where)->paginate(50);

        return view('stocks.in.index', compact('stock_in_bills'));
    }


    public function receive() {
        $companies    = Company::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();

    	$products    = ['0'=>'Select Product'] + Product::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();
        $last_receipt_number = StockIn::orderBy('id', 'DESC')->first();

        if($last_receipt_number) {
            $last_receipt_number = $last_receipt_number->receipt_number;
            $last_receipt_arr = explode('/', $last_receipt_number);
            $digit = $last_receipt_arr[1]+1;
        }else{
            $digit = 1;
        }

        $receipt_number = 'SDD/'.$digit.'/'.date('y');

	    return view('stocks.in.receive', compact('products', 'receipt_number', 'companies'));
    }

    public function store(Request $request) { 
    	$message = '';
        $data = $request->all();
        $count = 0;

        $validator = Validator::make($data, StockIn::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        DB::beginTransaction();
        $stock_in = StockIn::create($data);

        $data['stock_in_id'] = $stock_in->id;
        if(count($request->product_id)) {
            for ($i=0; $i < count($request->product_id) ; $i++) {
                if($request->product_id[$i] != 0 && $request->quanity[$i] != ''){
                    $data['product_id'] = $request->product_id[$i];

                    $data['expiry_date'] = $request->expiry_date[$i];
                    $data['batch_number'] = $request->batch_number[$i];

                    $data['unit_cost']  = $request->unit_cost[$i];
					$data['mrp']  		= $request->mrp[$i];
                    $data['quanity']    = $request->quanity[$i];
                    $data['total_cost'] = $request->total_cost[$i];

                    $validator = Validator::make($data, StockInProduct::$rules);
                    if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

                    if(StockInProduct::create($data)) {
                        //update product table
                        $product = Product::findOrFail($data['product_id']);

                        $current_stock = $product->stock_in_hand;

                        $updated_stock = $current_stock + $data['quanity'];

                        $product->stock_in_hand = $updated_stock;

                        $product->save();

                        $count++;
                    }
                }

            }
            
        }
        DB::commit();
        $message .= $count.' products received !';

        return Redirect::route('stock.receipt',$stock_in->id )->with('message', $message);
    }

    public function view_bill( $stock_in_id = NULL) {
        $info = StockIn::findOrFail( $stock_in_id );
        $products = StockInProduct::whereStockInId($stock_in_id)->with('product')->get();
        $total = 0;
        foreach($products as $k => $v) {
            $total += $v->total_cost;
        }

        $total = number_format((float)$total, 2, '.', '');

        $total_in_text = $this->convertNumber($total);
        return view('stocks.in.receipt', compact('info', 'products', 'total', 'total_in_text'));
    }

    public function report(Request $request) {
        $where = [];

        $receive_date_from = '1970-01-01';
        $receive_date_to   = date('Y-m-d', strtotime('+1 year'));

        $party_name = '';

        if($request->receive_date_from != '') {
            $receive_date_from = $request->receive_date_from;
        } 

        if($request->receive_date_to != '') {
            $receive_date_to = $request->receive_date_to;
        }

        if($request->receipt_number != '') {
            $where['receipt_number'] = $request->receipt_number;
        }

        if($request->party_bill_number != '') {
            $where['party_bill_number'] = $request->party_bill_number;
        }

        if($request->party_bill_date != '') {
            $where['party_bill_date'] = $request->party_bill_date;
        }

        if($request->party_name != '') {
            $party_name = $request->party_name;
        }

        if($party_name != '') {
            $results = StockIn::where($where)->where('receive_date', '>=', $receive_date_from)->where('receive_date', '<=', $receive_date_to)->where('party_name', 'LIKE', '%'.$party_name.'%')->orderBy('receive_date', 'DESC')->paginate(30);
        }else{
            $results = StockIn::where($where)->where('receive_date', '>=', $receive_date_from)->where('receive_date', '<=', $receive_date_to)->orderBy('receive_date', 'DESC')->paginate(30);
        }
        
        
        return view('stocks.in.report', compact('results'));
    }

    private function convertNumber($number)
    {
        list($integer, $fraction) = explode(".", (string) $number);

        $output = "";

        if ($integer{0} == "-")
        {
            $output = "negative ";
            $integer    = ltrim($integer, "-");
        }
        else if ($integer{0} == "+")
        {
            $output = "positive ";
            $integer    = ltrim($integer, "+");
        }

        if ($integer{0} == "0")
        {
            $output .= "zero";
        }
        else
        {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g)
            {
                $groups2[] = $this->convertThreeDigit($g{0}, $g{1}, $g{2});
            }

            for ($z = 0; $z < count($groups2); $z++)
            {
                if ($groups2[$z] != "")
                {
                    $output .= $groups2[$z] . $this->convertGroup(11 - $z) . (
                            $z < 11
                            && !array_search('', array_slice($groups2, $z + 1, -1))
                            && $groups2[11] != ''
                            && $groups[11]{0} == '0'
                                ? " and "
                                : ", "
                        );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0)
        {
            $output .= " point";
            for ($i = 0; $i < strlen($fraction); $i++)
            {
                $output .= " " . $this->convertDigit($fraction{$i});
            }
        }

        return $output;
    }

    private function convertGroup($index)
    {
        switch ($index)
        {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    private function convertThreeDigit($digit1, $digit2, $digit3)
    {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
        {
            return "";
        }

        if ($digit1 != "0")
        {
            $buffer .= $this->convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0")
            {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0")
        {
            $buffer .= $this->convertTwoDigit($digit2, $digit3);
        }
        else if ($digit3 != "0")
        {
            $buffer .= $this->convertDigit($digit3);
        }

        return $buffer;
    }

    private function convertTwoDigit($digit1, $digit2)
    {
        if ($digit2 == "0")
        {
            switch ($digit1)
            {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1")
        {
            switch ($digit2)
            {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else
        {
            $temp = $this->convertDigit($digit2);
            switch ($digit1)
            {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    private function convertDigit($digit)
    {
        switch ($digit)
        {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }


}
