<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MajcaID extends Controller
{
    public function GetByID($id){
        $arr=$this->getData($id);
        $user = Auth::user();
        if ($user  != ''){
            $user = $user->id;
        $cart =DB::table('cart')->where('user',$user)
                                ->count();
        $howManyItems =  json_encode($cart);
        }else{
            $howManyItems = '';
        }
        return view("pojedinaMajca",['howManyItems'=>$howManyItems,'isAuth'=>$arr['isAuth'],'duzina'=>$arr['duzina'],'id'=>$arr['id'],'naslov'=>$arr['naslov'],'dostupneVelicine'=>$arr['dostupneVelicine'],'cijenaUKN'=>$arr['cijenaUKN'],'slika1'=>$arr['slika1'],'slika2'=>$arr['slika2']]);
    }
    public function getByIDPOST(){
        $id = $_POST['id'];
        $data = $this->getData($id);
        return json_encode($data);
    }
    public function getData($id){
        $user = DB::table('majce')->find($id);
        $id = $user->id;
        $naslov = $user->naslov;
        $dostupneVelicine = $user->dostupneVelicine;
        $cijenaUKN = $user->cijenaUKN;
        $slika1 = $user->slika1;
        $slika2 = $user->slika2;
        $imeNastavka = "/1.png";
        $slika1 = str_replace($imeNastavka,"",$slika1);
        $slika1 = str_replace("/","",$slika1);
        $slika1 = $slika1 . $imeNastavka;
        $slika1 = "http://mockapi.ddns.net/YEE/".$slika1;
        if(isset($slika2)){
            $imeNastavka = "/2.png";
            $slika2 = str_replace($imeNastavka,"",$slika2);
            $slika2 = str_replace("/","",$slika2);
            $slika2 = $slika2 . $imeNastavka;
            $slika2 = "http://mockapi.ddns.net/YEE/".$slika2;
        }
        $dostupneVelicine = explode(',',$dostupneVelicine);
        $duzina = count($dostupneVelicine);
        $user = Auth::user();
        $arr = ['isAuth'=>$user,'duzina'=>$duzina,'id'=>$id,'naslov'=>$naslov,'dostupneVelicine'=>$dostupneVelicine,'cijenaUKN'=>$cijenaUKN,'slika1'=>$slika1,'slika2'=>$slika2];
        return $arr;
    }
    public function gobble(){
        $startPoint = $_GET['startPoint'];
        $endPoint = $startPoint + 39;
        $haveToMatch = DB::table('majce')->whereRaw("majce.id BETWEEN $startPoint AND $endPoint");
        // i need to add 4 more because in between 0 and 40 there are 39 i guess
        // its late im confused, probably some tshirts in db problem
        // some ids are not in database, put some placeholder ones
        $user = $haveToMatch->get();
        return json_encode($user);
    }

}
