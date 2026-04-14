<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParklaringInfo;

class ParklaringController extends Controller
{

    private function checkParklaringCode($uniqueCode){
        $parklaringInfo = ParklaringInfo::where('unique_code', $uniqueCode)->first();
        if($parklaringInfo){
            return true;
        }
        return false;
    }
    
    public function index(){
        $parklaringInfo = ParklaringInfo::all();
        return view('temp-reguler', compact('parklaringInfo'));
    }

    public function show($uniqueCode){
        
        if(!$this->checkParklaringCode($uniqueCode)){
            die('Sorry, the document is not found.');
        }else{
            $parklaringInfo = ParklaringInfo::with('department', 'contracts', 'approver')->where('unique_code', $uniqueCode)->first();

            //dd($parklaringInfo->toArray());

            if($parklaringInfo->publish == 0){
                die('Sorry, the document is not found.');
            }
            return view('temp-'.$parklaringInfo->template->template_name, compact('parklaringInfo'));
        }
    }

    public function generateUniqueCode(){
        $uniqueCode = substr(md5(uniqid(mt_rand(), true)), 0, 16);
        return $uniqueCode;
    }
}
