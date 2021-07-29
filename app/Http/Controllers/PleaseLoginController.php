<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PleaseLoginController extends Controller
{
    public function render(){
        return view('pl',['isAuth'=>""]);
    }
}
