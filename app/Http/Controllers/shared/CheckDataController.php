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

class CheckDataController extends Controller
{
    function ImgChe($request, $type, $imgType){
        $requestf = $request->input();
        $strtotime = strtotime("now");
        $d = [];
        $fileName = '';
        $ImgName = Storage::disk('updateImg')->putFileAs('img', $request->file($type), $strtotime.'_'.$type.'.'.$imgType);
        //$ImgName = Storage::disk('updateImg')->put('img', $request->file($type), 'public');
        if($ImgName!=1){
            // $ImgNewName = mb_split('/', $ImgName);
            // $d['ImgNewName'] = $ImgNewName[1];
            $ImgNewName = mb_split('/', $ImgName);
            $d['ImgNewName'] = $ImgNewName[1];
            $fileName = $ImgNewName[1];
        }
        else{
            $d['ImgNewName'] = '';
            $fileName = '';
        }
        // return $fileName;
        return json_encode($d);
    }

    function checkImg()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://images.pexels.com/photos/4273439/pexels-photo-4273439.jpeg');
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE){
            \Log::info("yes");
        }
        else{
            \Log::info("no");
        }
    }
}
