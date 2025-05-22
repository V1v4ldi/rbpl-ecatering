<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Alluser extends Controller
{
/*
        {{-- Customer Controller --}}
*/  
    public function customerprofile()
        {
            return view('logged-in.profile', ['title' => 'Profile']);            
        }

/*
        {{-- ADMIN CONTROLLER --}}
*/
    public function adminhome(Request $request){
        return view('admin.home', ['title' => 'Home Admin']);
    }

    public function adminprofile()
        {
            return view('logged-in.profile', ['title' => 'Profile']);            
        }
    
/*
        {{-- OWNER CONTROLLER --}}
*/ 
     
    public function ownerhome()
        {
            return view('owner.home', ['title' => 'Home Owner']);            
        }


    public function ownerprofile()
        {
            return view('logged-in.profile', ['title' => 'Profile']);            
        }
}
