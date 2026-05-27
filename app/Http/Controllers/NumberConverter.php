<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Converter;  //← matches your model class name

class NumberConverter extends Controller
{
    public function view_number_converter() {
        return view('view_number_converter');
    }

    public function convert(Request $request) {
        $input = trim($request->input('value'));
        $model = new Converter();

        if (is_numeric($input)) {
            $words  = $model->numberToWords($input);
            $number = $input;
        } else {
            $number = $model->wordsToNumber($input);
            $words  = $input;
        }

        $usd = $model->convertToUSD($number); // ← moved here, after $number is set

        return view('view_number_converter', [
            'input'  => $input,
            'words'  => $words,
            'number' => $number,
            'usd'    => $usd,
        ]);
    }
}