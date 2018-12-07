<?php

/**
 * @param $max_number
 * @return array
 */
function getPrimes($max_number)
{
    $primes = [];
    $is_composite = [];
    for ($i=4; $i<=$max_number; $i+=2){
        $is_composite[$i] = true;
    }
    $next_prime = 3;
    while ($next_prime <= (int)sqrt($max_number)){
        for ($i=$next_prime * 2; $i<=$max_number; $i += $next_prime){
            $is_composite[$i] = true;
        }
        $next_prime += 2;
        while ($next_prime<=$max_number && isset($is_composite[$next_prime])){
            $next_prime +=2;
        }
    }
    for ($i=2; $i<=$max_number; $i++){
        if (!isset($is_composite[$i]))
            $primes[] = $i;
    }
    return $primes;
}

/**
 * @param $number
 * @return bool
 */
function isPrime($number)
{
    if ($number == 2)
        return true;
    if ($number % 2 == 0)
        return false;
    $i = 3;
    $max_factor = (int)sqrt($number);
    while ($i <= $max_factor){
        if ($number % $i == 0)
            return false;
        $i += 2;
    }
    return true;
}

$startTime = microtime(true);

$limit = 1000000;
$numberOfPrimes = 0;
$primes = getPrimes($limit);

$arrPrimeSum[0] = 0;

for ($i = 0; $i < count($primes); $i++) {
    $arrPrimeSum[$i+1] = $arrPrimeSum[$i] + $primes[$i];
}

for ($i = $numberOfPrimes; $i < count($arrPrimeSum); $i++) {
    for ($j = $i - ($numberOfPrimes + 1); $j >= 0; $j--) {
        if ($arrPrimeSum[$i] - $arrPrimeSum[$j] > $limit) {
            break;
        }

        $element = array_search($arrPrimeSum[$i] - $arrPrimeSum[$j], $primes);

        if ($element !== false) {
            $numberOfPrimes = $i - $j;
            $result = $arrPrimeSum[$i] - $arrPrimeSum[$j];

        }
    }
}
echo 'Time: ' . (microtime(true) - $startTime) . "\n";
echo 'Length: ' . $numberOfPrimes . "\n";
echo 'Result: ' . $result . "\n";
