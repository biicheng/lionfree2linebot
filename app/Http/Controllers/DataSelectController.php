<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

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
    
    public function index()
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
}
