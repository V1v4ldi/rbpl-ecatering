<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Cloudinary\Cloudinary;

class Menucontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('nama', 'asc')->get();

        $products->transform(function ($product){
            $product->enc_id = Crypt::encrypt($product->product_id);
            unset($product->product_id);
            return $product;
        });

        return response()->json($products);
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
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:10000',
        ]);
        
        if($request->hasFile('image')){
            $cloudinary = new Cloudinary(env("CLOUDINARY_URL"));
            $uploadApi =  $cloudinary->uploadApi();
            $result = $uploadApi->upload($request->file('image')->getRealPath());

            $url = $result['secure_url'];
            $public_id = $result['public_id'];
        }
        else{
            return back()->with('UploadError', 'File Tidak Ditemukan');
        }
        
        product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'image_url' => $url,
            'public_id' => $public_id,
        ]);
        return response()->json(['message' => 'Produk Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($produkId)
    {
        $product_id = Crypt::decrypt($produkId);

        $product = product::where('product_id', $product_id)->firstOrfail();

        
        $product->enc_id = Crypt::encrypt($product_id);

        unset($product->product_id);

        return response()->json($product);
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
    public function update(Request $request, $produkId)
    {
       $product_id = Crypt::decrypt($produkId);
       $product = product::where('product_id', $product_id)->firstOrFail();

        $request->validate([
            'product_id' => 'required|string',
            'nama' => 'required|string|max:50',
            'harga' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10000',
        ]);

        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;

        // Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
            $uploadApi  = $cloudinary->uploadApi();
            if ($product->image) {
                $uploadApi->destroy($product->public_id);
            }
            $result = $uploadApi->upload($request->file('image')->getRealPath());

            $product->image_url = $result['secure_url'];
            $product->public_id = $result['public_id'];
        }

        $product->save();

        return response()->json(['message' => 'Produk Berhasil Diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($produkId)
    {
        $product_id = Crypt::decrypt($produkId);

        $product = product::where('product_id', $product_id)->firstOrfail();

        if ($product->public_id) {
            (new Cloudinary(env('CLOUDINARY_URL')))
                ->uploadApi()
                ->destroy($product->public_id);
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus!']);
    }
}
