<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getParklaringInfo($uniqueCode){
        $parklaringInfo = ParklaringInfo::where('unique_code', $uniqueCode)->first();

        return view('temp-reguler', compact('parklaringInfo'));
    }

    public function generateUniqueCode(){
        $uniqueCode = substr(md5(uniqid(mt_rand(), true)), 0, 16);
        return $uniqueCode;
    }
}
