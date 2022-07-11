<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiRequestMapController extends Controller
{
    public function insertD_API_returnD($result,$resultT,$errCode)
    {
        $reText = [];
        $reText['result'] = $result;
        $reText['resultT'] = $resultT;
        $reText['errCode'] = $errCode;

        return $reText;
    }
}
