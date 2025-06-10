<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="max-w-6xl mx-auto px-4 py-12">
        
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-15 lg:mb-10">Pilihan Produk Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-5 lg:px-0 sm:px-0">
            <!-- Product -->
                @foreach ($products as $product)
            <div class="bg-white rounded-lg overflow-hidden shadow hover:-translate-y-1 transition-transform duration-300 p-2">
                <img src="{{ asset('storage/product/'. $product->imgname) }}" alt="Rendang Daging Sapi" class="rounded-[6px] w-full h-56 object-cover">
                    <div class="py-4">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $product->nama }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $product->deskripsi }}</p>
                        <p class="font-medium text-gray-800 mt-2 mb-3">{{ $product->harga }}</p>
                        <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:-translate-y-1 hover:bg-orange-50 transition duration-300">Add to Cart</a>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </div>
</x-layout>