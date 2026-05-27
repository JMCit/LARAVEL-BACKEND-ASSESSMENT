<?php

namespace App\Models;

class Converter
{
    //
    private $ones = [
        'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
        'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
        'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    ];

    private $tens = [
        '', '', 'twenty', 'thirty', 'forty', 'fifty',
        'sixty', 'seventy', 'eighty', 'ninety'
    ];

    public function numberToWords($n) {
        if ($n < 20)
            return $this->ones[$n];

        if ($n < 100)
            return $this->tens[intval($n / 10)]
                   . ($n % 10 ? ' ' . $this->ones[$n % 10] : '');

        if ($n < 1000)
            return $this->ones[intval($n / 100)] . ' hundred'
                   . ($n % 100 ? ' and ' . $this->numberToWords($n % 100) : '');

        if ($n < 1000000)
            return $this->numberToWords(intval($n / 1000)) . ' thousand'
                   . ($n % 1000 ? ' ' . $this->numberToWords($n % 1000) : '');

        return 'number too large';
    }

    public function wordsToNumber($words) {
        $words = strtolower(trim($words));
        $words = str_replace(' and ', ' ', $words);
        $tokens = explode(' ', $words);

        $total   = 0;
        $current = 0;

        $lookup = [
            'zero'=>0,'one'=>1,'two'=>2,'three'=>3,'four'=>4,'five'=>5,
            'six'=>6,'seven'=>7,'eight'=>8,'nine'=>9,'ten'=>10,
            'eleven'=>11,'twelve'=>12,'thirteen'=>13,'fourteen'=>14,
            'fifteen'=>15,'sixteen'=>16,'seventeen'=>17,'eighteen'=>18,
            'nineteen'=>19,'twenty'=>20,'thirty'=>30,'forty'=>40,
            'fifty'=>50,'sixty'=>60,'seventy'=>70,'eighty'=>80,'ninety'=>90
        ];

        foreach ($tokens as $token) {
            if (isset($lookup[$token]))
                $current += $lookup[$token];
            elseif ($token == 'hundred')
                $current *= 100;
            elseif ($token == 'thousand') {
                $total  += $current * 1000;
                $current = 0;
            }
        }

        return $total + $current;
    }

    public function convertToUSD($number) {
        $apiKey   = '479d616d53cc5c7a5ee1010e';
        $response = file_get_contents("https://v6.exchangerate-api.com/v6/{$apiKey}/pair/PHP/USD");
        $data     = json_decode($response, true);
        $rate     = $data['conversion_rate'];
        $usd      = $number * $rate;

        return round($usd, 2);
    }
}
