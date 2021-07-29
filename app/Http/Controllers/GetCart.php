<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class GetCart extends Controller
{
    public function GetYourCart(request $req){
        $id = $req->id;
        $cart = DB::table('cart')->where('user',$id)
                                ->select('product','velicina','kolicina')
                                ->get();
        return json_encode($cart);
    }
}
