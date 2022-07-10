<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//20220620

class dataInsertController extends Controller
{
    public function botMessage_Text_Insert($reType, $u_text, $retext){
        try{
            DB::table('botmessage2line')->insert([
                'mIndex'=>0, 'reType'=>$reType, 
                'u_text'=>$u_text, 're_text'=>$retext, 'oc'=>1
            ]);
            return 1;
        }
        catch(\Exception $exception){
            \Log::info("inserBotTextMysqlErr:".$exception);
            return 0;
        }
    }
    public function botMessage_Img_Insert($reType, $u_text, $bImg, $sImg){
        try{
            DB::table('botmessage2line')->insert([
                'mIndex'=>0, 'reType'=>$reType, 'u_text'=>$u_text, 
                'bImg'=>$bImg, 'sImg'=>$sImg, 'oc'=>1
            ]);
            return 1;
        }
        catch(\Exception $exception){
            \Log::info("inserBotImgMysqlErr:".$exception);
            return 0;
        }
    }

    public function botImgData_insert($dataN, $iUrl, $imgDir, $fileName, $fileType, $op){
        $insertArr = [];
        $insertArr['imgNum'] = null;
        $insertArr['url'] = $iUrl;
        $insertArr['filedir'] = $imgDir;
        $insertArr['imgName'] = $fileName;
        $insertArr['op'] = $op;
        if($fileType!=''){ $insertArr['imgType'] = $fileType; }
        try{
            DB::table($dataN)->insert(
                $insertArr
                // ['imgNum'=>null, 'url'=>$iUrl, 
                //     'filedir'=>$imgDir, 'imgName'=>$fileName, 
                //     'imgType'=>$fileType, 'op'=>$op]
            );
            return 1;
        }
        catch(\Exception $exception){
            \Log::info("inserBotImgMysqlErr:".$exception);
            return 0;
        }
    }
}
