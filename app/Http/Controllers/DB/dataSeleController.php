<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//20220525

class dataSeleController extends Controller
{
    function seleBotUser(){
        $data = [];
        try{
            \Log::info("data 1");
            $d = DB::table('botudata')->get();
            \Log::info("data 11");
            $data['data'] = $d;
            $data['code'] = 1;
        }
        catch(\Exception $exception){
            \Log::info("data 0");
            $data['code'] = 0;
        }
        return $data;
    }
}
