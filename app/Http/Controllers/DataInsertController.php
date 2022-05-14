<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //20220513 add
//20220513 add
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use Illuminate\Http\File;

use App\Providers\RouteServiceProvider;

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
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $bImgName = Storage::disk('updateImg')->put('img/'.$request->input('bImg'), $request->file('bImg'), 'public');
        $bImgNewName = mb_split('//', $bImgName);
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
