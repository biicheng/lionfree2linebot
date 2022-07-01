<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\DB\dataSeleController;

class manageBotImgController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->dataSele = new dataSeleController;
    }

    public function imgList(){
        $bimg = $this->dataSele->getImgMaps('b',1);
        $simg = $this->dataSele->getImgMaps('s',1);
        $allImg = $this->dataSele->getImgMaps('all','all');

        return view('botimgList', [
                        'bimg'=>count($bimg)>0?$bimg:[],
                        'simg'=>count($simg)>0?$simg:[],
                        'allImg'=>count($allImg)>0?$allImg:[],
        ]);
    }
}
