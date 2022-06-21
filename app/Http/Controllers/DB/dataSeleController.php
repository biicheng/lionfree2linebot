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
            $d = DB::table('botudata')->get();
            $data['data'] = $d;
            $data['code'] = 1;
        }
        catch(\Exception $exception){
            $data['data'] = $data;
            $data['code'] = 0;
        }
        return $data;
    }
    
    public function seleImgMaps($type){
        $imgD = [];
        try{
            $imgD = DB::table('botimgmaps')->where([
                ['imgName','!=',''],
                ['imgType','=',$type],
                ['op','=',1]
            ])->get();
        }
        catch(\Exception $exception){
        }
        return $imgD;
    }
    
    //check data
    public function seleCheckImg($str){
        $imgD = [];
        try{
            return $imgD = DB::table('botimgmaps')->where('imgName','=',$str)->get();
        }
        catch(\Exception $exception){
            return 'err';
        }
    }
}
