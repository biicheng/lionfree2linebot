<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DataSelectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $dsn = 'mysql:host=host=sql6.freemysqlhosting.net;port:3360;dbname:sql6401619;';
        // $this->pdoConn = new PDO($dsn, 'sql6401619', 'QkKBd19xbL');
        $this->pdoConn = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6401619;', 'sql6401619', 'QkKBd19xbL');
        $this->pdoConn->query("SET NAMES utf8");
    }
    
    public function index($u_texxt='', $oc='')
    {
        if($u_texxt=='' && $oc==''){
            return $this->seleD();
        }
        else{
            try{
                $sql = DB::table('sql6401619.message')->where('u_text', '=',$message_text)->get();
                if(!empty($sql[0])){
                    \Log::info(' --db: '.json_encode($sql).'---');
                    if($sql[0]->oc==0){
                        \Log::info(' --oc=0--');
                        $affected = DB::update('update sql6401619.message set u_texxt=? where oc=?', [$u_texxt, 1]);
                        return $this->seleD();
                    }
                    else if($sql[0]->oc==1){
                        \Log::info(' --oc=1--');
                        $affected = DB::update('update sql6401619.message set u_texxt=? where oc=?', [$u_texxt, 0]);
                        return $this->seleD();
                    }
                    else{
                        \Log::info(' --pc else--');
                        return 'err.';
                    }
                }
                else{
                    \Log::info(' --else--');
                    return 'data err.';
                }
            } catch (\Exception $exception){
                \Log::info(' --catch--');
            }
            // if($oc==1){
            //     $affected = DB::update('update sql6401619.message set u_texxt=? where oc=?', [$u_texxt, 1]);
            //     return $this->seleD();
            // }
            // else{
            //     $affected = DB::update('update sql6401619.message set u_texxt=? where oc=?', [$u_texxt, 1]);
            //     return $this->seleD();
            // }
            //return $this->editD($u_texxt, $oc);
        }
    }

    public function seleD()
    {
        $sql = "SELECT * FROM sql6401619.message WHERE 1";
        $query = $this->pdoConn->query($sql);
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
        $messageRow = $query->rowCount();//取得資料筆數
        // \Log::info('messageRow: '.json_encode($messages));
        return view('select', [
                    'messageRow'=>$messageRow,
                    'messageD'=>$messages,
        ]);
    }
    public function editD($u_texxt, $oc)
    {
        if($this->pdoConn->errorCode()=='00000'){
            if($data==0){
                $sql = 'UPDATE sql6401619.message SET oc=1 WHERE u_text="'.$u_texxt.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                return $this->seleD();
            }
            else{
                $sql = 'UPDATE sql6401619.message SET oc=0 WHERE u_text="'.$u_texxt.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                return $this->seleD();
            }
        }
    }
}
