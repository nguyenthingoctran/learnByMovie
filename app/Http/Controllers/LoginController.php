<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class LoginController extends Controller
{
    public function getLogin(){
    	return view('enter.login');
    }

    public function postLogin(LoginRequest $request){

    	$login = [
    		'name' => $request->txtname,
    		'password' => $request->txtpass,
    		'level' => 1
    	];

    	if(Auth::attempt($login)){
    		return redirect('lbm_admin');
    	}else{
    		return redirect()->back()->withErrors('Sai tên hoặc mật khẩu.');
    	}
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
