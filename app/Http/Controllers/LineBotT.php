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
            // $displayName = $profile['displayName'];
            // $pictureUrl = $profile['pictureUrl'];
            // $statusMessage = $profile['statusMessage'];
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
            // \Log::info('displayName:'.$profile['displayName'].', Uid:'.$source_userId);
            // \Log::info('pictureUrl:'.$profile['pictureUrl']);
            // \Log::info('statusMessage:'.$profile['statusMessage']);
        }
        
        // DB::insert('insert into lined (datT, dataTime) values (?, ?)', [$output->exception, $dates]);
        // $this - > response['response'] = json_decode($output);

        
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ym0T5CEd4bHEZMZiGPalBWAS/YgXNznsTAmI5v83bMHRIEdxA6MyQ7B7KG0jRPgfjitgebHz9PL0IaJym/7IrhoaPyOF+6gDTjuKB6mN+FuYncPrcW95Fe2vJKqskTWkfu3vVTV4GPWIyVNW3ZdGSgdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4b91553e4c688509a050ba0f29208a90']);

        // $text = request()->input('events')[0]['message']['text'];
        // $replyToken = request()->input('events')[0]['replyToken'];

        $i = 0;
        $messages = DB::select('select * from message where 1');
        // \Log::info(count($messages));
        foreach ($messages as $mm) {
            // echo $user->name;
            // \Log::info($mm->reType);
            if(count($messages)==$i+1){
                if($mm->u_text==$message_text){
                    $i=0;
                    if($mm->reType=='text'){
                        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($mm->re_text);
                        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                    }
                    else{
                        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($mm->re_text);
                        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                    }
                }
                else{
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message_text);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                }
            }
            else if($mm->u_text==$message_text){
                $i=0;
                if($mm->reType=='text'){
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($mm->re_text);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                }
                else{
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($mm->re_text);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                }
            }
            $i++;
        }
        // if($message_text=='嗨'){
        //     $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Hi！');
        //     $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        // }
        // else{
        //     $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message_text);
        //     $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        // }
        
        if ($response->isSucceeded()) {
            // return '--';
            \Log::info($source_userId.' --bot: yes.');
        }
        else{
            \Log::info($source_userId.' --bot: no.');
        }
        
        // \Log::info($response->getHTTPStatus() . ' ' . $response->getRawBody());
        // \Log::info('1message_text: '.$message_text);
        // \Log::info($replyToken);

        return 'hello.';
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
