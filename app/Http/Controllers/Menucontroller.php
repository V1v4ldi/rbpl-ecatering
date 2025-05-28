<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\product as ModelsProduct;

class Menucontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required',
            'deskripsi' => 'required',
            'imgname' => 'required|image|mimes:jpg,jpeg,png,gif|max:10000',
        ]);
        
        if($request->hasFile('imgname')){
            $imgname = $request->file('imgname')->store(options: 'product');
        }
        else{
            return back()->with('UploadError', 'File Tidak Ditemukan');
        }
        
        product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'imgname' => $imgname,
        ]);
        return redirect()->route('adminhome');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
