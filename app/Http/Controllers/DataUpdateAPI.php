<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\DB\dataSeleController; //20220711 add
use App\Http\Controllers\DB\dataUpdateController; //20220711 add
use App\Http\Controllers\apiRequestMapController; //20220711 add

class DataUpdateAPI extends Controller
{
    public function __construct(){
        $this->reqStr = new apiRequestMapController;
        $this->update = new dataUpdateController;
    }

    public function editMessageStatus(Request $request){
        \Log::info("message");
        $req = $request->input();
        $oc = $req['oc'];
        $ut = $req['ut'];
        \Log::info("req:".json_encode($req));
        \Log::info("oc:".$oc);
        \Log::info("ut:".$ut);
        if($request->has('ut')&&$request->has('oc')&&($req['oc']!=''&&$req['ut']!='')){
            $dataSele = new dataSeleController;
            $messageT = $dataSele->messageGet('u_text',$req['ut']);
            if(count($messageT)>0){
                $oc = $req['oc']==1?0:1;
                \Log::info('oc:'.$oc);
                $update = $this->update->editMessageStatus($req['ut'], $oc);
                if($update==1){
                    return $this->reqStr->insertD_API_returnD('s','修改成功.','200');
                }
                else{ return $this->reqStr->insertD_API_returnD('e','修改失敗.','404.2'); }
            }
            else{ return $this->reqStr->insertD_API_returnD('e','資訊錯誤.','404.1'); }
        }
        else{
            return $this->reqStr->insertD_API_returnD('e','資訊錯誤.','500');
        }
    }
}
