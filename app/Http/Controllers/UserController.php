<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        if(Auth::check()){
            return redirect('admin');
        }
        return view('login');
    }
    function admin(){
        $admin=User::where('id',auth()->user()->id)->get()->first();
        $info = [
            'active_side' => 'active',
            'active_sub' => 'active',
            'active_user' => 'active',
            'title'=>'Dashboard',
            'username'=>$admin->name
        ];
        // Mengambil stok yang akan habis dari StockController
        $stockController = new StockController();
        $data1=$stockController->getOutOfStock();
        $data2=$stockController->getExpiringStock();

        return view('admin.dashboard', $info)->with('data1', $data1)->with('data2', $data2);
    }
    function profile(){
        $admin=User::where('id',auth()->user()->id)->get()->first();

        $info = [
            'active_side' => 'active',
            'active_sub' => 'active',
            'active_user' => 'active',
            'title'=>'Profile',
            'admin'=>$admin,
            'username'=>$admin->name
        ];

        return view('admin.profile',$info);
    }
    function updateProfile(){
        
    }
}
