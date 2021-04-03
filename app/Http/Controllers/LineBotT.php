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
    private $sender;
    public function postTest(Request $cc){
        $dates = date("Y-m-d H:i:s");
        
        if(!empty($cc->input('events')[0]['message']['text'])){
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
    
            // if($source_userId!='U7b6cf61ae9975bc4b800b1146a840ed2'){
            //     DB::insert('insert into lined (datT, dataTime) values (?, ?)', [$obj, $dates]);
            // }
            
        
    
            $ch = curl_init();
            $url = "https://api.line.me/v2/bot/profile/".$source_userId;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec ($ch);
            $err = curl_error($ch);  //if you need
            curl_close ($ch);
    
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);
            $response = $bot->getProfile($source_userId);
            if ($response->isSucceeded()) {
                $profile = $response->getJSONDecodedBody();
                if(!empty($profile['displayName'])){
                    \Log::info('displayName: '.$profile['displayName']);
                }
                else{
                    \Log::info('displayName: 無'.', err:'.$err);
                }
                if(!empty($profile['pictureUrl'])){
                    \Log::info('pictureUrl: '.$profile['pictureUrl']);
                }
                else{
                    \Log::info('pictureUrl: 無'.', err:'.$err);
                }
                if(!empty($profile['statusMessage'])){
                    \Log::info('statusMessage: '.$profile['statusMessage']);
                }
                else{
                    \Log::info('statusMessage: 無'.', err:'.$err);
                }
            }
            
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);
    
            $i = 0;
            $messages = DB::select('select * from message where u_text=?', [$message_text]);
            if(count($messages)==1){
                if($messages[0]->reType=='text'){
                    $txt = $this->pushText($messages[0]->re_text, $replyToken);
                }
                else if($messages[0]->reType=='select'){
                }
                else if($messages[0]->reType=='img'){
                    $txt = $this->pushImg($messages[0]->bImg, $messages[0]->sImg, $replyToken);
                }
                else{
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($messages[0]->re_text);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                }
            }
            else{
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message_text);
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
            }
            
            if ($response->isSucceeded()) {
                \Log::info($source_userId.' --bot: yes.');
            }
            else{
                \Log::info($source_userId.' --bot: no.');
            }
        }
        else{
            $txt = $this->pushText('請輸入文字...', $cc->input('events')[0]['replyToken']);
        }
        
        
        // \Log::info($response->getHTTPStatus() . ' ' . $response->getRawBody());
        // \Log::info('1message_text: '.$message_text);
        // \Log::info($replyToken);

        return 'hello.';
    }

    public function pushImg($bImg, $sImg, $replyToken){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);

        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($bImg, $sImg);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        return 'ok';
    }
    public function pushText($text, $replyToken){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);

        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        return 'ok';
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
}
