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

        $this->pdoConn = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
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
        //         $sql = DB::table('sql4463017.botmessage')->where('u_text', '=',$u_texxt)->get();
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
                $sql = 'UPDATE sql4463017.botmessage SET oc=1 WHERE u_text="'.$dataU.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                $this->pdoConn = null;
            }
            else{
                $sql = 'UPDATE sql4463017.botmessage SET oc=0 WHERE u_text="'.$dataU.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                $this->pdoConn = null;
            }
        }
        return $this->seleD();
    }
    public function seleD()
    {
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
    public function editD($u_text, $oc)
    {
        try{
            $sql = 'UPDATE sql4463017.botmessage SET oc='.$oc.' WHERE u_text="'.$u_text.'"';
            $query = $this->pdoConn->query($sql);
            $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->pdoConn = null;
            return $this->seleD();
        } catch (\Exception $exception){
            // dd($exception->getMessage());//注意不要輸出這個
        }
    }
}
