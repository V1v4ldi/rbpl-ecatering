<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showregis(){
        return view('register', ['title' => 'Register', 'daftar' => 'true']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:50',
            'email' => 'required|email|unique:customer,email|max:100',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:15',
        ]);
        
        customer::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->phone_number,
        ]);
        return redirect()->route('login');
    }
}
