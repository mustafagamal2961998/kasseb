<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
       
        if(Auth::guard('admin')->check()){
            return redirect()->route('dashboard.home.index');
        }
        
        return view('Dashboard.Auth.index');
    }

    public function store(LoginRequest $request){
        
        if(!Auth::guard('admin')->attempt(['username'=>$request->username,'password'=>$request->password])){
            return redirect()->route('dashboard.auth.index')->with('error','عفوا حدث خطأ في تسجيل الدخول');
        }
       
        return redirect()->route('dashboard.home.index');
    }
}
