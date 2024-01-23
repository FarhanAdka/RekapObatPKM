<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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
            'username'=>$admin->name
        ];

        return view('admin.profile',$info)->with('admin',$admin);
    }
    function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->user()->id,
            'password' => 'nullable|string|min:6',
        ]);
    
        $admin = User::find(auth()->user()->id);
    
        $data = [
            'name' => $request->name,
            'username' => $request->username,
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $admin->update($data);
    
        return redirect()->route('admin.profile')->with('success', 'Profile berhasil diubah');
    }
}
