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
    while ($e > $b ? gcd($e, $b) : gcd($b, $e) != 1) $e++;

    $d = 2;
    while (($d * $e) % $b != 1) $d++;

    return [$N, $e, $d];
}

$action = $_POST['action'];

if ($action == 'generate' || (($action == 'crypt' || $action == 'decrypt') && (!isset($_SESSION['public_key']) || !isset($_SESSION['private_key'])))) {
    $keys = generate();

    $_SESSION['public_key'] = array_slice($keys, 0, 2);
    $_SESSION['private_key'] = $keys[2];

    unset($_SESSION['message']);
}

if ($action == 'crypt' && isset($_POST['tocrypt']) && $_POST['tocrypt'] != '') {
    $message = str_split($_POST['tocrypt']);
    $encrypted = '';

    foreach ($message as $char) {
        $tmp = gmp_intval(gmp_mod(gmp_pow(ord($char), $_SESSION['public_key'][1]), $_SESSION['public_key'][0]));
        echo $tmp . PHP_EOL;
        $encrypted .= chr($tmp);
    }

    $_SESSION['message'] = $encrypted;
} else if ($action == 'decrypt' && isset($_POST['todecrypt']) && $_POST['todecrypt'] != '') {
    $message = str_split($_POST['todecrypt']);
    $decrypted = '';

    foreach ($message as $char) {
        $tmp = gmp_intval(gmp_mod(gmp_pow(ord($char), $_SESSION['private_key']), $_SESSION['public_key'][0]));
        echo $tmp . PHP_EOL;
        $decrypted .= chr($tmp);
    }

    $_SESSION['message'] = $decrypted;
}
//header('location: ./');
