<?php
session_start();

if (!isset($_POST['action']))
    header('location: ./');

function gcd($a, $b)
{
    if ($b == 0)
        return $a;
    return gcd($b, $a % $b);
}

function generate()
{
    $primes = [2, 3, 5, 7, 11, 13, 17];

    $p = 0;
    $q = 0;

    while ($p == $q) {
        $p = $primes[rand(0, count($primes) - 1)];
        $q = $primes[rand(0, count($primes) - 1)];
    }

    $N = $p * $q;
    $b = ($p - 1) * ($q - 1);

    $e = 2;
    while (gcd($e, $b) != 1) $e++;

    $d = 2;
    while (($d * $e) % $b != 1) $d++;

    return [$N, $e, $d];
}

$action = $_POST['action'];

if ($action == 'generate') {
} else if ($action == 'crypt') {
} else if ($action == 'decrypt') {
} else
    header('location: ./');