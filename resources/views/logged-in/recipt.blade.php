<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Wrapper utama dengan inisialisasi Alpine.js --}}
    <div class="max-w-4xl mx-auto px-4 py-8" x-data='orderStatus(@json($orderData, JSON_INVALID_UTF8_SUBSTITUTE))'>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Progress Header -->
            <div class="bg-gradient-to-r from-[#ff6b35] to-orange-400 px-6 py-4">
                <h2 class="text-white text-lg font-semibold">Detail Status Pesanan #<span x-text="order.id"></span></h2>
            </div>

            <div class="p-6">
                <!-- Progress Steps (DINAMIS) -->
                <div class="mb-8">
                    <div class="flex items-center justify-between relative">
                        <!-- Step 1: Selalu Aktif -->
                        <div class="flex flex-col items-center z-10 w-20 pb-3"> {{-- <-- TAMBAHKAN w-20 --}}
                            <div class="w-10 h-10 bg-[#ff6b35] rounded-full flex items-center justify-center text-white font-bold shadow-lg">1</div>
                            <span class="text-xs mt-3 text-gray-600 text-center">Checkout</span>
                        </div>
                        
                        <!-- Step 2: Aktif jika statusLevel >= 1 -->
                        <div class="flex flex-col items-center z-10 w-20"> {{-- <-- TAMBAHKAN w-20 --}}
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg" :class="statusLevel() >= 3 ? 'bg-[#ff6b35] text-white' : 'bg-gray-300 text-gray-500'">2</div>
                            <span class="text-xs mt-2 text-center" :class="statusLevel() >= 3 ? 'text-gray-600' : 'text-gray-400'">Sudah<br>Diverifikasi</span>
                        </div>
                        
                        <!-- Step 3: Aktif jika statusLevel >= 2 -->
                        <div class="flex flex-col items-center z-10 w-20"> {{-- <-- TAMBAHKAN w-20 --}}
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg" :class="statusLevel() >= 4 ? 'bg-[#ff6b35] text-white' : 'bg-gray-300 text-gray-500'">3</div>
                            <span class="text-xs mt-2 text-center" :class="statusLevel() >= 4 ? 'text-gray-600' : 'text-gray-400'">Sedang<br>Dibuat</span>
                        </div>
                        
                        <!-- Step 4: Aktif jika statusLevel >= 5 -->
                        <div class="flex flex-col items-center z-10 w-20 pb-3"> {{-- <-- TAMBAHKAN w-20 --}}
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold" :class="statusLevel() >= 6 ? 'bg-[#ff6b35] text-white' : 'bg-gray-300 text-gray-500'">4</div>
                            <span class="text-xs mt-3 text-center" :class="statusLevel() >= 6 ? 'text-gray-600' : 'text-gray-400'">Selesai</span>
                        </div>
                        
                        <!-- Progress Line (DINAMIS) -->
                        <div class="absolute top-5 left-5 right-5 h-0.5 bg-gray-200">
                            <div class="h-full bg-[#ff6b35] transition-all duration-500" :class="progressWidth()"></div>
                        </div>
                    </div>
                </div>

                {{-- Sisa konten bisa Anda buat dinamis dengan cara yang sama menggunakan x-text --}}
                <div class="text-center p-4">
                    <h3 class="font-bold text-xl">Status Saat Ini: <span x-text="order.status" class="text-[#ff6b35]"></span></h3>
                </div>

                {{-- INI BAGIAN YANG DIPERBARUI: Layout 2 Kolom --}}
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-800 mb-4">Informasi Pesanan</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between"><span class="text-gray-600">No. Pesanan:</span><span class="font-medium" x-text="order.id"></span></div>
                                <div class="flex justify-between"><span class="text-gray-600">Tanggal Pesanan:</span><span class="font-medium" x-text="order.orderDate"></span></div>
                                <div class="flex justify-between"><span class="text-gray-600">Status Pesanan:</span><span class="px-2 py-1 rounded-full text-xs font-medium" :class="statusBadgeClass()" x-text="order.status"></span></div>
                                <div class="flex justify-between"><span class="text-gray-600">Metode Pembayaran:</span><span class="font-medium text-blue-600" x-text="order.paymentMethod"></span></div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-800 mb-4">Detail Pengiriman</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between"><span class="text-gray-600">Tanggal Pengiriman:</span><span class="font-medium" x-text="order.deliveryDate"></span></div>
                                <div class="flex justify-between"><span class="text-gray-600">Waktu:</span><span class="font-medium" x-text="order.deliveryTime"></span></div>
                                {{-- TAMBAHKAN ml-4 DI SINI --}}
                                <div class="flex justify-between items-start"><span class="text-gray-600">Alamat:</span><span class="font-medium text-right ml-4" x-text="order.deliveryAddress"></span></div>
                                {{-- TAMBAHKAN ml-4 DI SINI JUGA --}}
                                <div class="flex justify-between items-start"><span class="text-gray-600">Catatan:</span><span class="font-medium text-right ml-4" x-text="order.notes || '-'"></span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-800 mb-4">Rincian Pesanan</h3>
                            <div class="space-y-3">
                                {{-- Loop untuk setiap item pesanan --}}
                                <template x-for="item in order.items" :key="item.id">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <div>
                                            <span class="font-medium" x-text="item.name"></span>
                                            <div class="text-sm text-gray-600" x-text="`${item.quantity} x ${formatCurrency(item.price)}`"></div>
                                        </div>
                                        <span class="font-medium mb-2" x-text="formatCurrency(item.quantity * item.price)"></span>
                                    </div>
                                </template>
                                {{-- Total Harga --}}
                                <div class="flex justify-between py-3 border-t-2 border-gray-300">
                                    <span class="font-semibold text-lg">Total:</span>
                                    <span class="font-bold text-lg text-[#ff6b35]" x-text="formatCurrency(totalPrice())"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('checkout') }}" class="block text-center cursor-pointer flex-1 bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-xl hover:bg-gray-300 transition-colors">
                        Kembali ke Daftar Pesanan
                    </a>
                    <button @click="contactPenjual()" class="cursor-pointer flex-1 bg-[#ff6b35] hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-xl">
                        Hubungi Penjual
                    </button>
                    <template x-if="statusLevel() < 3">
                        <button @click="cancelOrder()" class="cursor-pointer flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl">
                            Batalkan Pesanan
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        function orderStatus(initialOrderData) {
            return {
                 order: initialOrderData,
                
                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                },
                totalPrice() {
                    return this.order.items.reduce((total, item) => total + (item.quantity * item.price), 0);
                },
                statusLevel() {
                    const statuses = ['Dibatalkan', 'Belum Dibayar', 'Sedang Diverifikasi', 'Sudah Diverifikasi', 'Sedang Dibuat', 'Dalam Pengiriman', 'Selesai'];
                    return statuses.indexOf(this.order.status);
                },
                progressWidth() {
                    const level = this.statusLevel();
                    if (level >= 6) return 'w-full';
                    if (level >= 4) return 'w-2/3';
                    if (level >= 3) return 'w-1/3';
                    return 'w-0';
                },

                statusBadgeClass() {
                    switch (this.order.status) {
                        case 'Selesai':
                            return 'bg-green-100 text-green-800';
                        case 'Dalam Pengiriman':
                            return 'bg-purple-100 text-purple-800';
                        case 'Sedang Dibuat':
                            return 'bg-orange-100 text-orange-800';
                        case 'Sudah Diverifikasi':
                            return 'bg-cyan-100 text-cyan-800';
                        case 'Sedang Diverifikasi':
                            return 'bg-blue-100 text-blue-800';
                        case 'Belum Dibayar':
                            return 'bg-amber-100 text-amber-800';
                        case 'Dibatalkan':
                            return 'bg-red-100 text-red-800';
                        default:
                            return 'bg-gray-100 text-gray-800';
                    }
                },

                // --- 2. UBAH FUNGSI TOMBOL ---
                contactPenjual() {
                    window.open('https://wa.me/6281234567890', '_blank');
                },
                
                cancelOrder() {
                    // Ganti confirm() dengan Swal.fire() yang memiliki konfirmasi
                    Swal.fire({
                        title: 'Anda Yakin?',
                        text: "Pesanan " + this.order.id + " akan dibatalkan. Aksi ini tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, batalkan!',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Tampilkan loading spinner
                            Swal.fire({
                                title: 'Membatalkan...',
                                text: 'Mohon tunggu sebentar.',
                                allowOutsideClick: false,
                                didOpen: () => { Swal.showLoading() }
                            });

                            // Simpan konteks 'this' dari Alpine
                            let component = this;

                            let urlTemplate = '{{ route("order.cancel", ["order_id" => "PLACEHOLDER"]) }}';
                            let finalUrl = urlTemplate.replace('PLACEHOLDER', component.order.id);

                            $.ajax({
                                url: finalUrl, // <-- GUNAKAN URL DINAMIS
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    // order_id tidak perlu lagi di sini
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire('Dibatalkan!', data.message, 'success');
                                        component.order.status = 'Dibatalkan';
                                    } else {
                                        Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error');
                                }
                            });
                        }
                    })
                },
            }
        }
    </script>
  </x-layout>