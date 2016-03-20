<?php

class Validate extends Model {

    public static function true($variable, $message) {
        if (!$variable) throw new Exception($message);
    }

    public static function false($variable, $message) {
        if ($variable) throw new Exception($message);
    }

    public static function notNull($variable, $message) {
        if (is_null($variable)) throw new Exception($message);
    }

    public static function notEmpty($variable, $message) {
        if (empty($variable)) throw new Exception($message);
    }

    public static function isEmpty($variable, $message) {
        if (!empty($variable)) throw new Exception($message);
    }

    public static function isInteger($variable, $message) {
        if (!is_int($variable) and !ctype_digit($variable)) throw new Exception($message);
    }

    public static function min($variable, $length, $message) {
        if ((is_string($variable) and strlen($variable) < $length)
            or (is_numeric($variable) and $variable < $length)) throw new Exception($message);
    }

    public static function max($variable, $length, $message) {
        if ((is_string($variable) and strlen($variable) > $length)
            or (is_numeric($variable) and $variable > $length)) throw new Exception($message);
    }

    public static function between($variable, $length, $message) {
        $size = 0;
        if (is_string($variable)) $size = strlen($variable);
        else if (is_numeric($variable)) $size = floatval($variable);
        else return;
        if ($size < $length[0] or $size > $length[1]) throw new Exception($message);
    }

    public static function exists($variable, $message) {
        if (is_null($variable) or !$variable->exists()) throw new Exception($message);
    }

    public static function isArray($variable, $message) {
        if (!is_array($variable)) throw new Exception($message);
    }

}
