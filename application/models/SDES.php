<?php
class Model_SDES
{
    private static $permutation10 = array(2, 4, 1, 6, 3, 9, 0, 8, 7, 5);
    private static $initialPermutation = array(1, 5, 2, 0, 3, 7, 4, 6);
    private static $inverseInitialPermutation = array(3, 0, 2, 4, 6, 1, 7, 5);
    private static $permutation8 = array(5, 2, 6, 3, 7, 4, 9, 8);
    private static $permutation4 = array(1, 3, 2, 0);
    private static $expansionPermutation = array(3, 0, 1, 2, 1, 2, 3, 0);
    private static $key = "1010000010";
    private static $s0 = array(array("01", "00", "11", "10"), 
    array("11", "10", "01", "00"), array("00", "10", "01", "11"), 
    array("11", "01", "11", "10"));
    private static $s1 = array(array("00", "01", "10", "11"), 
    array("10", "00", "01", "11"), array("11", "00", "01", "00"), 
    array("10", "01", "00", "11"));
    public static function encrypt ($input, $keys = array())
    {
        if (count($keys) != 2) {
            $keys = self::generateKeys(self::$key);
        }
        $step1 = self::permutate($input, self::$initialPermutation);
        $step2 = self::permutate(substr($step1, 4, 4), 
        self::$expansionPermutation, false);
        $step3 = self::excusiveOr($step2, $keys[0]);
        $step4 = self::s0box($step3);
        $step5 = self::s1box($step3);
    }
    public static function decrypt ($input)
    {}
    public static function isValidBinary ($binary)
    {
        return preg_match("/^[01]*$/", $binary);
    }
    public static function isValidPermuation ($permutation)
    {
        for ($i = 0; $i < count($permutation); $i ++) {
            if (! in_array($i, $permutation)) {
                return false;
            }
        }
        return true;
    }
    public static function permutate ($input, $permutation, $checkPerm = true)
    {
        if (! is_array($permutation)) {
            throw new Exception('Invalid permutation format');
        }
        $input = str_split($input);
        if ($checkPerm &&
         ((count($input) != count($permutation)) &&
         (self::isValidPermuation($permutation)))) {
            throw new Exception('Invalid sizes');
        } else {
            $result = array();
            for ($i = 0; $i < count($permutation); $i ++) {
                $result[$i] = $input[$permutation[$i]];
            }
            return implode('', $result);
        }
    }
    public static function generateKeys ($input)
    {
        $result = array();
        $step1 = self::permutate($input, self::$permutation10);
        $step2 = self::shift($step1);
        $result[] = self::permutate($step2, self::$permutation8);
        $step3 = self::shift($step2);
        $result[] = self::permutate($step3, self::$permutation8);
        return result;
    }
    public static function shift ($input, $left = true)
    {
        $result = array();
        $input = str_split($input);
        for ($i = 0; $i < count($input); $i ++) {
            if (left) {
                $newIndex = ($i + count($input) - 1) % count($input);
                $result[$newIndex] = $input[$i];
            } else {
                $newIndex = ($i + 1) % count($input);
                $result[$newIndex] = $input[$i];
            }
        }
        return $result;
    }
    public static function swap ($input)
    {
        return substr($input, 4, 4) . substr($input, 0, 4);
    }
    public static function s0box ($input)
    {
        $input = str_split($input);
        $row = bindec($input[0] . $input[3]);
        $col = bindec($input[1] . $input[2]);
        return self::$s0[$row][$col];
    }
    public static function s1box ($input)
    {
        $input = str_split($input);
        $row = bindec($input[0] . $input[3]);
        $col = bindec($input[1] . $input[2]);
        return self::$s1[$row][$column];
    }
    public static function excusiveOr ($string1, $string2)
    {
        $string1 = str_split($string1);
        $string2 = str_split($string2);
        if (count($string1) != count($string2)) {
            throw new Exception('Not matching lengths');
        }
        $result = array();
        for ($i = 0; $i < count($string1); $i ++) {
            if (($string1[$i] == '1' && $string2[$i] == '0') ||
             ($string1[$i] == '0' && $string2[$i] == '1')) {
                $result[$i] = '1';
            } else {
                $result[$i] = '0';
            }
        }
        return implode('', $result);
    }
}