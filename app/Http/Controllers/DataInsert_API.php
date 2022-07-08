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
use App\Http\Controllers\DB\dataSeleController;//20220620 add
use App\Http\Controllers\DB\dataInsertController;//20220620 add

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
        $this->slesData = new dataSeleController;
        $this->insertData = new dataInsertController;
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
        // \Log::info("----------------------");

        // if($this->pdoConn->errorCode()=='00000'){}
        if($repqesti['Utxt']!=''){
            $Utxt = $repqesti['Utxt'];
            $reType = $repqesti['reType'];
            if($reType=='img'){
                $imgType = $repqesti['imgType'];
                if($imgType==1){ //upload File
                    $reText = $this->insertD_API_returnD('e','表單錯誤.','400');
                    // $bImg = array_key_exists('bImg',$repuestf)==1&&$requesta['bImg']!='undefined'?1:0;;
                    // $sImg = array_key_exists('sImg',$repuestf)==1&&$requesta['sImg']!='undefined'?1:0;;
                    // if($bImg==1&&$sImg==1){
                    //     $bImgName = json_decode($this->uploadImg($request,'bImg'));
                    //     if($bImgName->ImgNewName!=''&&$bImgName!='upImg_err'){
                    //         $sImgName = json_decode($this->uploadImg($request,'sImg'));
                    //         if($sImgName->ImgNewName!=''&&$sImgName!='upImg_err'){
                    //             $insertData = $this->insertData();
                    //             if($insertData==1){
                    //                 // $reText = $this->insertD_API_returnD('s',$bImgName->ImgNewName,'200');
                    //                 $reText = $this->insertD_API_returnD('s','新增成功.','200');
                    //             }
                    //             else{
                    //                 $reText = $this->insertD_API_returnD('e','新增失敗.','404.1');
                    //             }
                    //         }
                    //         else{
                    //             //小圖上傳失敗
                    //             $this->imgUploadEdit->delectImg($bImgName->ImgNewName, 'updateImg', 'img');
                    //             $reText = $this->insertD_API_returnD('e','檔案上傳失敗.','401.5');
                    //         }
                    //     }
                    //     else{
                    //         //大圖上傳失敗
                    //         $reText = $this->insertD_API_returnD('e','檔案上傳失敗.','401.4');
                    //     }
                    // }
                    // else{
                    //     if($bImg==0&&$sImg==0){
                    //         $reText = $this->insertD_API_returnD('e','請上傳Bot回覆大圖&小圖.','401.1');
                    //     }
                    //     else{
                    //         if($bImg==0){
                    //             $reText = $this->insertD_API_returnD('e','沒有Bot回覆大圖.','401.2');
                    //         }
                    //         else{
                    //             $reText = $this->insertD_API_returnD('e','沒有Bot回覆小圖.','401.3');
                    //         }
                    //     }
                    // }
                }
                else if($imgType==2){ //use File
                    $imgSameType = $repqesti['imgSameType'];
                    $bImg = $repqesti['bImg'];
                    $seleBImg = $this->slesData->seleCheckImg($bImg);
                    if($imgSameType==1){ //usame
                        $sImg = $repqesti['sImg'];
                        $seleSImg = $this->slesData->seleCheckImg($sImg);
                        if(count($seleBImg)== 1&& $seleBImg[0]->op==1 &&
                            count($seleSImg)==1 && $seleSImg[0]->op==1){
                            $bImgCheck = $this->imgUploadEdit->checkImgFile($bImg, $seleBImg[0]->url.$seleSImg[0]->filedir);
                            $sImgCheck = $this->imgUploadEdit->checkImgFile($sImg, $seleSImg[0]->url.$seleSImg[0]->filedir);
                            if($bImgCheck==1&&$sImgCheck==1){
                                $reText = $this->insertImgData($reType, $Utxt, $seleBImg[0]->imgNum, $seleSImg[0]->imgNum);
                            }
                            else{
                                $reText = $this->insertD_API_returnD('e','請重新整理畫面再新增.','402.11');
                            }
                        }
                        else{
                            $reText = $this->insertD_API_returnD('e','請重新整理畫面再新增.','402.12');
                        }
                    }
                    else if($imgSameType==2){ //same
                        $sImg_mb_split = explode('B.', $bImg);
                        $sImg = $sImg_mb_split[0].'S.'.$sImg_mb_split[1];
                        $seleSImg = $this->slesData->seleCheckImg($sImg);
                        if(count($seleBImg)==1 && $seleBImg[0]->op==1 &&
                            count($seleSImg)==1 && $seleSImg[0]->op==1){
                            $bImgCheck = $this->imgUploadEdit->checkImgFile($bImg, $seleBImg[0]->url.$seleSImg[0]->filedir);
                            $sImgCheck = $this->imgUploadEdit->checkImgFile($sImg, $seleSImg[0]->url.$seleSImg[0]->filedir);
                            if($bImgCheck==1&&$sImgCheck==1){
                                $reText = $this->insertImgData($reType, $Utxt, $seleBImg[0]->imgNum, $seleSImg[0]->imgNum);
                            }
                            else{
                                $reText = $this->insertD_API_returnD('e','請重新整理畫面再新增.','402.21');
                            }
                        }
                        else{
                            $reText = $this->insertD_API_returnD('e','請重新整理畫面再新增.','402.22');
                        }
                    }
                    else{
                        $reText = $this->insertD_API_returnD('e','表單錯誤.','402.3');
                    }
                }
                else{
                    $reText = $this->insertD_API_returnD('e','表單錯誤.','402.5');
                }
            }
            else if($reType=='text'){
                if($repqesti['BotText']!=''){
                    $reText = $this->insertTextData($reType, $Utxt, $repqesti['BotText']);
                }
                else{
                    $reText = $this->insertD_API_returnD('e','請輸入Bot回覆訊息.','401.1');
                }
            }
            else{
                $reText = $this->insertD_API_returnD('e','回復類別錯誤.','403');
            }
        }
        else{
            $reText = $this->insertD_API_returnD('e','表單錯誤.','400');
        }
        
        return json_encode($reText);
    }
    
    function uploadImg($request, $type){
        if($this->upfileNum<3){
            $ImgName = $this->imgUploadEdit->imgUploadEdit($request, $type, 'jpg', 'updateImg', 'img/linebot_img');
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
    function insertImgData($reType, $Utxt, $bImg, $sImg){
        $insertData = $this->insertData->botMessage_Img_Insert($reType, $Utxt, $bImg, $sImg);
        if($insertData==1){return $this->insertD_API_returnD('s','新增成功.','200');;}
        else if($insertData==2){return $this->insertD_API_returnD('e','新增失敗.','402.4');;}
        else{return $this->insertD_API_returnD('e','資料庫異常.','444.2');;}
    }
    function insertTextData($reType, $u_text, $retext){
        $insertData = $this->insertData->botMessage_Text_Insert($reType, $u_text, $retext);
        if($insertData==1){return $this->insertD_API_returnD('s','新增成功.','200');;}
        else if($insertData==2){return $this->insertD_API_returnD('e','新增失敗.','401.2');;}
        else{return $this->insertD_API_returnD('e','資料庫異常.','444.1');;}
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
