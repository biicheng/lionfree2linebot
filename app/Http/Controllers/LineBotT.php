<?php

 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 
 use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
 use Illuminate\Foundation\Bus\DispatchesJobs;
 use Illuminate\Foundation\Validation\ValidatesRequests;
 use Illuminate\Routing\Controller as BaseController;
 
 use PDO;
 use Illuminate\Support\Facades\Log;
 use LINE\LINEBot;
 use LINE\LINEBot\Event\MessageEvent;
 use LINE\LINEBot\HTTPClient\CurlHTTPClient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Config;//20220622 add

class LineBotT extends Controller
{
    public function __construct()
    {
        // $this->pdoConn = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
        // $this->pdoConn->query("SET NAMES utf8");
    }

    private $sender;
    public function postTests(Request $cc){ //測試模組
        $dates = date("Y-m-d H:i:s");
        if((!empty($cc->input('events')[0]['message']['text']))||
            ($cc->input('events')[0]['message']['type']=='text')){
        // if(!empty($cc->input('events')[0]['message']['text'])){
            $destination = $cc->input('destination');
            $events_type = $cc->input('events')[0]['type'];
            $replyToken = $cc->input('events')[0]['replyToken'];
            $timestamp = $cc->input('events')[0]['timestamp'];
            $mode = $cc->input('events')[0]['mode'];
    
            $message_Id = $cc->input('events')[0]['message']['id'];
            $message_type = $cc->input('events')[0]['message']['type'];
            $message_text = $cc->input('events')[0]['message']['text'];
    
            $source_userId = $cc->input('events')[0]['source']['userId'];
            $source_type = $cc->input('events')[0]['source']['type'];
    
            try{
                $seleWhere = [['u_text', '=',$message_text],['oc','=',1]];
                $sql = DB::table('sql6401619.message')->where($seleWhere)->get();
                if(!empty($sql[0])){
                    // \Log::info(' --db: '.json_encode($sql).'---');
                    if($sql[0]->reType=='text'){
                        $txt = $this->pushText($sql[0]->re_text, $replyToken);
                    } 
                    else if($sql[0]->reType=='select'){
                        $txt = $this->pushText($message_text, $replyToken);
                    }
                    else if($sql[0]->reType=='img'){
                        $txt = $this->pushImg($sql[0]->bImg, $sql[0]->sImg, $replyToken);
                    }
                    else{
                        \Log::info(' --no--');
                        $txt = $this->pushText($message_text, $replyToken);
                    }
                }
                else{
                    \Log::info(' --else--');
                    $txt = $this->pushText($message_text, $replyToken);
                }
            } catch (\Exception $exception){
                \Log::info(' --curl--');
                // /* curl 000webhost API */
                // $ch = curl_init();
                // //curl_setopt可以設定curl參數
                // //設定url
                // curl_setopt($ch , CURLOPT_URL , "https://tkogo.000webhostapp.com/botController/txt/".$message_text."/--/--/--/--");
    
                // //獲取結果不顯示
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
                // //設定AGENT
                // curl_setopt($ch, CURLOPT_USERAGENT, "Google Bot");
                // //執行，並將結果存回
                // $result = curl_exec($ch);
                // //關閉連線
                // curl_close($ch);
    
                // if(json_decode($result)=='403'){
                //     $txt = $this->pushText($message_text, $replyToken);
                // }
                // else if(!isset(json_decode($result)->reType)){
                //     $txt = $this->pushText('伺服器維護中...', $replyToken);
                // }
                // else{
                //     $reD = json_decode($result);
                //     if($reD->reType=='text'){
                //         $txt = $this->pushText($reD->re_text, $replyToken);
                //     }
                //     else if($reD->reType=='img'){
                //         $txt = $this->pushImg($reD->bImg, $reD->sImg, $replyToken);
                //     }
                //     else{
                //         $txt = $this->pushText($message_text, $replyToken);
                //     }
                // }
                $txt = $this->pushText($message_text, $replyToken);
                dd($exception->getMessage());//注意不要輸出這個
            }
        }
        else{
            $txt = $this->pushImg('https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseB.jpg', 'https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseS.jpg', $cc->input('events')[0]['replyToken']);
        }
        
        $this->lineUserData($cc->input('events')[0]['source']['userId']);
        return 'hello.';
    }
    
    public function postTest1(Request $cc){ //
        \Log::info('post --bot');
        $dates = date("Y-m-d H:i:s");
        if((!empty($cc->input('events')[0]['message']['text']))||
            ($cc->input('events')[0]['message']['type']=='text')){
        // if(!empty($cc->input('events')[0]['message']['text'])){
            $destination = $cc->input('destination');
            $events_type = $cc->input('events')[0]['type'];
            $replyToken = $cc->input('events')[0]['replyToken'];
            $timestamp = $cc->input('events')[0]['timestamp'];
            $mode = $cc->input('events')[0]['mode'];
    
            $message_Id = $cc->input('events')[0]['message']['id'];
            $message_type = $cc->input('events')[0]['message']['type'];
            $message_text = $cc->input('events')[0]['message']['text'];
    
            $source_userId = $cc->input('events')[0]['source']['userId'];
            $source_type = $cc->input('events')[0]['source']['type'];
    

            $message = DB::table('botmessage2line')->where([
                ['u_text','=',$message_text],
                ['oc','=',1]
            ])->get();
            \Log::info("botMessage:".$message[0]->re_text);

            /* sele遠方mysql */
            if($this->pdoConn->errorCode()=='00000'){
                $sql = "SELECT * FROM botmessage WHERE u_text='".$message_text."'&&oc=1";
                $query = $this->pdoConn->query($sql);
                $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                if(count($messages)>0){
                    if($messages[0]['reType']=='text'){
                        $txt = $this->pushText($messages[0]['re_text'], $replyToken);
                    } 
                    else if($messages[0]['reType']=='select'){
                        $txt = $this->pushText($message_text, $replyToken);
                    }
                    else if($messages[0]['reType']=='img'){Log::info("imgUrl".$messages[0]['bImg']);
                        $txt = $this->pushImg($messages[0]['bImg'], $messages[0]['sImg'], $replyToken);
                    }
                    else{
                        $txt = $this->pushText($message_text, $replyToken);
                    }
                }
                else{
                    $txt = $this->pushText($message_text, $replyToken);
                }
            }
            else{
                $txt = $this->pushText('資料庫異常...', $replyToken);
                // /* curl 000webhost API */
                // $ch = curl_init();
                // //curl_setopt可以設定curl參數
                // //設定url
                // curl_setopt($ch , CURLOPT_URL , "https://tkogo.000webhostapp.com/botController/txt/".$message_text."/--/--/--/--");
    
                // //獲取結果不顯示
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
                // //設定AGENT
                // curl_setopt($ch, CURLOPT_USERAGENT, "Google Bot");
                // //執行，並將結果存回
                // $result = curl_exec($ch);
                // //關閉連線
                // curl_close($ch);
    
                // if(json_decode($result)=='403'){
                //     $txt = $this->pushText($message_text, $replyToken);
                // }
                // else if($this->pdoConn->errorCode()!='00000'&&!isset(json_decode($result)->reType)){
                //     $txt = $this->pushText('伺服器維護中...', $replyToken);
                // }
                // else{
                //     $reD = json_decode($result);
                //     if($reD->reType=='text'){
                //         $txt = $this->pushText($reD->re_text, $replyToken);
                //     }
                //     else if($reD->reType=='img'){
                //         $txt = $this->pushImg($reD->bImg, $reD->sImg, $replyToken);
                //     }
                //     else{
                //         $txt = $this->pushText($message_text, $replyToken);
                //     }
                // }
            }
            
            
        }
        else{
            $txt = $this->pushImg('https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseB.jpg', 'https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseS.jpg', $cc->input('events')[0]['replyToken']);
            // $txt = $this->pushText('請輸入文字...', $cc->input('events')[0]['replyToken']);
        }
        // Log::info("uid:".$cc->input('events')[0]['source']['userId']);
        $this->lineUserData($cc->input('events')[0]['source']['userId']);
        return 'hello.';
    }

    public function postTest(Request $cc){ //正式站
        \Log::info('post --bot');
        $dates = date("Y-m-d H:i:s");
        if((!empty($cc->input('events')[0]['message']['text']))||
            ($cc->input('events')[0]['message']['type']=='text')){
        // if(!empty($cc->input('events')[0]['message']['text'])){
            $destination = $cc->input('destination');
            $events_type = $cc->input('events')[0]['type'];
            $replyToken = $cc->input('events')[0]['replyToken'];
            $timestamp = $cc->input('events')[0]['timestamp'];
            $mode = $cc->input('events')[0]['mode'];
    
            $message_Id = $cc->input('events')[0]['message']['id'];
            $message_type = $cc->input('events')[0]['message']['type'];
            $message_text = $cc->input('events')[0]['message']['text'];
    
            $source_userId = $cc->input('events')[0]['source']['userId'];
            $source_type = $cc->input('events')[0]['source']['type'];

            try{
                $message = DB::table('botmessage2line')->where([
                    ['u_text','=',$message_text],
                    ['oc','=',1]
                ])->get();
                if(count($message)>0){
                    if($message[0]->reType=='text'){
                        $txt = $this->pushText($message[0]->re_text, $replyToken);
                    } 
                    else if($message[0]->reType=='select'){
                        $txt = $this->pushText($message_text, $replyToken);
                    }
                    else if($message[0]->reType=='img'){
                        $bImgD = DB::table('botimgmaps')->where('imgNum','=',$message[0]->bImg)->get();
                        $sImgD = DB::table('botimgmaps')->where('imgNum','=',$message[0]->sImg)->get();
                        $txt = $this->pushImg($bImgD[0]->url.$bImgD[0]->imgName, $sImgD[0]->url.$sImgD[0]->imgName, $replyToken);
                    }
                    else{
                        $txt = $this->pushText($message_text, $replyToken);
                    }
                }
                else{
                    $txt = $this->pushText($message_text, $replyToken);
                }
            }
            catch(\Exception $exception){
                \Log::info("botMessage2Line:".$exception);
                $txt = $this->pushText('資料庫異常...', $replyToken);
                // /* curl 000webhost API */
                // $ch = curl_init();
                // //curl_setopt可以設定curl參數
                // //設定url
                // curl_setopt($ch , CURLOPT_URL , "https://tkogo.000webhostapp.com/botController/txt/".$message_text."/--/--/--/--");
    
                // //獲取結果不顯示
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
                // //設定AGENT
                // curl_setopt($ch, CURLOPT_USERAGENT, "Google Bot");
                // //執行，並將結果存回
                // $result = curl_exec($ch);
                // //關閉連線
                // curl_close($ch);
    
                // if(json_decode($result)=='403'){
                //     $txt = $this->pushText($message_text, $replyToken);
                // }
                // else if($this->pdoConn->errorCode()!='00000'&&!isset(json_decode($result)->reType)){
                //     $txt = $this->pushText('伺服器維護中...', $replyToken);
                // }
                // else{
                //     $reD = json_decode($result);
                //     if($reD->reType=='text'){
                //         $txt = $this->pushText($reD->re_text, $replyToken);
                //     }
                //     else if($reD->reType=='img'){
                //         $txt = $this->pushImg($reD->bImg, $reD->sImg, $replyToken);
                //     }
                //     else{
                //         $txt = $this->pushText($message_text, $replyToken);
                //     }
                // }
            }   
        }
        else{
            $txt = $this->pushImg('https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseB.jpg', 'https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseS.jpg', $cc->input('events')[0]['replyToken']);
            // $txt = $this->pushText('請輸入文字...', $cc->input('events')[0]['replyToken']);
        }
        $this->lineUserData($cc->input('events')[0]['source']['userId']);
        return 'hello.';
    }

    public function pushImg($bImg, $sImg, $replyToken){
        // $httpClient = new CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        // $bot = new LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);
        $httpClient = new CurlHTTPClient(config('example.LINE_BOT_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => config('example>LINE_BOT_CHANNEL_SECRET')]);
        // $replyToken = $request['events'][0]['replyToken'];
        
        // $imgUrl = 'https://3e8c-122-121-44-111.jp.ngrok.io/heroku_mytpl6/public';
        // $imgUrl = 'https://mytpl6.herokuapp.com';
        $image = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($bImg, $sImg);
        // $image = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder(
        //     'https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseB.jpg',
        //     'https://mytpl6.herokuapp.com/img/linebot_img/you-say-chineseS.jpg'
        // );
        $bot->replyMessage($replyToken, $image);
        // if ($response->isSucceeded()) {
        //     \Log::info(' --bot_img: yes.');
        // }
        // else{
        //     \Log::info(' --bot_img: no.');
        // }
        return 'ok';
    }
    public function pushText($text, $replyToken){
        // $httpClient = new CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        // $bot = new LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('example.LINE_BOT_CHANNEL_ACCESS_TOKEN'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('example>LINE_BOT_CHANNEL_SECRET')]);

        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        if ($response->isSucceeded()) {
            \Log::info(' --bot_text: yes.');
        }
        else{
            \Log::info(' --bot_text: no.');
        }
        return 'ok';
    }
    public function lineUserData($source_userId){
        #-----------------
        #變數宣告
        #-----------------
        $uId = $source_userId;
        $uName = '';
        $uImgURL = '';
        $uTitleMessega = '';
        $dates = date("Y-m-d H:i:s");


        $ch = curl_init();
        $url = "https://api.line.me/v2/bot/profile/".$source_userId;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        $err = curl_error($ch);  //if you need
        curl_close ($ch);

        // $httpClient = new CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        // $bot = new LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('example.LINE_BOT_CHANNEL_ACCESS_TOKEN'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('example>LINE_BOT_CHANNEL_SECRET')]);
        $response = $bot->getProfile($source_userId);
        if ($response->isSucceeded()) {
            $profile = $response->getJSONDecodedBody();
            if(!empty($profile['displayName'])){
                $uName = $profile['displayName'];
            }
            else{
                $uName = '---';
            }
            if(!empty($profile['pictureUrl'])){
                $uImgURL = $profile['pictureUrl'];
            }
            else{
                $uImgURL = '---';
            }
            if(!empty($profile['statusMessage'])){
                $uTitleMessega = $profile['statusMessage'];
            }
            else{
                $uTitleMessega = '---';
            }
            // Log::info("uName:".$uName);
            // Log::info("uImgURL:".$uImgURL);
            // Log::info("uTitleMessega:".$uTitleMessega);
            /* curl 000webhost API */
            /*$conDB = curl_init();
            //curl_setopt可以設定curl參數
            //設定url
            curl_setopt($conDB , CURLOPT_URL , "https://tkogo.000webhostapp.com/botUDSet/".$uId.'/'.$uName.'/'.$uImgURL.'/'.$uTitleMessage);
            //獲取結果不顯示
            curl_setopt($conDB, CURLOPT_RETURNTRANSFER, true);
            //設定AGENT
            curl_setopt($conDB, CURLOPT_USERAGENT, "Google Bot");
            //執行，並將結果存回
            $result = curl_exec($conDB);
            //關閉連線
            curl_close($conDB);
            #\Log::info(' --000db: '.$result);
            // return 'ok';*/

            $dateTime = date("Y-m-d H:i:s");
            $connection = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
            $connection->query('set names utf8;');

            $lineUser = DB::table('botudata')->where([['uid','=',$uId]])->get();
            \Log::info("lineUser:".count($lineUser));
            
			// $uds = $connection->query('SELECT * FROM botudata WHERE uid="'.$uId.'"');
            // $udss = $uds->fetchAll(PDO::FETCH_ASSOC);
            if(count($lineUser)>0){
                \Log::info('yes'.$dateTime);
                // $connection = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
                // $connection->query('set names utf8;');
                // DB::update('update botudata set uName=?,uImgURL=?,uTitleMessage=?,updateTime=? where uid = ?', [$uName,$uImgURL,$uTitleMessega,$dateTime,$uId]);
                DB::table('botudata')->where('uid', $uId)->update(['uName'=>$uName, 'uImgURL'=>$uImgURL, 'uTitleMessage'=>$uTitleMessega, 'updateTime'=>$dateTime]);
                // $connection->query('update botudata set 
                //                             uName="'.$uName.'", uImgURL="'.$uImgURL.'", uTitleMessage="'.
                //                             $uTitleMessega.'", updateTime="'.$dateTime.'" where uid = "'.$uId.'"');
            }
            else{
                \Log::info('no');
                // $connection = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql4463017;', 'sql4463017', 'ZcRmWLMZ3s');
                // $connection->query('set names utf8;');
                DB::table('botudata')->insert([
                    'uid'=>$uId, 'uName'=>$uName, 
                    'uImgURL'=>$uImgURL, 'uTitleMessage'=>$uTitleMessega,
                    'uindex'=>0, 'createTime'=>$dateTime,
                    'updateTime'=>$dateTime
                ]);
                // $connection->exec('INSERT INTO botudata (uid, uName, uImgURL, uTitleMessage, 
                // uindex, createTime, updateTime) VALUES ("'.$uId.'","'.
                // $uName.'", "'.$uImgURL.'","'.$uTitleMessega.'",0,"'.$dateTime.'","'.$dateTime.'")');
                // DB::table('botudata')->insert([
                //     'uid'=>$uId,
                //     'uName'=>$uName,
                //     'uImgURL'=>$uImgURL,
                //     'uTitleMessage'=>$uTitleMessega,
                //     'uindex'=>0
                // ]);
                // $this->pdoConn->exec('INSERT INTO botudata VALUES ("'.$uId.'","'.$uName.'", "'.$uImgURL.'","'.$uTitleMessega.'")');
            }
        }
    }

    public function dbtest(){
        $messages = DB::select('select * from message where u_text=?', ['嗨']);
        return $messages[0]->re_text;//json_encode($messages);//count($messages[0]->re_text);
    }

    public function buildTemplateMessageBuilderDeprecated(
        string $imagePath,
        string $directUri,
        string $label
    ): TemplateMessageBuilder {
        $aa = new UriTemplateActionBuilder($label, $directUri);
        $bb =  new ImageCarouselColumnTemplateBuilder($imagePath, $aa);
        $target = new ImageCarouselTemplateBuilder([$bb, $bb, $bb, $bb, $bb, $bb, $bb, $bb]);

        return new TemplateMessageBuilder('test123', $target);
    }
    
    public function dbT()
    {
        $row = null;
        // $messageD = DB::select('SELECT * from sql6401619.message where u_text="抽菸的規矩"');
        try {
            $ttt = null;
            // $posts=DB::table('sql6401619.message')->where('u_text', '=', "tw")->count();
            // return 'select date count: '.$posts.'筆';
            $posts=DB::table('sql6401619.message')->get();
            foreach($posts as $v){
                $ttt .= $v->reType.'<br>';
            }
            return $ttt;
        } catch (\Exception $exception) {
            dd($exception->getMessage());//注意不要輸出這個
        }
        //'筆, re_text: '.$posts[0]->re_text;//$row;//'+++';//
    }
}
