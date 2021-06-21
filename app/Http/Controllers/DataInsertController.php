<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataInsertController extends Controller
{
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

    public function insertD(Request $Utxt)
    {
        $Utxt = $Utxt->input();
        // $reType = $Utxt->input('Utxt');
        if(!empty($Utxt['Utxt']) && !empty($Utxt['reType'])){
            \Log::info('Utxt: '.$Utxt['Utxt'].' -- reType: '.$Utxt['reType']);
            // return view('insert',[
            //     'postT'=>true,
            // ]);
            // redirect()->route
            return view('insert',[
                'alert'=>'success',
                'alertT'=>'新增成功.',
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
