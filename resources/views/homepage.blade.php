<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="text-center px-5 py-16 max-w-6xl mx-auto">
        <h1 class="text-5xl font-bold mb-5 md:text-5xl text-3xl">Solusi Catering Lezat,<br>Cepat & Praktis!</h1>
        <p class="text-xl text-gray-600 mb-10">Eksplor Menu dan Layanan Unggulan Kami</p>
        <div class="flex gap-5 justify-center mb-12 md:flex-row flex-col items-center">
            <a href="/login" class="px-6 py-2 rounded-md font-semibold bg-[#FFA900] text-white border border-[#FFA900] hover:opacity-90 hover:-translate-y-0.5 transition-all duration-300">Pesan Sekarang!</a>
            <a href="/register" class="px-6 py-2 rounded-md font-semibold border border-[#FFA900] text-[#FFA900] hover:opacity-90 hover:-translate-y-0.5 transition-all duration-300">Buat Akun</a>
        </div>
        <div class="w-full max-w-5xl mx-auto relative">
            <img src="{{ Vite::asset('resources/images/homepage.png') }}" alt="Berbagai menu catering lezat" class="w-full h-auto object-cover rounded-lg">
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="text-center px-5 py-5 max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold mb-16">Kenapa Pilih Kami?</h2>
        <div class="flex justify-between gap-8 md:flex-row flex-col">
            <div class="flex-1 text-center p-5">
                <h3 class="text-[#FFA900] text-xl font-medium mb-4">Cepat & Praktis</h3>
                <p class="text-gray-600">Pesan makanan dalam hitungan menit dan langsung dikirim ke lokasi kamu.</p>
            </div>
            <div class="flex-1 text-center p-5">
                <h3 class="text-[#FFA900] text-xl font-medium mb-4">Menu Variatif</h3>
                <p class="text-gray-600">Pilih dari berbagai pilihan menu, dari tradisional sampai sehat kekinian.</p>
            </div>
            <div class="flex-1 text-center p-5">
                <h3 class="text-[#FFA900] text-xl font-medium mb-4">Harga Terjangkau</h3>
                <p class="text-gray-600">Kualitas bintang lima dengan harga yang tetap bersahabat di kantong.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="text-center px-5 py-20 bg-gray-50">
        <h2 class="text-4xl font-bold mb-5 text-[#FFA900]">Gabung bersama Kami!</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto">Layanan Catering Terbaik yang Sesuai dengan Kebutuhan Anda, Mulai Sekarang dengan Daftar atau Masuk!</p>
        <a href="#" class="px-6 py-2 rounded-md font-semibold bg-[#FFA900] text-white border border-[#FFA900] hover:opacity-90 hover:-translate-y-0.5 transition-all duration-300">Daftar sekarang!</a>
    </section>
</x-layout>