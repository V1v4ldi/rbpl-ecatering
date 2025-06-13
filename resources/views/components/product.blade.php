<div id="products-container" class="">
            <!-- ✅ Loading indicator (hidden by default) -->
            <div id="loading-indicator" class="hidden text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500"></div>
                <p class="mt-2 text-gray-600">Memuat produk...</p>
            </div>
            
            <!-- ✅ Products grid -->
            <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
                @foreach($products as $product)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:-translate-y-1 transition-transform duration-300 p-2">
                    <div class="h-44 overflow-hidden">
                        <img src="{{ asset('storage/product/'. $product->imgname) }}" alt="{{ $product->nama }}" class="w-full h-full rounded-[6px] object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-1">{{ $product->nama }}</h3>
                        <p class="text-sm text-gray-600 mb-1">{{ $product->deskripsi }}</p>
                        <p class="font-semibold mb-3">Rp. {{ number_format($product->harga,0,',','.') }}</p>
                        <button class="cursor-pointer w-full py-2 border border-[#ff9a00] text-[#ff9a00] hover:bg-[#ff9a00] hover:text-white transition-colors rounded font-medium add-to-cart" data-productid="{{ $product->product_id }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ✅ Pagination links -->
            <div id="pagination-container" class="mb-10">
                {{ $products->links() }}
            </div>
        </div>