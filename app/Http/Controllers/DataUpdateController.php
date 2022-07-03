<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
// use lluminate\Http\RedirectResponse;

use Session;

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
        $this->pdoConn = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
        $this->pdoConn->query("SET NAMES utf8");
    }
    
    public function index($id=NULL){
        $bimg = '';
        $simg = '';
        if($id!=NULL){
            try{
                $messagesD = DB::table('botmessage2line')->where('mIndex', '=', $id)->get();
            }
            catch(\Exception $exception){
                $text = $this->reSession("editErr", "資料庫異常.");
                return redirect()->back();
            }
            if($messagesD->count()==1){
                if($messagesD[0]->bImg!=NULL&&$messagesD[0]->sImg!=NULL){
                    try{
                        $botimgmaps = DB::table('botimgmaps')->where('op', '=', 1)->get();
                        if(count($botimgmaps)>0){
                            foreach($botimgmaps as $v){
                                if($v->imgNum==$messagesD[0]->bImg){ $bimg = $v->url.$v->filedir.$v->imgName; }
                                if($v->imgNum==$messagesD[0]->sImg){ $simg = $v->url.$v->filedir.$v->imgName; }
                            }
                        }
                    }
                    catch(\Exception $exception){}
                }
                return view('editMessage', [
                    'i'=>$messagesD[0]->mIndex,
                    'reType'=>$messagesD[0]->reType,
                    'utext'=>$messagesD[0]->u_text,
                    'retext'=>$messagesD[0]->re_text,
                    'bimg'=>$bimg,
                    'simg'=>$simg,
                    'oc'=>$messagesD[0]->oc,
                    'messageD'=>$messagesD,
                ]);
            }
            else{
                $text = $this->reSession("editErr", "無資料.");
            }
        }
        else{
            $text = $this->reSession("editErr", "使用錯誤.");
        }
    }

    public function reSession($name, $txt){
        Session::flash($name, $txt);
        return 1;
    }

    public function index1($utext=''){
        if($utext!=''){
            if($this->pdoConn->errorCode()=='00000'){
                $sql = "SELECT * FROM botmessage WHERE u_text='".$utext."'";
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                $messageRow = $query->rowCount();//取得資料筆數
                // $explodeStr = 'https://mytpl6.herokuapp.com/img/linebot_img/';
                $explodeStr = 'https://mytpl6.herokuapp.com/img/linebot_img/';
                if(!empty($messages[0]['bImg'])){
                    // $bimg = explode($explodeStr, $messages[0]['bImg']);
                    // $bimg = $bimg[1];
                    $bimg = $messages[0]['bImg'];
                }
                else{
                    $bimg = $messages[0]['bImg'];
                }
                if(!empty($messages[0]['sImg'])){
                    // $simg = explode($explodeStr, $messages[0]['sImg']);
                    // $simg = $simg[1];
                    $simg = $messages[0]['sImg'];
                }
                else{
                    $simg = $messages[0]['sImg'];
                }
                return view('editMessage', [
                    'reType'=>$messages[0]['reType'],
                    'utext'=>$messages[0]['u_text'],
                    'retext'=>$messages[0]['re_text'],
                    'bimg'=>$bimg,
                    'simg'=>$simg,
                    'oc'=>$messages[0]['oc'],
                    'messageD'=>$messages,
                ]);
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
                $sql = 'UPDATE botmessage SET oc=1 WHERE u_text="'.$dataU.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                $sql = 'UPDATE botmessage SET oc=0 WHERE u_text="'.$dataU.'"';
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        
        // \Log::info('editD: ');
        // \Log::info('messageRow: '.$data);
        return  back();//redirect('/select');//view('update');
    }

    public function updateD(Request $editD){
        // try{} catch (\Exception $exception){}
        $imgAddr = 'https://mytpl6.herokuapp.com/img/linebot_img/';
        $editD=$editD->input();
        if(empty($editD['re_txt'])){
            $re_txt = '';
        }
        else{
            $re_txt = $editD['re_txt'];
        }
        if(empty($editD['bImg'])){
            $bImg = '';
        }
        else{
            $bImg = $imgAddr.$editD['bImg'];
        }
        if(empty($editD['sImg'])){
            $sImg = '';
        }
        else{
            $sImg = $imgAddr.$editD['sImg'];
        }
        $affected = DB::update('update sql4463017.botmessage set re_text=?, reType=?,
                                                            bImg=?, sImg=? 
                                                            where u_text=?', 
                                                            [$re_txt, $editD['reType'],
                                                                $bImg, $sImg,
                                                                $editD['Utxt']
                                                            ]);
        // DB::table('message')->update([
        //                             'reType'=>$editD['reType'],
        //                             're_text'=>$re_txt,
        //                             'bImg'=>$editD['bImg'],
        //                             'sImg'=>$sImg
        //                             ])->where(['u_text'=>$editD['Utxt']]);
        return back();
        //$editD['Utxt'].'--'.$editD['reType'].'--'.$re_txt.'--'.$bImg.'--'.$sImg.'--'.$affected;
    }
}
