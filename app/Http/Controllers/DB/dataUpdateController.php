<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB; //20220711 add

class dataUpdateController extends Controller
{
    public function editMessageStatus($k, $v){
        $i = 0;
        try{
            DB::table('botmessage2line')->where('u_text', $k)->update(['oc' => $v]);
            $i = 1;
        }
        catch(\Exception $exception){}
        return $i;
    }
}
