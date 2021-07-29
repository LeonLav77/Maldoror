<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Majca;
class MajcaAdd extends Controller
{
    public function addData(Request $req){
        $member = new Majca;
        $member->naslov=$req->naslov;
        $member->cijenaUKN=$req->cijenaUKN;
        $member->dostupneVelicine=$req->dostupneVelicine;
        $member->slika1=$req->slika1;
        $member->slika2=$req->slika2;
        $member->save();
    }
    public function deleteById($id){
        $data=Majca::find($id);
        $data->delete();
        return redirect("/");
    }
}
