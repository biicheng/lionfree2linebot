<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//共用模組
use App\Http\Controllers\shared\imgUploadEditController;//20220701 add
use App\Http\Controllers\DB\dataSeleController;//20220701 add
use App\Http\Controllers\DB\dataInsertController;//20220701 add

class insertDataAPI extends Controller
{
    public function __construct()
    {
        $this->imgUploadEdit = new imgUploadEditController;
        $this->slesData = new dataSeleController;
        $this->insertData = new dataInsertController;
    }

    public function inserImgData(Request $request){
        $repqesti = $request->input();
        // $repuestf = $request->file();
        // $requesta = $request->all();

        if($request->has('iUrl')&&$request->has('imgDir')&&$request->has('imgname')&&$request->has('imgType')){
            $imgname = $repqesti['imgname'];
            $iUrl = $repqesti['iUrl'];
            $imgDir = $repqesti['imgDir'];
            $imgType = $repqesti['imgType'];
            $fileDir = '/'.$imgDir.'/';
            $bimgC = $this->imgUploadEdit->checkImgFile($imgname.'B.'.$imgType, $iUrl.$fileDir);
            $simgC = $this->imgUploadEdit->checkImgFile($imgname.'S.'.$imgType, $iUrl.$fileDir);

            if($bimgC==1&&$simgC==1){
                $sImgM_insert = $this->insertData->botImgData_insert('botimgmaps', $iUrl, $fileDir, $imgname.'S.'.$imgType, 's', 1);
                $bImgM_insert = $this->insertData->botImgData_insert('botimgmaps', $iUrl, $fileDir, $imgname.'B.'.$imgType, 'b', 1);
                $bImg_insert =  $this->insertData->botImgData_insert('botbimgmaps', $iUrl, $fileDir, $imgname.'B.'.$imgType, '', 1);
                $sImg_insert =  $this->insertData->botImgData_insert('botsimgmaps', $iUrl, $fileDir, $imgname.'S.'.$imgType, '', 1);
                if($bImgM_insert==1&&$sImgM_insert==1){ return $this->insertD_API_returnD('s','ok.','200'); }
                else{ return $this->insertD_API_returnD('e','資料庫異常，新增失敗.','404.1'); }
            }
            else{ 
                if($bimgC==0&&$simgC==0){ return $this->insertD_API_returnD('e','參數錯誤.','501.1'); }
                else if($bimgC==0){ return $this->insertD_API_returnD('e','參數錯誤.','501.2'); }
                else{ return $this->insertD_API_returnD('e','參數錯誤.','501.3'); }
            }
        }
        else{ return $this->insertD_API_returnD('e','err.','501.'); }
    }
    
    public function insertD_API_returnD($result,$resultT,$errCode)
    {
        $reText = [];
        $reText['result'] = $result;
        $reText['resultT'] = $resultT;
        $reText['errCode'] = $errCode;

        return $reText;
    }
}
