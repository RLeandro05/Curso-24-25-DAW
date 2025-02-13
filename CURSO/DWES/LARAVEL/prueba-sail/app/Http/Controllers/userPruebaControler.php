<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class userPruebaControler extends Controller
{
    public function quienesSomos(){
        $nombres = ['Maria', 'Juan', 'Pedro'];
        return view('quienesSomos', ['nombres' => $nombres]);
    }
}
