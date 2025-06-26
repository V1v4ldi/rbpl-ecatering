<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class LoginController extends Controller
{
    public function showlogin(){
        return view('register', ['title' => 'Login', 'daftar' => 'false']);
    }
    
    public function checklogin(Request $request){
        $validator = Validator::make($request->all(), [
            'e-mail' => 'required|email',
            'pw' => 'required|min:8'
        ]);

        // 3. Cek jika validasi GAGAL
        if ($validator->fails()) {
            // 4. Kembalikan dengan SATU pesan error custom yang sama
            return back()
                ->with('loginError', 'Format email atau password salah.')
                ->withInput($request->only('e-mail')); // Mengembalikan input email agar tidak perlu ketik ulang
        }

        $cred = [
            'email' => $request->input('e-mail'),
            'password' => $request->input('pw'),
        ];
        
        if(Auth::guard('customer')->attempt($cred)){
            
            $request->session()->regenerate();
            
            return redirect()->route('home');
        }
        elseif(Auth::guard('admin')->attempt($cred)){
            $request->session()->regenerate();
            
            return redirect()->route('admin.home');
        }
        elseif(Auth::guard('owner')->attempt($cred)){
            $request->session()->regenerate();
            
            return redirect()->route('owner.home');
        }
        return back()->with('loginError', 'Pengguna tidak terdaftar atau password salah.');
    }

    public function logout(Request $request){
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
