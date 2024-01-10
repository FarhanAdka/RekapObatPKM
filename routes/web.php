<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function(){
    Route::get('/',[SessionController::class,'index']);
    Route::post('/',[SessionController::class,'login']);
});
Route::get('/home',function(){
    return redirect('/user');
})->name('home');
Route::middleware(['auth'])->group(function(){
    //User
    Route::get('/user',[UserController::class,'index']);
    
    //Admin
    Route::middleware(['userAccess:admin'])->group(function (){
        Route::get('/admin',[UserController::class,'admin']);
    });

    //Logout
    Route::get('/logout',[SessionController::class,'logout']);
});