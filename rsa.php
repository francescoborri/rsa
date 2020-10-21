<?php
function gcd($a, $b)
{
    if ($b == 0)
        return $a;
    return gcd($b, $a % $b);
}

$primes = [2, 3, 5, 7, 11, 13, 17];

$p = 0;
$q = 0;

while ($p == $q) {
    $p = $primes[rand(0, count($primes) - 1)];
    $q = $primes[rand(0, count($primes) - 1)];
}

echo "p: $p". PHP_EOL;
echo "q: $q". PHP_EOL;

$b = ($p - 1) * ($q - 1);

echo "b: $b". PHP_EOL;

$e = 2;
for (; gcd($e, $b) != 1; $e++);

echo "e: $e". PHP_EOL;

$d = 2;
for (; ($d * $e) % $b != 1; $d++);

echo "d: $d". PHP_EOL;