<x-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl mb-6 text-gray-800">Pesanan Saya</h1>
        
        <div class="flex border-b border-gray-200 mb-6">
            <div class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 border-b-2 border-blue-500 text-blue-500" data-tab="belum-bayar">
                <span>🛒</span> Belum Bayar
            </div>
            <div class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 border-b-2 border-transparent" data-tab="diproses">
                <span>📦</span> Diproses
            </div>
            <div class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 border-b-2 border-transparent" data-tab="selesai">
                <span>✓</span> Selesai
            </div>
        </div>
        
        <div id="belum-bayar" class="block">
            <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Paket Nasi Kotak + Air Mineral</div>
                <div class="text-gray-600 text-sm mb-1">19 April 2025</div>
                <div class="text-gray-600 text-sm">Total: Rp 350.000</div>
                <div class="flex justify-end -mt-10">
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 border border-gray-200 bg-white text-gray-600">Belum Dibayar</button>
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 bg-orange-500 text-white border border-orange-500">Bayar Sekarang</button>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Paket Nasi Ayam Geprek</div>
                <div class="text-gray-600 text-sm mb-1">18 April 2025</div>
                <div class="text-gray-600 text-sm">Total: Rp 200.000</div>
                <div class="flex justify-end -mt-10">
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 border border-gray-200 bg-white text-gray-600">Belum Dibayar</button>
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 bg-orange-500 text-white border border-orange-500">Bayar Sekarang</button>
                </div>
            </div>
        </div>
        
        <div id="diproses" class="hidden">
            <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Paket Prasmanan (50 Porsi)</div>
                <div class="text-gray-600 text-sm mb-1">12 April 2025</div>
                <div class="text-gray-600 text-sm">Total: Rp 1.250.000</div>
                <div class="flex justify-end -mt-10">
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 border border-gray-200 bg-white text-gray-600">Diproses</button>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Paket Prasmanan (25 Porsi)</div>
                <div class="text-gray-600 text-sm mb-1">12 April 2025</div>
                <div class="text-gray-600 text-sm">Total: Rp 625.000</div>
                <div class="flex justify-end -mt-10">
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 border border-gray-200 bg-white text-gray-600">Diproses</button>
                </div>
            </div>
        </div>
        
        <div id="selesai" class="hidden">
            <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Paket Snack Rapat</div>
                <div class="text-gray-600 text-sm mb-1">15 April 2025</div>
                <div class="text-gray-600 text-sm">Total: Rp 150.000</div>
                <div class="flex justify-end -mt-10">
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 border border-green-500 bg-white text-green-500">Selesai</button>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Paket Snack Rapat</div>
                <div class="text-gray-600 text-sm mb-1">15 April 2025</div>
                <div class="text-gray-600 text-sm">Total: Rp 150.000</div>
                <div class="flex justify-end -mt-10">
                    <button class="py-2 px-4 rounded text-sm cursor-pointer ml-2 border border-green-500 bg-white text-green-500">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Tab switching functionality
        const tabs = document.querySelectorAll('[data-tab]');
        const tabContents = document.querySelectorAll('#belum-bayar, #diproses, #selesai');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Remove active class from all tabs and contents
                tabs.forEach(t => {
                    t.classList.remove('text-blue-500');
                    t.classList.remove('border-blue-500');
                    t.classList.add('border-transparent');
                });
                
                tabContents.forEach(c => c.classList.add('hidden'));
                tabContents.forEach(c => c.classList.remove('block'));
                
                // Add active class to current tab and content
                tab.classList.add('text-blue-500');
                tab.classList.add('border-blue-500');
                tab.classList.remove('border-transparent');
                document.getElementById(tabId).classList.add('block');
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
    </script>
</x-layout>