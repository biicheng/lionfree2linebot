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
    // public function __construct(){}

    function imgUploadEdit($request, $type, $imgType, $path, $pathFolder){
        $requestf = $request->input();
        $strtotime = strtotime("now");
        $d = [];
        $file = $strtotime.'_'.$type.'.'.$imgType;
        $fileName = '';

        $ImgName = Storage::disk($path)->putFileAs($pathFolder, $request->file($type), $file, 'public');
        if($ImgName!=1){
            $ImgNewName = mb_split('/', $ImgName);
            $d['ImgNewName'] = $ImgNewName[1];
            $fileName = $ImgNewName[1];
        }
        else{
            $d['ImgNewName'] = '';
            $fileName = '';
        }
        return json_encode($d);
    }

    function delectImg($imgName, $path, $pathFolder){
        Storage::disk($path)->delete($pathFolder.'/'.$imgName);
    }

    function checkImg($img)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('example.FILE_HOST').config('example.FILE_DIR').$img);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE){
            return 1;
        }
        else{
            return 0;
        }
    }

    function checkImgFile($img, $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.$img);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE){
            return 1;
        }
        else{
            return 0;
        }
    }

}
