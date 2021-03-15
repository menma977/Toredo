<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function show()
    {
        $level = level::all(["id","type","socket","share"])->sort(function ($a,$b){
            $startWith = function ($needle, $haystack){
                return substr($haystack, 0, strlen($needle)) == $needle;
            }
        });
        
    }


}
