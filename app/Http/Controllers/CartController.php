<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function Render(){
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $cart = DB::table('cart')->where('user',$user_id)
                                 ->count();
        $howManyItems =  json_encode($cart);
        return view('cart',['isAuth'=>$user,'id'=>$user_id,'howManyItems' => $howManyItems]);
    }
    public function addToCart(Request $req){
        $user_id = Auth::user()->id;
        $cart = DB::table('cart')->where('user',$user_id)
                ->select('product','velicina','kolicina')
                ->get();
        $isFound = false;
        foreach ($cart as $row) {
            $product = $row->product;
            $velicina = $row->velicina;
            $kolicina = $row->kolicina;
            if($product == $req->id && $velicina == $req->velicina){
                $kolicina = $kolicina + $req->kolicina;
                DB::table('cart')->where('user',$user_id)
                    ->where('product',$product)
                    ->where('velicina',$velicina)
                    ->update(['kolicina'=>$kolicina]);
                $isFound = true;
            }
        }
        if($isFound == false){
            $newItem = new Cart();
            $newItem->product=$req->id;
            $newItem->user=$user_id;
            $newItem->kolicina=$req->kolicina;
            $newItem->velicina=$req->velicina;
            $newItem->save();
        }
        return json_encode($isFound);

        
    }
    public function deleteFromCart(Request $req){
        $id = $req->id;
        $velicina = $req->velicina;
        $user_id = Auth::user()->id;
        DB::table('cart')->where('user',$user_id)->where('product',$id)->where('velicina',$velicina)->delete();
        return json_encode(200);
    }

}