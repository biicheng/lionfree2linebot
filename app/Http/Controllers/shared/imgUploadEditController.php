<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //20220513 add
//20220513 add
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use Illuminate\Http\File;

// use Ftp;//20220523 add
use DB;//20220606 add
use Config;//20220606 add

class imgUploadEditController extends Controller
{
    // public function __construct()
    // {
    //     $this->fileDB = DB::table('filehosturl')->get();
    //     // \Log::info("+++".json_encode($this->fileDB));
    //     // \Log::info("..".$this->fileDB[0]->host);
    //     // \Log::info("config:".config('example.FTP_HOST'));
    // }

    function imgUploadEdit($request, $type, $imgType, $path, $pathFolder){
        $requestf = $request->input();
        $strtotime = strtotime("now");
        $d = [];
        $file = $strtotime.'_'.$type.'.'.$imgType;
        $fileName = '';

        // $ftpImgName = Storage::disk('ftp')->putFileAs($pathFolder, $request->file($type), $strtotime.'_'.$type.'.'.$imgType);
        $ImgName = Storage::disk($path)->putFileAs($pathFolder, $request->file($type), $file, 'public');
        $img = Storage::disk('ftp')->putFileAs($pathFolder, $request->file($type), $file, 'public');
        
        // FILE_HOST="https://linebotimg.000webhostapp.com"
        // FILE_DIR="/img/linebot_img/"
        // $ftpConn = @ftp_connect('files.000webhost.com', 21) or die ('cannot connect to host');
        // \Log::info("ftp_connect:".$ftpConn);
        // $ftp_login = ftp_login($ftpConn, 'linebotimg', '1989@Sweet1219') or die('cannot login');
        // \Log::info("ftp_login:".$ftp_login);
        // // 路徑設定
        // $local_file = "public/img/linebot_img/".$file;//public_path('/img/linebot_img/').$file;//'C:\xampp\htdocs\heroku_mytpl6\public\img\acces_icon.png';// // 本端的路徑
        // $ftp_path = 'img/linebot_img'; // 遠端的路徑
        // // 開始上傳
        // $upload = ftp_put($ftpConn, $ftp_path, $local_file, FTP_ASCII);//FTP_ASCII //FTP_BINARY
        // \Log::info("upload:".$upload);
        // if (!$upload) {
        //     exit('failed');
        // }

        // $this->checkImg($file);
        // \Log::info("000:".Storage::disk($path)->url($pathFolder.'/'.$ImgName));
        // $ftp = FTP::connection()->uploadFile('','img/linebot_img');
        //$ImgName = Storage::disk('updateImg')->put('img', $request->file($type), 'public');
        if($ImgName!=1){
            // $ImgNewName = mb_split('/', $ImgName);
            // $d['ImgNewName'] = $ImgNewName[1];
            $ImgNewName = mb_split('/', $ImgName);
            $d['ImgNewName'] = $ImgNewName[1];
            $fileName = $ImgNewName[1];
            // Storage::disk('ftp')->putFileAs('img'.'/'.$ImgNewName[1]);
        }
        else{
            $d['ImgNewName'] = '';
            $fileName = '';
        }
        // return $fileName;
        return json_encode($d);
    }

    function delectImg($imgName, $path, $pathFolder){
        Storage::disk($path)->delete($pathFolder.'/'.$imgName);
    }

    function checkImg($img)
    {
        $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,'https://linebotimg.000webhostapp.com/img/linebot_img/'.$img);
        curl_setopt($ch, CURLOPT_URL,config('example.FILE_HOST').config('example.FILE_DIR').$img);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE){
            \Log::info("yes");
        }
        else{
            \Log::info("no");
        }
        return 1;
    }

}
