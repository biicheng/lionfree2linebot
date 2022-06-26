<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;//20220525
use DB;

use App\Http\Controllers\LineBotT; //20220626 add
use config;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class dataSeleController extends Controller
{
    // join sele mesage
    function mesageSele(){
        DB::table('botmessage2line')
            ->leftJoin('botimgmaps', 'botmessage2line.bimg', '=', 'botimgmaps.imgNum')
            ->leftJoin('botimgmaps', 'botmessage2line.simg', '=', 'botimgmaps.imgNum')
            ->get();
    }
    
    function seleBotUser(){
        $this->updaUsetD = new LineBotT;
        $data = [];
        try{
            $d = DB::table('botudata')->get();
            $data['data'] = $d;
            $data['code'] = 1;
            foreach($d as $v){
                $dd = $this->updaUsetD->updateLineUser($v->uid);
            }
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
