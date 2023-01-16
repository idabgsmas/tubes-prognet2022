<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function login (Request $request){
        // dd($request->all());
        $icon = 'ni ni-dashlite';
        $iconn = 'ni clock';
        $subtitle = 'USERS';
        $table_id = 'users';
        $data = User::all();
        if(Auth::attempt($request->only('email','password'))){
            return redirect("crud");
        }
        return redirect ('login',compact('subtitle','table_id','icon','data'));
    }

    public function logout (Request $request){
        // dd($request->all());
        Auth::logout();
        return redirect("/");
    }
}
