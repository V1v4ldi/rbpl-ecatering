<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mx-auto max-w-screen-xl mt-15">
        <div class="text-center text-4xl font-bold mb-[45px]">
            Produk Kami
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            @foreach($products as $product)
                <div class="p-4 rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="{{ asset('storage/product/'. $product->imgname) }}" alt="Rendang Daging Sapi" class="w-full h-full object-cover rounded-[6px]">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">{{ $product->nama }}</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $product->deskripsi }}</p>
                    <p class="font-semibold text-[#ff9a00] mb-4">{{ $product->harga }}</p>
                    <button class="w-full py-2 border rounded-[6px] border-[#ff9a00] text-[#ff9a00] font-semibold transition-all duration-300 hover:bg-[#ff9a00] hover:text-white cursor-pointer">Add to Cart</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>