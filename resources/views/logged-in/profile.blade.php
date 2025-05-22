<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="max-w-7xl mx-auto px-4 py-8" x-data="{ tab:'IP' }" x-cloak>
        <h1 class="text-2xl font-semibold mb-8">Profil Saya</h1>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar Navigation -->
            <div class="w-full md:w-64 bg-white rounded-lg shadow-sm">

              {{-- Info Pribadi --}}

                <button @click="tab = 'IP'" 
                type="button" :class="tab == 'IP' ? 'border-[#ff9a00]' : 'border-transparent'"
                class="border-l-4 bg-primary-light py-4 px-5 flex items-center cursor-pointer tab-item active">
                    <div :class="tab == 'IP' ? 'bg-[#ff9a00]' : 'bg-gray-400'"
                    class="w-5 h-5 rounded-full mr-3"></div>
                    <span>Informasi Pribadi</span>
                </button>

                {{-- Riwayat Pesanan --}}

                <button @click="tab = 'RP'" 
                type="button" :class="tab == 'RP' ? 'border-[#ff9a00]' : 'border-transparent'"
                class="border-l-4 hover:bg-gray-50 py-4 px-5 flex items-center cursor-pointer tab-item">
                    <div :class="tab == 'RP' ? 'bg-[#ff9a00]' : 'bg-gray-400'"
                    class="w-5 h-5 rounded-full mr-3"></div>
                    <span>Riwayat Pesanan</span>
                </button>

                {{-- Ubah sandi --}}

                <button @click="tab = 'US'"
                type="button" :class="tab == 'US' ? 'border-[#ff9a00]' : 'border-transparent'"
                class="border-l-4 hover:bg-gray-50 py-4 px-5 flex items-center cursor-pointer tab-item">
                    <div :class="tab == 'US' ? 'bg-[#ff9a00]' : 'bg-gray-400'"
                    class="w-5 h-5 rounded-full mr-3"></div>
                    <span>Ubah Sandi</span>
                </button>



            </div>

            <!-- Tab Content -->
            <div class="flex-1 bg-white rounded-lg shadow-sm p-6">
                <!-- Informasi Pribadi Tab -->
                <div x-show="tab === 'IP'">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-gray-200">Informasi Pribadi</h2>
                    <form>
                        <div class="mb-5">
                            <label for="nama" class="block mb-2 font-medium">Nama Lengkap</label>
                            <input type="text" id="nama" placeholder="Budi Santoso" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base">
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 font-medium">Email</label>
                            <input type="email" id="email" placeholder="budi.santoso@email.com" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base">
                        </div>
                        <div class="mb-5">
                            <label for="phone" class="block mb-2 font-medium">Nomor Telepon</label>
                            <input type="tel" id="phone" placeholder="081234567890" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base">
                        </div>
                        <div class="text-right mt-6">
                            <button type="button" class="bg-primary hover:bg-primary/90 text-white font-medium py-3 px-5 rounded-md transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Riwayat Pesanan Tab -->
                <div x-show="tab === 'RP'">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-gray-200">Riwayat Pesanan</h2>
                    
                    <!-- Order 1 -->
                    <div class="border border-gray-200 rounded-lg p-4 mb-5 bg-gray-50">
                        <div class="flex justify-between items-center pb-3 mb-3 border-b border-gray-200">
                            <div class="font-semibold text-base">Pesanan #1082</div>
                            <div class="bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-medium">Selesai</div>
                        </div>
                        <div class="text-gray-600 mb-3">15 April 2025</div>
                        <div class="flex justify-between mb-1.5">
                            <span>Rendang Daging Sapi (2 porsi)</span>
                            <span>Rp 120.000</span>
                        </div>
                        <div class="flex justify-between mb-1.5">
                            <span>Ayam Bakar (3 porsi)</span>
                            <span>Rp 135.000</span>
                        </div>
                        <div class="flex justify-between mb-1.5">
                            <span>Capcay (1 porsi)</span>
                            <span>Rp 35.000</span>
                        </div>
                        <div class="flex justify-between pt-3 mt-3 border-t border-gray-200 font-semibold">
                            <span>Total:</span>
                            <span>Rp 290.000</span>
                        </div>
                        <div class="text-right mt-3">
                            <button class="border border-primary text-primary hover:bg-primary-light px-4 py-2 rounded-md text-sm transition">
                                Pesan Lagi
                            </button>
                        </div>
                    </div>
                    
                    <!-- Order 2 -->
                    <div class="border border-gray-200 rounded-lg p-4 mb-5 bg-gray-50">
                        <div class="flex justify-between items-center pb-3 mb-3 border-b border-gray-200">
                            <div class="font-semibold text-base">Pesanan #1056</div>
                            <div class="bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm font-medium">Dalam Proses</div>
                        </div>
                        <div class="text-gray-600 mb-3">10 April 2025</div>
                        <div class="flex justify-between mb-1.5">
                            <span>Ayam Kereng (5 porsi)</span>
                            <span>Rp 175.000</span>
                        </div>
                        <div class="flex justify-between mb-1.5">
                            <span>Mie Kuning Goreng (2 porsi)</span>
                            <span>Rp 60.000</span>
                        </div>
                        <div class="flex justify-between pt-3 mt-3 border-t border-gray-200 font-semibold">
                            <span>Total:</span>
                            <span>Rp 235.000</span>
                        </div>
                        <div class="text-right mt-3">
                            <button class="border border-primary text-primary hover:bg-primary-light px-4 py-2 rounded-md text-sm transition">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                    
                    <!-- Order 3 -->
                    <div class="border border-gray-200 rounded-lg p-4 mb-5 bg-gray-50">
                        <div class="flex justify-between items-center pb-3 mb-3 border-b border-gray-200">
                            <div class="font-semibold text-base">Pesanan #1023</div>
                            <div class="bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-medium">Selesai</div>
                        </div>
                        <div class="text-gray-600 mb-3">25 Maret 2025</div>
                        <div class="flex justify-between mb-1.5">
                            <span>Ayam Bakar (4 porsi)</span>
                            <span>Rp 180.000</span>
                        </div>
                        <div class="flex justify-between mb-1.5">
                            <span>Acar (2 porsi)</span>
                            <span>Rp 30.000</span>
                        </div>
                        <div class="flex justify-between pt-3 mt-3 border-t border-gray-200 font-semibold">
                            <span>Total:</span>
                            <span>Rp 210.000</span>
                        </div>
                        <div class="text-right mt-3">
                            <button class="border border-primary text-primary hover:bg-primary-light px-4 py-2 rounded-md text-sm transition">
                                Pesan Lagi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Ubah Sandi Tab -->
                <div x-show="tab === 'US'">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-gray-200">Keamanan Akun</h2>
                    <form>
                        <div class="mb-5">
                            <label for="current-password" class="block mb-2 font-medium">Password Saat Ini</label>
                            <input type="password" id="current-password" placeholder="••••••••" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base">
                        </div>
                        <div class="mb-5">
                            <label for="new-password" class="block mb-2 font-medium">Password Baru</label>
                            <input type="password" id="new-password" placeholder="•••••••••" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base">
                            <div class="text-gray-500 text-sm mt-1.5">
                                Password harus terdiri dari minimal 8 karakter dan mengandung angka, huruf besar dan kecil
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="confirm-password" class="block mb-2 font-medium">Konfirmasi Password Baru</label>
                            <input type="password" id="confirm-password" placeholder="•••••••••" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base">
                        </div>
                        <div class="flex justify-between mt-6">
                            <button type="button" class="bg-primary hover:bg-primary/90 text-white font-medium py-3 px-5 rounded-md transition">
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>