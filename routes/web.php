<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Index;
use App\Http\Controllers\MajcaID;
use App\Http\Controllers\Navbar;
use App\Http\Controllers\LoginCheck;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GetCart;
use App\Http\Controllers\PleaseLoginController;
use App\Http\Controllers\SpecialQueries;
use App\Http\Controllers\DeleteFromCart;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[Index::class,'Render']);
Route::get('/navbar',[Navbar::class,'navbar']); // za pokle pogledat navbar
Route::get('/gobble',[MajcaID::class,'gobble']);
Route::get('/please',[PleaseLoginController::class,'render']);

Route::get('/filter',[SpecialQueries::class,'hasYourNumber']);


Route::get('/logOut',[LoginCheck::class,'login']);
Route::get('/Majca/{id}',[MajcaID::class,'GetByID']);
Route::post('/MajcaInfo',[MajcaID::class,'GetByIDPOST']);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/page/{id}',[Index::class,'Page']);

Route::group(['middleware'=>['ProtectedPage']],function (){
    Route::post('/delete',[CartController::class,'deleteFromCart']);
    Route::get('/cart',[CartController::class,'Render']);
    Route::get('/GetCart',[GetCart::class,'GetYourCart']);
    Route::post('/cart',[CartController::class,'addToCart']);
});