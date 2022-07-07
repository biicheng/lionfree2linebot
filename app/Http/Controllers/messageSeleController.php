<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class messageSeleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');

        $this->pdoConn = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
        $this->pdoConn->query("SET NAMES utf8");
    }
    
    public function index(){
        return $this->seleD(); 
    }
    public function seleD(){
        $d = [];
        $messages = null;
        $botimgmaps = DB::table('botimgmaps')->get();
        $messagesD = DB::table('botmessage2line')->get();
        // foreach($messagesD as $k=>$v){
        //     $d['reType'] = $v->reType;
        //     $d['u_text'] = $v->u_text;
        //     $d['re_text'] = $v->re_text;
        //     $d['bimg'] = '';
        //     $d['simg'] = '';
        //     $d['oc'] = $v->oc;
        //     if($v->reType=='img'){
        //         foreach($botimgmaps as $key=>$val){
        //             if($v->bImg==$val->imgNum){$d['bimg'] = $val->url.$val->imgName;}
        //             if($v->sImg==$val->imgNum){$d['simg'] = $val->url.$val->imgName;}
        //         }
        //     }
        //     $messages .= json_encode($d);
        // }
        return  view('selectText', [
                    'messageRow'=>$messagesD->count(),
                    'messageD'=>$messagesD,
        ]);
    }
    public function seleD1(){
        if($this->pdoConn->errorCode()=='00000'){
            $sql = "SELECT * FROM sql4463017.botmessage WHERE 1";
            $query = $this->pdoConn->query($sql);
            $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            $messageRow = $query->rowCount();//取得資料筆數
            $this->pdoConn = null;
            return  view('select', [
                        'messageRow'=>$messageRow,
                        'messageD'=>$messages,
            ]);
            //redirect('/select');
        }
        else{
            return view('databeseErr');
        }
    }

}
