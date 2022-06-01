<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //20220513 add
//20220513 add
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use Illuminate\Http\File;

use FTP;

//共用模組
use App\Http\Controllers\shared\imgUploadEditController;

class DataInsert_API extends Controller
{
    /**
    * 接收上傳檔案
    * @param Request $request
    * @return array
    */
    public function __construct()
    {
        $this->imgUploadEdit = new imgUploadEditController;
    }
    
    public function insertD_API(Request $request)
    {
        #------------------------------------------------------
        #變數宣告
        #------------------------------------------------------
        $Utxt = '';
        $reType = '';
        $BotText = '';
        $bImg = '';
        $sImg = '';
        $reText = [];
        $this->upfileNum = 0;

        $repqesti = $request->input();
        $repuestf = $request->file();
        $requesta = $request->all();
        // \Log::info("repqesti:".json_encode($repqesti));
        // \Log::info("repuestf:".json_encode($repuestf));
        // \Log::info("requesta:".json_encode($requesta));

        // if($this->pdoConn->errorCode()=='00000'){}
        
        // dd($ftp);
        // Ftp::connection('default')->makeDir('img');
        if($repqesti['Utxt']!=''){
            $Utxt = $repqesti['Utxt'];
            $reType = $repqesti['reType'];
            $BotText = $repqesti['BotText'];
            $bImg = array_key_exists('bImg',$repuestf)==1&&$requesta['bImg']!='undefined'?1:0;;
            $sImg = array_key_exists('sImg',$repuestf)==1&&$requesta['sImg']!='undefined'?1:0;;
            // $bImg = $request->input('bImg')=='undefined'?0:1;
            // $sImg = $request->input('sImg')=='undefined'?0:1;
            // $t = $this->imgUploadEdit->checkImg();
            if($reType=='img'){
                if($bImg==1&&$sImg==1){
                    $bImgName = json_decode($this->uploadImg($request,'bImg'));
                    if($bImgName->ImgNewName!=''&&$bImgName!='upImg_err'){
                        $sImgName = json_decode($this->uploadImg($request,'sImg'));
                        if($sImgName->ImgNewName!=''&&$sImgName!='upImg_err'){
                            $insertData = $this->insertData();
                            if($insertData==1){\Log::info("bImg:".$bImgName->ImgNewName);
                                $reText = $this->insertD_API_returnD('s',$bImgName->ImgNewName,'200');
                            }
                            else{
                                $reText = $this->insertD_API_returnD('e','新增失敗.','404.1');
                            }
                        }
                        else{
                            //小圖上傳失敗
                            $this->imgUploadEdit->delectImg($bImgName->ImgNewName, 'updateImg', 'img');
                            $reText = $this->insertD_API_returnD('e','檔案上傳失敗.','401.5');
                        }
                    }
                    else{
                        //大圖上傳失敗
                        $reText = $this->insertD_API_returnD('e','檔案上傳失敗.','401.4');
                    }
                }
                else{
                    if($bImg==0&&$sImg==0){
                        $reText = $this->insertD_API_returnD('e','請上傳Bot回覆大圖&小圖.','401.1');
                    }
                    else{
                        if($bImg==0){
                            $reText = $this->insertD_API_returnD('e','沒有Bot回覆大圖.','401.2');
                        }
                        else{
                            $reText = $this->insertD_API_returnD('e','沒有Bot回覆小圖.','401.3');
                        }
                    }
                }
            }
            else if($reType=='text'){
                if($BotText!=''){
                    $insertData = $this->insertData();
                    if($insertData==1){
                        $reText = $this->insertD_API_returnD('s','新增成功.','200');
                    }
                    else{
                        $reText = $this->insertD_API_returnD('e','新增失敗.','404.2');
                    }
                }
                else{
                    $reText = $this->insertD_API_returnD('e','請輸入Bot回覆訊息.','403');
                }
            }
            else{
                $reText = $this->insertD_API_returnD('e','回復類別錯誤.','402');
            }
        }
        else{
            $reText = $this->insertD_API_returnD('e','表單錯誤.','400');
        }
        
        return json_encode($reText);
    }
    function uploadImg($request, $type){
        if($this->upfileNum<3){
            // $this->upfileNum += 1;
            $ImgName = $this->imgUploadEdit->imgUploadEdit($request, $type, 'jpg', 'updateImg', 'img');
            if(json_decode($ImgName)->ImgNewName!=''){
                return $ImgName;
            }
            else{
                return 'upImg_err';
            }
        }
        else{
            return 'upImg_err';
        }
    }
    function insertData(){
        return 1;
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
