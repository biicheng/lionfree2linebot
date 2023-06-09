<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use PDO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManagerStatic; 

// use DB; //20220707 add
use App\Http\Controllers\DB\dataSeleController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function infoD(){
        // $ret = $cc->name;//$cc->all();//
        //dd(json_decode($request->getContent(), true));
        return phpinfo();
    }

    public function fileText(Request $request)
    {
        $days = date("YmdHis");
        $path = $request->file('imgs');
        $imgType = explode("/",$path->getClientMimeType());
        // $path = $request->file('imgs')->store('/', $days.'.'.$imgType[1]);
        $path = $request->file('imgs')->storeAs(
            '/', $days.'.'.$imgType[1]
        );
        \Log::info(' --path--'.$path.'--'.$days.'.'.$imgType[1]);
        File::copy('/app/storage/app/'.$path, './img/'.$path);
        // File::copy(storage_path().'\\app\\'.$path, './images/'.$path);
        // Storage::delete('./'.$path);
        return $path;
    }
    
    public function lineBotHome(){
        $dataSeleController = new dataSeleController;
        // $messagesD = DB::table('botmessage2line')->get();

        return view('lineBotHome', [
            // 'messageRow'=>$messagesD->count(),
            // 'messageD'=>$messagesD,
            'message0'=>$dataSeleController->messageGet('oc',0),
            'message1'=>$dataSeleController->messageGet('oc',1),
        ]);
    }
}
