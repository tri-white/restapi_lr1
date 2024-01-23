<?php

namespace App\Helpers;

if(!function_exists('alert')){
    function alert(string $text){
        session(['alert'=>$text]);
    }
}