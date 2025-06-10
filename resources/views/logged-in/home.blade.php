<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="text-center py-4 lg:py-16 px-5 max-w-screen-xl mx-auto">
        <h1 class="text-5xl font-bold mb-4">Catering Penuh<br>Kelezatan</h1>
        <p class="text-xl text-gray-600 mb-8">Eksplor Menu Kami yang Penuh Kelezatan</p>
        <a href="{{ route('order') }}" class="inline-block px-7 py-3 bg-[#ff9a00] text-white font-semibold rounded-lg transition-all duration-300 hover:opacity-90 hover:-translate-y-0.5">Pesan Sekarang!</a>
        <div class="w-full max-w-screen-lg mx-auto mt-8 overflow-hidden shadow-lg">
            <img src="{{ Vite::asset('resources/images/Alogin.jpeg') }}" alt="Meja makan dengan makanan dan dekorasi" class="w-full h-auto object-cover">
        </div>
    </section>

    <!-- Product Section -->
    <section class="py-16 px-5 max-w-screen-xl mx-auto">
        <h2 class="text-3xl font-semibold text-center mb-10">Pilihan Produk Kami</h2>
        
        <!-- First row of products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                @foreach($products as $product)
            <!-- Product 1 -->
            <div class="p-4 rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="{{ asset('storage/product/'. $product->imgname) }}" alt="Rendang Daging Sapi" class="w-full h-full object-cover rounded-[6px]">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">{{ $product->nama }}</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $product->deskripsi }}</p>
                    <p class="font-semibold text-[#ff9a00] mb-4">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <button class="w-full py-2 border rounded-[6px] border-[#ff9a00] text-[#ff9a00] font-semibold transition-all duration-300 hover:bg-[#ff9a00] hover:text-white cursor-pointer add-to-cart" data-productid = {{ $product->product_id }}>Add to Cart</button>
                </div>
            </div>
                @endforeach
        </div>
        
    </section>

    <!-- CTA Section -->
    <section class="text-center py-20 px-5 bg-gray-50 mt-16">
        <h2 class="text-4xl font-semibold text-[#ff9a00] mb-5">Nikmati Hidangan Premium, Tanpa Repot!</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto">Rasakan Layanan Catering Terbaik Kami. Kontak Kami Hari Ini dan Tingkatkan Pengalaman Makan Anda!</p>
        <a href="{{ route('order') }}" class="inline-block px-7 py-3 bg-[#ff9a00] text-white font-semibold rounded-lg transition-all duration-300 hover:opacity-90 hover:-translate-y-0.5">Pesan</a>
    </section>
</x-layout>