<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getproductspaginated(Request $request){
        $products = product::paginate(8);
        
        // Kalau request AJAX, return JSON untuk pagination
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'products' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem(),
                    'links' => $products->links()->render()
                ]
            ]);
        }
    }
}
