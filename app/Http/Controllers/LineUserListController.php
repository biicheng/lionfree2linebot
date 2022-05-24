<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LineUserListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function LineUserList(){
        // abort(404);
        // return redirect()->back();
        \Log::info("id:".Auth::id());
        if (Auth::id()==1) {
            \Log::info("123");
            return 1;
        }
    }
}
