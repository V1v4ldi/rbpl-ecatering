<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class LoginController extends Controller
{
    public function showlogin(){
        return view('register', ['title' => 'Login', 'daftar' => 'false']);
    }
    
    public function checklogin(Request $request){
        $validated = $request->validate([
            'e-mail' => 'required|email',
            'pw' => 'required|min:8'
        ]);

        $cred = [
            'email' => $validated['e-mail'],
            'password' => $validated['pw'],
        ];
        
        if(Auth::guard('customer')->attempt($cred)){
            
            $request->session()->regenerate();
            
            return redirect()->route('home');
        }
        elseif(Auth::guard('admin')->attempt($cred)){
            $request->session()->regenerate();
            
            return redirect()->route('adminhome');
        }
        elseif(Auth::guard('owner')->attempt($cred)){
            $request->session()->regenerate();
            
            return redirect()->route('ownerhome');
        }
        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request){
        Auth::guard('customer')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('owner')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
