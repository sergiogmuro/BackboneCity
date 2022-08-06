<?php

namespace App\Helpers;

class Helpers
{
    public static function formatString($string) : string
    {
        return strtoupper(utf8_encode($string));
    }
}
