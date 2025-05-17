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

        $lastNumber = customer::selectRaw('MAX(CAST(SUBSTRING(customer_id, 6) AS UNSIGNED)) as max_number')->first()->max_number;
        $newNumber = $lastNumber ? $lastNumber + 1 : 1;
        $newId = 'cust-' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
        
        customer::create([
            'customer_id' => $newId,
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->phone_number,
            'role' => 'customer',
        ]);
        return redirect()->route('login');
    }
}
