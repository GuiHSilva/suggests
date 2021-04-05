<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait Toolkit {

    public static function route(string $rota){
        if (Route::has($rota))
        {
            return route($rota);
        }
        return '#';
    }

    public static function numberAbbreviation(int $n){

        if ($n >= 100) {
            return '100+';
        } else {
            return $n;
        }

    }

}
