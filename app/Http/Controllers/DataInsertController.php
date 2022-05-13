<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //20220513 add
//20220513 add
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use Illuminate\Http\File;

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
        // $request = $request->all();
        // if($request['reType']=='text' && $request['BotText']!=""){
        //     return view('insert',[
        //         'alert'=>'success',
        //         'alertT'=>'新增文字回覆成功.',
        //         'postT'=>true,
        //     ]);
        // }
        // else if($request['reType']=='img' && $request['bImg']!="" && $request['sImg']!=""){
        //     return view('insert',[
        //         'alert'=>'success',
        //         'alertT'=>'新增圖片回覆成功.',
        //         'postT'=>true,
        //     ]);
        // }
        // else{//insertErr
        //     return view('/insert',[
        //         'alert'=>'danger',
        //         'alertT'=>'資訊錯誤，新增失敗.',
        //         'postT'=>true,
        //     ]);
        // }
        #正常可以用
        // Storage::disk('local')->put('file.txt', 'Contents');

        // $request = $request->input();
        // $request = $request->all();

        $bImgName = Storage::disk('public')->put('img/linebot_img/'.$request->input('bImg'), $request->file('bImg'), 'public');
        // Storage::putFileAs('photos', new File(), $request->file('bImg'));
        // $bImgNewName = explode('//', $bImgName);
        $bImgNewName = mb_split('//', $bImgName);
        // Storage::move($bImgNewName[1], public_path().$bImgNewName[1]);
        // $bImgURL = 'public/'.Storage::url($bImgNewName[1]);
        // Storage::copy(storage_path('app\\'.$bImgNewName[1]), public_path('img\\').$bImgNewName[1]);
        // $bImgNewName->copy(storage_path('app\public'));

        // $sImgName = Storage::disk('local')->put('public/'.$request->input('bImg'),$request->file('sImg'));
        // $sImgNewName = explode('//', $sImgName);
        // $sImgNewName = mb_split('//', $sImgName);

        //檢查檔案是否存在
        // Storage::exists('old/file.jpg')

        \Log::info("...".Storage::exists(storage_path('app\\'.$bImgNewName[1])));
        // echo storage_path('app\public\\').$bImgNewName[1];
        if($request->input('reType')=='text' && $request->input('BotText')!=""){
            return view('insert',[
                'alert'=>'success',
                'alertT'=>'新增成功.',
                'postT'=>true,
            ]);
        }
        else if($request['reType']=='img' && $request['bImg']!="" && $request['sImg']!=""){
            return view('insert',[
                'alert'=>'success',
                'alertT'=>'新增成功.',
                'postT'=>true,
            ]);
        }
        else{
            return view('/insert',[
                'alert'=>'danger',
                'alertT'=>'資訊錯誤，新增失敗.',
                'postT'=>true,
            ]);
        }
    }
}
