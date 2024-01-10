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
        $data = array(
            'role'=>'Administrator',
            'title'=>'Dashboard',
            'name'=>$admin->name
        );
        return view('admin.dashboard',$data);
    }
}
