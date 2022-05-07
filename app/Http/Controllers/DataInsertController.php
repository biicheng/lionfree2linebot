<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //20220505 add
//20220506 add
// use Intervention\Image\ImageManagerStatic as Image;  
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use DB;
use Auth;
use App\User;
use App\Photo;

class DataInsertController extends Controller
{
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('insert',[
            'alert'=>'danger',
            'alertT'=>'',
            'postT'=>false,
        ]);
    }

    public function insertD(Request $request)
    {
        $request = $request->all();
        if($request['reType']=='text' && $request['BotText']!=""){
            return view('insert',[
                'alert'=>'success',
                'alertT'=>'新增文字回覆成功.',
                'postT'=>true,
            ]);
        }
        else if($request['reType']=='img' && $request['bImg']!="" && $request['sImg']!=""){
            return view('insert',[
                'alert'=>'success',
                'alertT'=>'新增圖片回覆成功.',
                'postT'=>true,
            ]);
        }
        else{//insertErr
            return view('/insert',[
                'alert'=>'danger',
                'alertT'=>'資訊錯誤，新增失敗.',
                'postT'=>true,
            ]);
        }
    }
}
