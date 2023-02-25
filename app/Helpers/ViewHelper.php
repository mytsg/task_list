<?php

namespace App\Helpers;

class ViewHelper {
    public static function getYearFromTimestamp($timestamp) :int
    {
        $y = date('Y',$timestamp);
        return $y;
    }

    public static function getMonthFromTimestamp($timestamp) :int
    {
        $m = date('m',$timestamp);
        return $m;
    }

    public static function getDateFromTimestamp($timestamp) :int
    {
        $d = date('d',$timestamp);
        return $d;
    }

    
}