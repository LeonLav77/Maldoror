<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Index extends Controller
{
    public function Render(){
        return redirect("/page/1");
    }
    public function Page($id){
        $startIndex = ($id-1)*40;
        $maxValue = DB::table('majce')->max('id');
        $kolikoStr = intval($maxValue / 40) + 1;
        if($id <= $kolikoStr && $id > 0){
            $user = Auth::user();
            if ($user  != ''){
                $user = $user->id;
                $cart = DB::table('cart')->where('user',$id)
                ->count();
                $howManyItems =  json_encode($cart);
            }else{
                $howManyItems = '';
            }
            return view("index",['id'=> $id,'startPoint'=>$startIndex,'yee'=>$kolikoStr,'isAuth'=>$user,'howManyItems'=>$howManyItems]);
        }else if($id < 1){
            return redirect("/page/1");
        }
        else{
            return redirect("/page/$kolikoStr");
        }
        // to do: redirect when page number to big DONE
        // to do: page nubmer 2 up and down and current DONE
        // to do: remove bug with db DONE
        // to do: make it prettier
        // to do: make a go back button DONE
        // to do: many db queries, npr only show if they have your size
        // to do: add to cart DONE
        // to do: cart  DONE
        // to do: navbar DONE
        // to do: maybe checkout
        // to do: MAKE IT FASTER GO BRRRR
        // to do: REFACTOR TRAIN CHOOO CHOOO CHOO
        // to do: dovrsit cart: da vidis kolko itema, maknut iteme button
        // automatsko racunanje koliko kosta
        // to do: clear filter button
    }
}
