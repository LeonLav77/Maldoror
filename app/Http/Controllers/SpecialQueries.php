<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialQueries extends Controller
{
    public function hasYourNumber(){
        $yourNumber = $_GET['yourNumber'];
        $brojStranice = $_GET['brojStranice'];
        $filterData = DB::table('majce')->where('dostupneVelicine','LIKE',$yourNumber.'%')
        ->skip(($brojStranice-1)*40)
        ->take($brojStranice*40)             
        ->get();
        $numberOfResults = DB::table('majce')->where('dostupneVelicine','LIKE',$yourNumber.'%')->count();
        return ['filteredData'=>$filterData,'ukupanBroj'=>$numberOfResults];
    }
}
