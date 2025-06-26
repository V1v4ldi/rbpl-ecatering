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
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 mx-4">
            <h1 class="text-2xl font-semibold text-center mb-8">Produk Kami</h1>
            <x-product :products="$products" />
        </div>
        
    </section>

    <!-- CTA Section -->
    <section class="text-center py-20 px-5 bg-gray-50 mt-16">
        <h2 class="text-4xl font-semibold text-[#ff9a00] mb-5">Nikmati Hidangan Premium, Tanpa Repot!</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto">Rasakan Layanan Catering Terbaik Kami. Kontak Kami Hari Ini dan Tingkatkan Pengalaman Makan Anda!</p>
        <a href="{{ route('order') }}" class="inline-block px-7 py-3 bg-[#ff9a00] text-white font-semibold rounded-lg transition-all duration-300 hover:opacity-90 hover:-translate-y-0.5">Pesan</a>
    </section>
    @section('script')
    @include('script.cart-item-get')
    @include('script.product-script')
    @stop
</x-layout>