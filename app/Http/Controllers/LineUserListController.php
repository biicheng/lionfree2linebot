<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DB\dataSeleController;//20220525
use App\Http\Controllers\laravelErrUIController;//20220525

class LineUserListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->sele = new dataSeleController;
        $this->reeUI = new laravelErrUIController;
    }

    function LineUserList(){
        // abort(404);
        // return redirect()->back();
        // \Log::info("id:".Auth::id());
        if(Auth::id()==1){
            $lineUserDB = $this->sele->seleBotUser();
            if($lineUserDB['code']==1){
                \Log::info("db:".getType($lineUserDB));
                return view('userList',[
                                    'd'=>$lineUserDB['data'],
                ]);
            }
            else{ $this->reeUI->laravel_404(); }
        }
        else{ $this->reeUI->laravel_404(); }
    }
}
