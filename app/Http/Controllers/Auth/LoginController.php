<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function viewLoginpage(){
        return view('auth.login');
    }
    
    public function login(Request $req){
        $validate_credentials = array_merge([
            'remember' => false,
        ], $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:25'],
            'remember' => ['string', 'nullable']
        ]));

        $validate_credentials['remember'] = $validate_credentials['remember'] == 'true' ? true : false;
        //Try to login
        if (!Auth::attempt([
            'email' => $validate_credentials['email'],
            'password' => $validate_credentials['password']
            ], $validate_credentials['remember']))
        {
            return back()->with('error', 'Invalid credentials, pls try again with valid credentials');
        }
        
        return redirect()->route('dashboard.page')->with('success', 'Hello ' . Auth::user()->username);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('dashboard.page');
    }
}
