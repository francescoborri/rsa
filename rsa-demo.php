<?php
define('LENGHT', 10);

function gcd($a, $b)
{
    if ($b == 0)
        return $a;
    return gcd($b, $a % $b);
}

$p = 5;
$q = 7;

$N = $p * $q;
$b = ($p - 1) * ($q - 1);

$e = 2;
while (gcd($b, $e) != 1) $e++;

$d = 2;
while (($d * $e) % $b != 1) $d++;

$array = [];
$encrypted = [];
$decrypted = [];

for ($i = 0; $i < LENGHT; $i++)
    $array[] = rand(1, 10);

foreach ($array as $element)
    $encrypted[] = pow($element, $e) % $N;

foreach ($encrypted as $element)
    $decrypted[] = pow($element, $d) % $N;

echo "p: $p" . PHP_EOL;
echo "q: $q" . PHP_EOL;
echo "N: $N" . PHP_EOL;
echo "b: $b" . PHP_EOL;
echo "e: $e" . PHP_EOL;
echo "d: $d" . PHP_EOL;

echo "Originale:\t[" . implode(', ', $array) . ']' . PHP_EOL;
echo "Criptato:\t[" . implode(', ', $encrypted) . ']' . PHP_EOL;
echo "Decriptato:\t[" . implode(', ', $decrypted) . ']' . PHP_EOL;
