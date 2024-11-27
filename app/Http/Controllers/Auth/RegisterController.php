<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function viewRegisterPage(){
        return view('auth.register');
    }

    public function register(Request $req){
        $validate_credentials = $req->validate([
            'username' => ['required', 'min:4', 'max:50', 'regex:/^\S*$/', Rule::unique('users', 'username')],
            'name' => ['required', 'min:8', 'max:50'],
            'gender' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:50'],
            'terms_and_conditions' => ['required','accepted']
        ],  [ 'username.regex' => 'Username tidak boleh mengandung spasi.'
        ]);
        
        DB::beginTransaction();
        
        try {
            //Create cart for user
            $cart = Cart::create();
            
            //Create user
            $user = User::create([
                'username' => $validate_credentials['username'],
                'name' => $validate_credentials['name'],
                'email' => $validate_credentials['email'],
                'gender' => $validate_credentials['gender'],
                'password' => bcrypt($validate_credentials['password']),
                'cart_id' => $cart->id,
                'role' => 'USER',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error: register for username " . $validate_credentials['username'] . " with email " . $validate_credentials['email'] . "failed " . $e->getMessage());
            return back()->with('error', 'an error occurred during registration. Please try again with different username or email');
        }

        //login
        Auth::login($user, true);

        //redirect to dashboardPage
        return redirect()->route('dashboard.page')->with('success', 'Sign up successful. Hello ' . Auth::user()->username .' Welcome to Freshall!');
    }
}
