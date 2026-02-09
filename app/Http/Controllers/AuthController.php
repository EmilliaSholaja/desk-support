<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register User
    public function register(Request $request){

        //1. Validation of fields
        $fields = $request->validate([
            'name'=> 'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed'
        ]);

        //2. Hashing of password
        $fields['password'] = Hash::make($fields['password']);


        //3. Creation of record
        $user = User::create($fields);

        //4. Login the user
        Auth::login($user);

        //5. Redirection of user
        return redirect('dashboard')->with([
            'success' => 'Registration successful',
            'failed' => 'Registration failed',
        ]);
    }

    //Login User
    public function login(Request $request){
        //1. Validation of field
        $field = $request->validate([
            'email' => 'required|email|string|',
            'password' => 'required|string',
        ]);

        //2. Attempt to login user, regenerate the session and redirect them
        if(Auth::attempt($field, $request->remember)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login Successful');
        }else{
            return back()->withErrors(['failed' => 'Login Failed']);
        }
    }

    public function logout(Request $request){
        //1. Logout User
        Auth::logout();

        //2. Invalidate the session
        $request->session()->invalidate();

        //3. Regenerate the token
        $request->session()->regenerateToken();

        //4. Redirect to 
        return redirect('/');

    }
}
