<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laravelErrUIController extends Controller
{
    function laravel_404(){
        return abort(404);;
    }    
}
