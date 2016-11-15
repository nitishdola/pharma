<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\StockOut, App\Company, App\Product, App\StockOutProduct;

use DB, Validator, Redirect, Auth, Crypt;

class StockOutController extends Controller
{
    public function create() {
        $companies    = Company::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();

    	$products    = ['0'=>'Select Product'] + Product::whereStatus(1)->orderBy('name', 'DESC')->lists('name', 'id')->toArray();

    	$last_receipt_number = StockOut::orderBy('id', 'DESC')->first();

        if($last_receipt_number) {
            $last_receipt_number = $last_receipt_number->receipt_number;
            $last_receipt_arr = explode('/', $last_receipt_number);
            $digit = $last_receipt_arr[2]+1;
        }else{
            $digit = 1;
        }

        $receipt_number = 'SDD/DIS/'.$digit.'/'.date('y');

	    return view('stocks.out.dispatch', compact('products', 'receipt_number', 'companies'));
    }
    public function store(Request $request) {
    	$message = '';
        $data = $request->all();
        $count = 0;

        $validator = Validator::make($data, StockOut::$rules); 
        if ($validator->fails())  return Redirect::back();
 
        DB::beginTransaction(); 
        $stock_out = StockOut::create($data);
        $data['stock_out_id'] = $stock_out->id;
        if(count($request->product_id)) {
            for ($i=0; $i < count($request->product_id) ; $i++) {
                $data['product_id'] = $request->product_id[$i];
                $data['expiry_date'] = $request->expiry_date[$i];
                $data['batch_number'] = $request->batch_number[$i];
                $data['quanity']    = $request->quanity[$i];
                $data['free']  = $request->free[$i];
                $data['unit_cost']  = $request->unit_cost[$i];
                $data['flat_rate']  = $request->flat_rate[$i];
                $data['total_cost'] = $request->total_cost[$i];

                $validator = Validator::make($data, StockOutProduct::$rules);
                if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

                if(StockOutProduct::create($data)) {
                    //update product table
                    $product = Product::findOrFail($data['product_id']);

                    $current_stock = $product->stock_in_hand;

                    $updated_stock = $current_stock - $data['quanity'];

                    if($data['free'] != '' || $data['free'] != 0) {
                    	$updated_stock = $current_stock - $data['free'];
                    }

                    $product->stock_in_hand = $updated_stock;

                    $product->save();

                    $count++;
                }


            }
            
        }
        DB::commit();
        $message .= $count.' products dispatched !';

        return Redirect::route('stock_dispatch.receipt',$stock_out->id )->with('message', $message);
    }

    public function view_bill( $stock_out_id = NULL) {
        $info = StockOut::findOrFail( $stock_out_id );
        $products = StockOutProduct::whereStockOutId($stock_out_id)->with('product')->get();
        $total = 0;
        foreach($products as $k => $v) {
            $total += $v->total_cost;
        }

        $grand_total = $vat = $special_discount = 0;
        if($info->avat != '' && $info->avat != 0) {
            $vat = ( $info->avat/100 )*$total;
        }

        if($info->special_discount != '' && $info->special_discount != 0) {
            $special_discount = $info->special_discount;
        }

        $grand_total = $total + $vat - $special_discount;

        $grand_total = number_format((float)$grand_total, 2, '.', '');

        $total_in_text = $this->convertNumber($grand_total);
        return view('stocks.out.receipt', compact('info', 'products', 'total', 'total_in_text', 'grand_total'));
    }

    public function report(Request $request) {
        $where = [];

        $dispatch_date_from = '1970-01-01';
        $dispatch_date_to   = date('Y-m-d');

        $party_name = '';

        if($request->dispatch_date_from != '') {
            $dispatch_date_from = $request->dispatch_date_from;
        } 

        if($request->dispatch_date_to != '') {
            $dispatch_date_to = $request->dispatch_date_to;
        }

        if($request->receipt_number != '') {
            $where['receipt_number'] = $request->receipt_number;
        }

        if($request->party_name != '') {
            $party_name = $request->party_name;
        }

        $results = StockOut::where($where)->where('dispatch_date', '>=', $dispatch_date_from)->where('dispatch_date', '<=', $dispatch_date_to)->where('party_name', 'LIKE', '%'.$party_name.'%')->orderBy('dispatch_date', 'DESC')->paginate(50);
        return view('stocks.out.report', compact('results'));
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
        } else if ($digit1 == "1") {
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
