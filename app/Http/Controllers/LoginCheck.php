<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginCheck extends Controller
{
    public function login(){
        Auth::logout();
        return redirect("/");
    }
}
