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
    
    public function getImgMaps($type, $op){
        $imgD = [];
        $DBop = $op;
        $DBtype = $type;
        $whereArr = [];
        $whereArr[0] = ['imgName','!=',''];
        if(($DBtype=='all' || $DBtype=='b' || $DBtype=='s')&&
            ($DBop=='all' || $DBop==0 || $DBop==1)
        ){
            if($DBtype=='b' || $DBtype=='s'){ $whereArr[0] = ['imgType','=',$DBtype]; }
            if($DBop=='all' || ($op<0 && $op>1)){ 
                if($DBop!='all'){ $whereArr[0] = ['op','=',$DBop]; }
            }
            else{ $whereArr[0] = ['op','=',1]; }
    
            try{
                $imgD = DB::table('botimgmaps')->where(
                    $whereArr
                    // [
                    //     ['imgName','!=',''],
                    //     ['imgType','=',$DBtype],
                    //     ['op','=',$DBop]
                    // ]
                )->get();
            }
            catch(\Exception $exception){
                $imgD = [];
            }
            return $imgD;
        }
        else{
            return '';
        }
    }
    
    public function seleImgMaps($type){
        $imgD = [];
        $wheres = [];
        $wheres[0] = ['imgName','!=',''];
        $wheres[1] = ['op','=',1];
        if($type!=''){ $wheres[2] = ['imgType','=',$type]; }
        try{
            $imgD = DB::table('botimgmaps')->where($wheres
                // [
                //     ['imgName','!=',''],
                //     ['imgType','=',$type],
                //     ['op','=',1]
                // ]
            )->get();
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
