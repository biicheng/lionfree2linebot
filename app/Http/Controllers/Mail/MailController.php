<?php

namespace App\Http\Controllers\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Mail;   //使用Laravel Mail工具

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        // \Log::info($request);
        $data = $request->all();
        
        //Laravel Mail 使用方法可參考：https://laravel.com/docs/5.1/mail#sending-mail         
        Mail::send('mail', $data, function ($message) use ($data) {
            // $message->from(ENV('MAIL_USERNAME', $data['email']), $data['name']);
            $message->to(ENV('MAIL_SUPPORT', $data['email']))->subject('Feedback Mail');
        });
        return "success";
    }
    
    public function sendMailT()
    {
        // \Log::info($request);
        $data = array();
        $data['content'] = '系統信件，請勿回覆.';
        $data['email'] = "本系統";//'k1031616@yahoo.com.tw';
        $data['name'] = '';
        
        //Laravel Mail 使用方法可參考：https://laravel.com/docs/5.1/mail#sending-mail         
        Mail::send('mail', $data, function ($message) use ($data) {
            // $message->from(ENV('MAIL_USERNAME', $data['email']), $data['name']);
            $message->to(ENV('MAIL_SUPPORT', 'k1031616@yahoo.com.tw'))->subject('Feedback Mail');
        });
        return "success";
    }
}