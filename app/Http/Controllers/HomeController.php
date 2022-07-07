<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; //20220707 add

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function lineBotHome(){
        $messagesD = DB::table('botmessage2line')->get();

        return view('lineBotHome', [
            'messageRow'=>$messagesD->count(),
            'messageD'=>$messagesD,
        ]);
    }
}
