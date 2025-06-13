<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @php
        $subtotal = 0;
        foreach($order_items as $item) {
            $subtotal += $order->jumlah * $item->harga_now;
        }
        $diskon = 0;
        $total = $subtotal - $diskon;
    @endphp
    <div class="container mx-auto max-w-5xl px-0 py-6">
        <div class="bg-white rounded-xl p-6 shadow-sm mb-8">
            <div class="flex justify-between relative max-w-2xl mx-auto">
                <!-- Progress line background -->
                <div class="absolute top-[15px] left-[15px] right-[15px] h-0.5 bg-gray-200 z-10"></div>
            <!-- Active progress line -->
            <div class="absolute top-[15px] left-[15px] h-0.5 bg-[#ff9a00] z-20 w-1/3"></div>
            
            <!-- Steps -->
            <div class="flex flex-col items-center relative z-30">
                <div class="w-[30px] h-[30px] rounded-full bg-[#ffa900] flex items-center justify-center text-white font-bold mb-1">1</div>
                <div class="text-xs mt-0.5">Checkout</div>
            </div>
            
            <div class="flex flex-col items-center relative z-30">
                <div class="w-[30px] h-[30px] rounded-full bg-[#ffa900] flex items-center justify-center text-white font-bold mb-1">2</div>
                <div class="text-xs mt-0.5">Pembayaran</div>
            </div>
            
            <div class="flex flex-col items-center relative z-30">
                <div class="w-[30px] h-[30px] rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold mb-1">3</div>
                <div class="text-xs mt-0.5">Dikirim</div>
            </div>
            
            <div class="flex flex-col items-center relative z-30">
                <div class="w-[30px] h-[30px] rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold mb-1">4</div>
                <div class="text-xs mt-0.5">Selesai</div>
            </div>
        </div>
    </div>
    

    <!-- Payment container -->
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Left column -->
        <div class="flex-1">
            <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
                <h2 class="text-xl font-semibold mb-6 pb-2 border-b-2 border-[#ff9a00] inline-block">Pembayaran</h2>
                
                <!-- Timer -->
                <div class="bg-amber-50 rounded-lg p-5 text-center mb-6">
                    <h3 class="text-sm font-medium mb-4 text-primary">Batas Waktu Pembayaran</h3>
                    <div class="flex justify-center gap-4">
                        <div class="flex flex-col items-center ">
                            <div class="w-12 h-12 bg-[#ff9a00] rounded-lg flex items-center justify-center text-white font-bold text-lg" id="hours">{{ str_pad(floor($remainingSeconds / 3600), 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-xs mt-1 text-gray-600">Jam</div>
                        </div>
                        <div class="flex flex-col items-center ">
                            <div class="w-12 h-12 bg-[#ff9a00] rounded-lg flex items-center justify-center text-white font-bold text-lg" id="minutes">{{ str_pad(floor(($remainingSeconds % 3600) / 60), 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-xs mt-1 text-gray-600">Menit</div>
                        </div>
                        <div class="flex flex-col items-center ">
                            <div class="w-12 h-12 bg-[#ff9a00] rounded-lg flex items-center justify-center text-white font-bold text-lg" id="seconds">{{ str_pad($remainingSeconds % 60, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-xs mt-1 text-gray-600">Detik</div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Methods -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-4">Pilih Metode Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="border border-[#ff9a00] bg-amber-50 rounded-lg p-4 text-center cursor-pointer transition-all" id="transfer-bank">
                            <div class="text-2xl mb-2">🏦</div>
                            <div>Transfer Bank</div>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 text-center cursor-pointer transition-all hover:border-primary" id="bayar-ditempat">
                            <div class="text-2xl mb-2">💵</div>
                            <div>Bayar di Tempat</div>
                        </div>
                    </div>
                </div>
                
                <!-- Bank Selection -->
                <div class="mb-6" id="bank-selection">
                    <h3 class="font-semibold mb-4">Pilih Bank</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="border border-[#ff9a00] bg-amber-50 rounded-lg p-3 flex items-center gap-2 cursor-pointer" onclick="selectBank(this, 'BCA')">
                            <input type="radio" name="bank" id="bca" checked>
                            <label for="bca">BCA</label>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-3 flex items-center gap-2 cursor-pointer hover:border-primary" onclick="selectBank(this, 'Mandiri')">
                            <input type="radio" name="bank" id="mandiri">
                            <label for="mandiri">Mandiri</label>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-3 flex items-center gap-2 cursor-pointer hover:border-primary" onclick="selectBank(this, 'BNI')">
                            <input type="radio" name="bank" id="bni">
                            <label for="bni">BNI</label>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-3 flex items-center gap-2 cursor-pointer hover:border-primary" onclick="selectBank(this, 'BRI')">
                            <input type="radio" name="bank" id="bri">
                            <label for="bri">BRI</label>
                        </div>
                    </div>
                    
                    <!-- Bank Details -->
                    <div class="bg-gray-50 border-l-3 border-[#ff9a00] p-4 mb-6">
                        <div class="flex justify-between mb-3">
                            <div class="font-medium">Bank:</div>
                            <div id="bank-name">BCA</div>
                        </div>
                        <div class="flex justify-between mb-3">
                            <div class="font-medium">No. Rekening:</div>
                            <div class="flex items-center">
                                8790123456
                                <button class="cursor-pointer bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300 " onclick="copyToClipboard('')">Salin</button>
                            </div>
                        </div>
                        <div class="flex justify-between mb-3">
                            <div class="font-medium">Atas Nama:</div>
                            <div>PT E-Catering Indonesia</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="font-medium">Jumlah:</div>
                            <div class="text-[#ff9a00] font-bold flex items-center">
                                Rp. {{ number_format($total, 0, ',', '.') }}
                                <button class="cursor-pointer bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300 " onclick="copyToClipboard('{{ $total }}')">Salin</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Upload Section -->
                <div class="mt-6">
                    <h3 class="font-semibold mb-1">Unggah Bukti Pembayaran</h3>
                    <p class="text-xs text-gray-600 mb-4">Silakan unggah bukti transfer Anda untuk verifikasi pembayaran</p>
                    
                    <div class="border-2 border-dashed border-gray-200 rounded-lg p-8 text-center cursor-pointer mb-4" onclick="document.getElementById('file-upload').click()">
                        <div class="text-gray-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Klik atau seret file bukti pembayaran di sini</p>
                        <button class="bg-[#ff9a00] text-white px-6 py-2 rounded font-medium cursor-pointer hover:bg-primary-dark">Pilih File</button>
                        <input type="file" id="file-upload" class="hidden">
                    </div>
                    
                    <p class="text-xs text-gray-500 text-center">Format yang diterima: JPG, PNG, PDF. Maksimal 5MB</p>
                </div>
                
                <button class="w-full bg-[#ff9a00] text-white py-4 rounded-lg font-semibold mt-6 hover:bg-primary-dark cursor-pointer transition-colors">Konfirmasi Pembayaran</button>
            </div>
        </div>
        
        <!-- Right column -->
        <div class="md:w-2/5">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-semibold mb-6 pb-2 border-b-2 border-[#ff9a00] inline-block">Ringkasan Pesanan</h2>
                
                <!-- Order Items -->
                <div class="mb-6">
                    @foreach ($order_items as $orders)
                    <div class="flex mb-4 pb-4 border-b border-gray-200">
                        <div class="flex-grow">
                            <div class="font-semibold mb-1">{{ $orders->product->nama }}</div>
                            <div class="text-sm text-gray-600">{{ $order->jumlah }} x Rp. {{ number_format($orders->harga_now, 0, ',', '.') }}</div>
                        </div>
                        <div class="font-semibold">Rp. {{ number_format($order->jumlah * $orders->harga_now, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mb-6">
                                        
                    <div class="flex justify-between mb-2">
                        <div>Subtotal</div>
                        <div>Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between mb-2">
                        <div>Diskon</div>
                        <div>- Rp {{ number_format($diskon, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between font-bold text-lg text-[#ff9a00] mt-4 pt-4 border-t border-gray-200">
                        <div>Total</div>
                        <div>Rp {{ number_format($total, 0, ',', '.') }}</div>
                    </div>
                </div>
                
                <!-- Delivery Details -->
                <div>
                    <h3 class="text-xl font-semibold mb-6 pb-2 border-b-2 border-[#ff9a00] inline-block">Detail Pengiriman</h3>
                    
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Tanggal:</div>
                        <div>{{ \Carbon\Carbon::parse($order->tanggal_kirim)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Waktu:</div>
                        <div>{{ \Carbon\Carbon::parse($order->waktu)->format('H:i') }}</div>
                    </div>
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Alamat:</div>
                        <div>{{ $order->alamat }}</div>
                    </div>
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Catatan:</div>
                        <div>{{ $order->catatan }}</div>
                    </div>
                </div>
                <button onclick="window.location.href='{{ route('checkout') }}'" class="cursor-pointer w-full bg-gray-200 text-gray-800 py-4 rounded-lg font-medium mt-6 hover:bg-gray-300 transition-colors">Kembali Ke Keranjang</button>
            </div> 
        </div> 
    </div> 
</div>

@section('script')
@include('script.payment-script')
@stop
</x-layout>