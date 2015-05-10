<?php

class URLShortener {

    const BASE62_ALPHABET = '0123456789abcdefghjklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    const BASE = 64;

    public static function encode($num) {
        $str = '';
        while ($num > 0) {
            $str = substr(self::BASE62_ALPHABET, ($num % self::BASE), 1) . $str;
            $num = floor($num / self::BASE);
        }
        return $str;
    }

    public static function decode($str) {
        $num = 0;
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $num = $num * self::BASE + strpos(self::BASE62_ALPHABET, $str[$i]);
        }
        return $num;
    }

} 