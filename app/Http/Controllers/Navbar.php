<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Navbar extends Controller
{
    public function navbar(){
        return view('navbar');
    }
}
