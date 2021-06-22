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

        $this->pdoConn = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6401619;', 'sql6401619', 'QkKBd19xbL');
        $this->pdoConn->query("SET NAMES utf8");
    }
    
    public function index()
    {
        return $this->seleD();
        // if($u_texxt=='' && $oc==''){
        //     return $this->seleD();
        // }
        // else{
        //     try{
        //         $sql = DB::table('sql6401619.message')->where('u_text', '=',$u_texxt)->get();
        //         if(!empty($sql[0])){
        //             \Log::info(' --db: '.json_encode($sql).'---');
        //             if($sql[0]->oc==0){
        //                 \Log::info(' --oc=0--');
        //                 return $this->editD($u_texxt,1);
        //             }
        //             else if($sql[0]->oc==1){
        //                 \Log::info(' --oc=1--');
        //                 return $this->editD($u_texxt,0);
        //             }
        //             else{
        //                 \Log::info(' --pc else--');
        //                 return 'err.';
        //             }
        //         }
        //         else{
        //             \Log::info(' --else--');
        //             return 'data err.';
        //         }
        //     } catch (\Exception $exception){
        //         \Log::info(' --catch--');
        //         dd($exception->getMessage());//注意不要輸出這個
        //     }
        // }
    }

    public function editData(Request $editD)
    {
        $data = $editD->input('oc');
        $dataU = $editD->input('utext');
        if($this->pdoConn->errorCode()=='00000'){
            if($data==0){
                \Log::info(' --oc=0--');
                DB::table('sql6401619.message')->where('u_text',$dataU)->update(array('oc' => 1));  
                // $sql = 'UPDATE sql6401619.message SET oc=1 WHERE u_text="'.$dataU.'"';
                // $query = $this->pdoConn->query($sql);
                // $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                \Log::info(' --oc=1--');
                DB::table('sql6401619.message')->where('u_text',$dataU)->update(array('oc' => 0));  
                // $sql = 'UPDATE sql6401619.message SET oc=0 WHERE u_text="'.$dataU.'"';
                // $query = $this->pdoConn->query($sql);
                // $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $this->seleD();
    }
    public function seleD()
    {
        $sql = "SELECT * FROM sql6401619.message WHERE 1";
        $query = $this->pdoConn->query($sql);
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
        $messageRow = $query->rowCount();//取得資料筆數
        \Log::info('messageRow: '.json_encode($messages));
        return view('select', [
                    'messageRow'=>$messageRow,
                    'messageD'=>$messages,
        ]);
    }
    public function editD($u_text, $oc)
    {
        try{
            $sql = 'UPDATE sql6401619.message SET oc='.$oc.' WHERE u_text="'.$u_text.'"';
            $query = $this->pdoConn->query($sql);
            $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            \Log::info(' --$this->seleDeditD--');
            return $this->seleD();
        } catch (\Exception $exception){
            dd($exception->getMessage());//注意不要輸出這個
        }
    }
}
