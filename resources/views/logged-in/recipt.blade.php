<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
     <div class="max-w-4xl mx-auto my-5 bg-white rounded-lg shadow p-8">
            <!-- Progress Bar -->
            <div class="relative flex justify-between mb-10">
            <!-- Background Line -->
            <div class="absolute top-3.5 left-0 right-0 h-0.5 bg-gray-200"></div>
            <!-- Completed Line -->
            <div class="absolute top-3.5 left-0 h-0.5 bg-[#ff9a00] w-2/3"></div>
            
            <!-- Steps -->
            <div class="w-7 h-7 rounded-full bg-[#ff9a00] border-2 border-[#ff9a00] flex items-center justify-center font-bold text-white z-10">1</div>
            <div class="w-7 h-7 rounded-full bg-[#ff9a00] border-2 border-[#ff9a00] flex items-center justify-center font-bold text-white z-10">2</div>
            <div class="w-7 h-7 rounded-full bg-[#ff9a00] border-2 border-[#ff9a00] flex items-center justify-center font-bold text-white z-10">3</div>
            <div class="w-7 h-7 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500 z-10">4</div>
        </div>

        <!-- Order Information -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <div class="grid grid-cols-2 gap-5">
                <div class="border border-gray-200 rounded-lg p-5 shadow-sm bg-white">
                    <h2 class="text-lg font-bold mb-5 text-gray-800">Informasi Pesanan</h2>
                    <div class="grid grid-cols-3 gap-4 text-sm">
                        <div class="text-gray-500">No. Pesanan:</div>
                        <div class="col-span-2 font-bold text-gray-800">ORD-12345678</div>
                        
                        <div class="text-gray-500">Tanggal Pesanan:</div>
                        <div class="col-span-2 font-bold text-gray-800">18 April 2025</div>
                        
                        <div class="text-gray-500">Status Pesanan:</div>
                        <div class="col-span-2">
                            <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-xs">Sedang Diproses</span>
                        </div>
                        
                        <div class="text-gray-500">Status Pembayaran:</div>
                        <div class="col-span-2">
                            <span class="bg-[#ff9a00] text-white px-4 py-1 rounded-full text-xs">Lunas</span>
                        </div>
                        
                        <div class="text-gray-500">Metode Pembayaran:</div>
                        <div class="col-span-2 font-bold text-gray-800">Transfer Bank BCA</div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-5 shadow-sm bg-white">
                    <h2 class="text-lg font-bold mb-5 text-gray-800">Rincian Pesanan</h2>
                    <div class="text-sm">
                        <div class="flex justify-between mb-2">
                            <div>Rendang Daging Sapi</div>
                            <div>15 x Rp 20.000</div>
                        </div>
                        <div class="flex justify-between mb-2">
                            <div>Mie Kuning Goreng</div>
                            <div>20 x Rp 5.000</div>
                        </div>
                        
                        <div class="flex justify-between mt-4 mb-2 text-gray-500">
                            <div>Subtotal:</div>
                            <div>Rp 400.000</div>
                        </div>
                        <div class="flex justify-between mb-2 text-gray-500">
                            <div>Diskon:</div>
                            <div>- Rp 50.000</div>
                        </div>
                        <div class="flex justify-between pt-2 border-t border-gray-200 font-bold text-[#ff9a00]">
                            <div>Total:</div>
                            <div>Rp 350.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delivery Information -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h2 class="text-lg font-bold mb-5 text-gray-800">Detail Pengiriman</h2>
            <div class="border border-gray-200 rounded-lg p-5 shadow-sm bg-white">
                <div class="grid grid-cols-3 gap-4 text-sm">
                    <div class="text-gray-500">Tanggal Pengiriman:</div>
                    <div class="col-span-2 font-bold text-gray-800">20 April 2025</div>
                    
                    <div class="text-gray-500">Waktu:</div>
                    <div class="col-span-2 font-bold text-gray-800">12:00 WIB</div>
                    
                    <div class="text-gray-500">Alamat:</div>
                    <div class="col-span-2 font-bold text-gray-800">Jl. Kebon Jeruk Raya No. 123, Jakarta Barat</div>
                    
                    <div class="text-gray-500">Catatan:</div>
                    <div class="col-span-2 font-bold text-gray-800">Mohon diantarkan tepat waktu</div>
                </div>
            </div>
        </div>
        
        <!-- Delivery Status -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h2 class="text-lg font-bold mb-5 text-gray-800">Status Pengiriman</h2>
            
            <div class="border border-gray-200 rounded-lg p-5 shadow-sm bg-white">
                <div class="mt-2">
                    <div class="flex mb-4 relative">
                        <div class="w-5 h-5 rounded-full bg-green-500 mr-4 flex-shrink-0"></div>
                        <div>
                            <div class="font-bold mb-1 text-sm">Pesanan diterima</div>
                            <div class="text-gray-500 text-xs">18 April 2025, 10:15 WIB</div>
                        </div>
                        <div class="absolute left-2.5 top-6 bottom-0 w-0.5 h-8 bg-gray-300"></div>
                    </div>
                    
                    <div class="flex mb-4 relative">
                        <div class="w-5 h-5 rounded-full bg-green-500 mr-4 flex-shrink-0"></div>
                        <div>
                            <div class="font-bold mb-1 text-sm">Pembayaran dikonfirmasi</div>
                            <div class="text-gray-500 text-xs">18 April 2025, 14:30 WIB</div>
                        </div>
                        <div class="absolute left-2.5 top-6 bottom-0 w-0.5 h-8 bg-gray-300"></div>
                    </div>
                    
                    <div class="flex mb-4 relative">
                        <div class="w-5 h-5 rounded-full bg-blue-500 mr-4 flex-shrink-0"></div>
                        <div>
                            <div class="font-bold mb-1 text-sm">Pesanan sedang diproses</div>
                            <div class="text-gray-500 text-xs">19 April 2025, 08:00 WIB</div>
                        </div>
                        <div class="absolute left-2.5 top-6 bottom-0 w-0.5 h-8 bg-gray-300"></div>
                    </div>
                    
                    <div class="flex">
                        <div class="w-5 h-5 rounded-full bg-gray-300 mr-4 flex-shrink-0"></div>
                        <div>
                            <div class="font-bold mb-1 text-sm">Pesanan dikirim</div>
                            <div class="text-gray-500 text-xs">Menunggu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <button class="w-full bg-[#ff9a00] text-white py-3 rounded font-bold cursor-pointer text-sm mb-3">
            Hubungi Penjual
        </button>
        <button class="w-full bg-gray-500 text-white py-3 rounded font-bold cursor-pointer text-sm">
            Batalkan Pesanan
        </button>
    </div>
</x-layout>