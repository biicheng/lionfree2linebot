<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 use Illuminate\Support\Facades\Log;
 use LINE\LINEBot;
 use LINE\LINEBot\Event\MessageEvent;
 use LINE\LINEBot\HTTPClient\CurlHTTPClient;

// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LineBotT extends Controller
{
    public function postTest(Request $cc){
        $dates = date("Y-m-d H:i:s");
        
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

        $obj = 'destination:'.$destination.', events_type:'.$events_type.
                ', replyToken:'.$replyToken.', timestamp:'.$timestamp.
                ', mode:'.$mode.', message_Id:'.$message_Id.
                ', message_type:'.$message_type.', message_text:'.$message_text.
                ', source_userId:'.$source_userId.', source_type:'.$source_type;
        // $text = $cc->input('events')[0]['message']['text'];
        // $text = $cc->input('events')[0]['message']['text'];

        // if($source_userId!='U7b6cf61ae9975bc4b800b1146a840ed2'){
        //     DB::insert('insert into lined (datT, dataTime) values (?, ?)', [$obj, $dates]);
        // }
        
    

        // $ch = curl_init();
        // $url = "https://api.line.me/v2/bot/profile/".$source_userId;
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec ($ch);
        // $err = curl_error($ch);  //if you need
        // curl_close ($ch);
        // \Log::info('response:'.$response.', err:'.$err);

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);
        $response = $bot->getProfile($source_userId);
        if ($response->isSucceeded()) {
            $profile = $response->getJSONDecodedBody();
            // $displayName = $profile['displayName'];
            // $pictureUrl = $profile['pictureUrl'];
            // $statusMessage = $profile['statusMessage'];
            \Log::info('displayName:'.$profile['displayName'].', Uid:'.$source_userId);
            // \Log::info('pictureUrl:'.$profile['pictureUrl']);
            // \Log::info('statusMessage:'.$profile['statusMessage']);
        }
        
        // DB::insert('insert into lined (datT, dataTime) values (?, ?)', [$output->exception, $dates]);
        // $this - > response['response'] = json_decode($output);

        
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);

        // $text = request()->input('events')[0]['message']['text'];
        // $replyToken = request()->input('events')[0]['replyToken'];
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message_text);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        if ($response->isSucceeded()) {
            return '--';
        }
        $to ="fish970628@gmail.com "; //收件者
        $subject = "Line Bot Message"; //信件標題
        $msg = "text: ".$message_text;//信件內容
        $headers = "k1031616@yahoo.com.tw"; //寄件者
        
        if(mail("$to", "$subject", "$msg", "$headers")){
            echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
        }else{
            echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
        }
        
        // \Log::info($response->getHTTPStatus() . ' ' . $response->getRawBody());
        // \Log::info('1message_text: '.$message_text);
        // \Log::info($replyToken);

        return 'hello.';
        // return "{destination: ".$destination.",[0]{events_type:".
        //         $events_type.", replyToken:".$replyToken.", timestamp:".
        //         $timestamp.", mode:".$mode.", message:{ message_Id".
        //         $message_Id.", message_type:".$message_type.", message_text:".
        //         $message_text."}, source:{ source_userId:".
        //         $source_userId.", source_type:".$source_type.",}}}";

    }
}
