<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="text-center py-16 px-5 max-w-screen-xl mx-auto">
        <h1 class="text-5xl font-bold mb-4">Catering Penuh<br>Kelezatan</h1>
        <p class="text-xl text-gray-600 mb-8">Eksplor Menu Kami yang Penuh Kelezatan</p>
        <a href="#" class="inline-block px-7 py-3 bg-orange-500 text-white font-semibold rounded-lg transition-all duration-300 hover:opacity-90 hover:-translate-y-0.5">Pesan Sekarang!</a>
        <div class="w-full max-w-screen-lg mx-auto mt-8 rounded-lg overflow-hidden shadow-lg">
            <img src="/api/placeholder/800/450" alt="Meja makan dengan makanan dan dekorasi" class="w-full h-auto object-cover">
        </div>
    </section>

    <!-- Product Section -->
    <section class="py-16 px-5 max-w-screen-xl mx-auto">
        <h2 class="text-3xl font-semibold text-center mb-10">Pilihan Produk Kami</h2>
        
        <!-- First row of products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Product 1 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Rendang Daging Sapi" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Rendang Daging Sapi</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Rendang daging sapi khas Indonesia, kaya rempah dan lezat</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 20.000</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Ayam Bakar" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Ayam Bakar</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Ayam bakar dengan bumbu khas, nikmat dan menggugah selera</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 18.000</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Ayam Kecap" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Ayam Kecap</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Ayam dengan saus kecap manis yang gurih dan favorit</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 17.000</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Ayam Balado" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Ayam Balado</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Ayam balado pedas dengan cita rasa khas nusantara</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 19.000</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
        </div>
        
        <!-- Second row of products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 5 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Capcay" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Capcay</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Sayuran segar dimasak dengan kuah gurih yang ringan</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 8.000</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
            
            <!-- Product 6 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Acar" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Acar</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Acar sayuran segar dengan rasa manis dan asam</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 4.500</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
            
            <!-- Product 7 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Sambal Goreng Kentang" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Sambal Goreng Kentang</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Kentang goreng pedas dengan sambal khas Indonesia</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 7.500</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
            
            <!-- Product 8 -->
            <div class="rounded-lg overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 w-full overflow-hidden">
                    <img src="/api/placeholder/300/180" alt="Mie Kuning Goreng" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-base mb-1">Mie Kuning Goreng</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">Mie kuning kenyal, cocok untuk berbagai hidangan</p>
                    <p class="font-semibold text-orange-500 mb-4">Rp 5.000</p>
                    <button class="w-full py-2 border border-orange-500 text-orange-500 font-semibold rounded transition-all duration-300 hover:bg-orange-500 hover:text-white">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="text-center py-20 px-5 bg-gray-50 mt-16">
        <h2 class="text-4xl font-semibold text-orange-500 mb-5">Nikmati Hidangan Premium, Tanpa Repot!</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto">Rasakan Layanan Catering Terbaik Kami. Kontak Kami Hari Ini dan Tingkatkan Pengalaman Makan Anda!</p>
        <a href="#" class="inline-block px-7 py-3 bg-orange-500 text-white font-semibold rounded-lg transition-all duration-300 hover:opacity-90 hover:-translate-y-0.5">Pesan</a>
    </section>

    <script>
        // Cart functionality (for demo purposes)
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('button');
            
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productCard = this.closest('.p-4');
                    if (productCard) {
                        const productName = productCard.querySelector('h3').textContent;
                        alert(`${productName} telah ditambahkan ke keranjang!`);
                    }
                    // In a real app, you would update cart count and store items
                });
            });
            
            // Logout functionality
            const logoutButton = document.querySelector('header svg:last-of-type').parentNode;
            if (logoutButton) {
                logoutButton.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin keluar?')) {
                        alert('Anda telah keluar dari sistem.');
                        // In a real app, you would handle actual logout here
                    }
                });
            }
        });
    </script>
</x-layout>