<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class DataUpdateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->pdoConn = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6401619;', 'sql6401619', 'QkKBd19xbL');
        $this->pdoConn->query("SET NAMES utf8");
    }
    
    public function index($utext='')
    {
        if($utext!=''){
            if($this->pdoConn->errorCode()=='00000'){
                $sql = "SELECT * FROM message WHERE u_text='".$utext."'";
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                $messageRow = $query->rowCount();//取得資料筆數
            }
        }
        // \Log::info('messageRow: '.json_encode($messages));
        return view('update', [
            'messageD'=>$messages,
        ]);
    }

    public function editD(Request $editD)
    {
        $data = $editD->input('oc');
        $dataU = $editD->input('utext');
        if($this->pdoConn->errorCode()=='00000'){
            if($data==0){
                $sql = 'UPDATE sql6401619.message SET oc=1 WHERE u_text="'.$dataU.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                $sql = 'UPDATE sql6401619.message SET oc=0 WHERE u_text="'.$dataU.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        
        // \Log::info('editD: ');
        // \Log::info('messageRow: '.$data);
        return view('update');
    }

    public function updateD(Request $editD)
    {
        $editD=$editD->input();
        return '+++';
    }
}
