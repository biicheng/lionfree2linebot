<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//20220620

class dataInsertController extends Controller
{
    public function botMessage_Text_Insert($reType, $u_text, $retext){
        try{
            DB::table('sql4463017.botmessage2line')->insert([
                'mIndex'=>null, 'reType'=>$reType, 
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
            DB::table('sql4463017.botmessage2line')->insert([
                'mIndex'=>null, 'reType'=>$reType, 'u_text'=>$u_text, 
                'bImg'=>$bImg, 'sImg'=>$sImg, 'oc'=>1
            ]);
            return 1;
        }
        catch(\Exception $exception){
            \Log::info("inserBotImgMysqlErr:".$exception);
            return 0;
        }
    }
}
