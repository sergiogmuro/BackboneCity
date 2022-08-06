<?php

namespace App\Helpers;

class Helpers
{
    public static function formatString($string) : string
    {
        return strtoupper(self::stripAccents(utf8_encode($string)));
    }

   public static function stripAccents($str) {
       return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
   }
}
