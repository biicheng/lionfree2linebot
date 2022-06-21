<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\DB\dataSeleController;//20220617 add
use App\Http\Controllers\shared\imgUploadEditController; //20220621 add

class seleDataAPI extends Controller
{
    public function __construct(){
        $this->slesData = new dataSeleController;
        $this->imgUploadEdit = new imgUploadEditController;
    }
    
    public function seleImgMap(Request $request){
        $imgArr = array();
        $imgArr['bimg'] = $this->checkImgFile($this->slesData->seleImgMaps('b'));
        $imgArr['simg'] = $this->checkImgFile($this->slesData->seleImgMaps('s'));
        return json_encode($imgArr);
    }
    public function checkImgFile($imgArr){
        $arr = [];
        $reArr = [];
        foreach($imgArr as $k=>$v){
            $dArr = [];
            if($this->imgUploadEdit->checkImgFile($v->imgName, $v->url)==1){
                $dArr['imgNum'] = $v->imgNum;
                $dArr['url'] = $v->url;
                $dArr['imgName'] = $v->imgName;
                $arr[count($arr)] = $dArr;
            }
        }
        return $arr;
    }
}
