<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;

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
        //Dashboard dan Profil
        Route::get('/admin',[UserController::class,'admin']);

        //Stock obat
        Route::get('/admin/stock',[StockController::class,'index'])->name('admin.stock.index');
        Route::get('/admin/stock/create',[StockController::class,'create'])->name('admin.stock.create');
        Route::get('/admin/stock/update',[StockController::class,'update']);
        Route::post('/admin/stock/store',[StockController::class,'store'])->name('admin.stock.store');
        Route::get('/admin/stock/{id}/edit',[StockController::class,'edit'])->name('admin.stock.{id}.edit');
        Route::put('/admin/stock/{id}/edit',[StockController::class,'update'])->name('admin.stock.store');
        Route::delete('/admin/stock/{id}', [StockController::class, 'destroy'])->name('admin.stock.destroy');


        //Transaction
        Route::get('/admin/transaction',[TransactionController::class,'index'])->name('admin.transaction.index');
        Route::get('/admin/transaction/create',[TransactionController::class,'create'])->name('admin.transaction.create');
        Route::get('/admin/transaction/update',[TransactionController::class,'update']);
        Route::post('/admin/transaction/store',[TransactionController::class,'store'])->name('admin.transaction.store');
        Route::get('/admin/transaction/{id}/edit',[TransactionController::class,'edit'])->name('admin.transaction.{id}.edit');
        Route::put('/admin/transaction/{id}/edit',[TransactionController::class,'update'])->name('admin.transaction.store');
        Route::delete('/admin/transaction/{id}', [TransactionController::class, 'destroy'])->name('admin.transaction.destroy');
    });

    //Logout
    Route::get('/logout',[SessionController::class,'logout']);
});