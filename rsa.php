<?php
session_start();

if (!isset($_POST['action']))
    header('location: ./');

function str_split_unicode($str, $l = 0)
{
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, 'UTF-8');
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, 'UTF-8');
        }
        return $ret;
    }
    return preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
}

function get_primes($n)
{
    $primes = [];
    $last = 1;
    for ($i = 0; $i < $n; $i++) {
        $last = gmp_nextprime($last);
        $primes[] = $last;
    }
    return $primes;
}

function generate()
{
    $primes = get_primes(100);

    $p = 7;
    $q = 17;

    while ($p == $q || $p * $q < 256) {
        $p = $primes[rand(0, count($primes) - 1)];
        $q = $primes[rand(0, count($primes) - 1)];
    }

    $N = $p * $q;
    $b = ($p - 1) * ($q - 1);

    $e = 2;
    while (gmp_gcd($b, $e) != 1) $e++;

    $d = 2;
    while (($d * $e) % $b != 1) $d++;

    return [$N, $e, $d];
}

$action = $_POST['action'];

if ($action == 'generate' || (($action == 'crypt' || $action == 'decrypt') && (!isset($_SESSION['public_key']) || !isset($_SESSION['private_key'])))) {

    $keys = generate();

    $_SESSION['public_key'] = array_slice($keys, 0, 2);
    $_SESSION['private_key'] = [$keys[0], $keys[2]];

    unset($_SESSION['message']);
}

if ($action == 'crypt' && isset($_POST['tocrypt']) && $_POST['tocrypt'] != '') {

    $message = str_split_unicode($_POST['tocrypt']);
    $encrypted = '';

    foreach ($message as $char)
        $encrypted = mb_chr(gmp_intval(gmp_mod(gmp_pow(mb_ord($char), $_SESSION['public_key'][1]), $_SESSION['public_key'][0])));

    $_SESSION['message'] = base64_encode($encrypted);
} else if ($action == 'decrypt' && isset($_POST['todecrypt']) && $_POST['todecrypt'] != '') {

    $message = str_split_unicode(base64_decode($_POST['todecrypt']));
    $decrypted = '';

    foreach ($message as $char)
        $decrypted = mb_chr(gmp_intval(gmp_mod(gmp_pow(mb_ord($char), $_SESSION['private_key'][1]), $_SESSION['public_key'][0])));

    $_SESSION['message'] = $decrypted;
}
//header('location: ./');
