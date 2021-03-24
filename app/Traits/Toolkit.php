<?php

namespace App\Traits;

trait Toolkit {

    public static function numberAbbreviation(int $n){

        if ($n >= 100) {
            return '100+';
        } else {
            return $n;
        }

    }

}
