<?php
class Cryptography_Model_RSA
{
    public static function gcd ($a, $b)
    {
        return ($a % $b) ? self::gcd($b, $a % $b) : $b;
    }
    public static function phi ($n)
    {
        $result = 0;
        for ($i = 1; $i < $n; $i ++) {
            $ggd = self::gcd($n, $i);
            if ($ggd == 1) {
                $result ++;
            }
        }
        return $result;
    }
    public static function findPrimeFactors ($n)
    {
        $g = self::phi($n);
        $result = array();
        for ($e = 1; $e < $g; $e ++) {
            $gcd = self::gcd($e, $g);
            if ($gcd == 1) {
                $mod = $g - 1;
                for ($d = 1; $d < $g; $d ++) {
                    $mod = $d * $e % $g;
                    if ($mod == 1) {
                        $result[$e] = $d;
                    }
                }
            }
        }
        return $result;
    }
    public static function encryption ($input, $n, $e)
    {
        $n = (integer) $n;
        $result = '';
        for ($i = 0; $i < strlen($input); $i ++) {
            $cipher = ord($input{$i});
            $cipher = bcpowmod($cipher, $e, $n);
            $cipher = str_pad($cipher, strlen($n), "0", STR_PAD_LEFT);
            $result .= $cipher;
        }
        return $result;
    }
    public static function decryption ($input, $n, $d)
    {
        $n = (integer) $n;
        $result = '';
        for ($i = 0; $i < strlen($input); $i = $i + strlen($n)) {
            $cipher = (integer) substr($input, $i, strlen($n));
            $plain = bcpowmod($cipher, $d, $n);
            $plain = chr($plain);
            $result .= $plain;
        }
        return $result;
    }
}