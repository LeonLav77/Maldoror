<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteFromCart extends Controller
{
    public function delete(){
        $id = request()->id;
        return json_encode($this->cart->delete($id));
    }
}
