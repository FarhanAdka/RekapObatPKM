<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index(){
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]
        );

        $infologin=[
            'username'=>$request->username,
            'password'=>$request->password
        ];

        if(Auth::attempt($infologin)){
            return redirect('admin');
        }
        else{
            return redirect('')->withErrors('Username atau pasword tidak sesuai')->withInput();
        }
    }
    function logout(){
        Auth::logout();
        return redirect('');
    }
}
