<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto max-w-5xl px-4 py-6">
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
                            <div class="w-12 h-12 bg-[#ff9a00] rounded-lg flex items-center justify-center text-white font-bold text-lg" id="hours">23</div>
                            <div class="text-xs mt-1 text-gray-600">Jam</div>
                        </div>
                        <div class="flex flex-col items-center ">
                            <div class="w-12 h-12 bg-[#ff9a00] rounded-lg flex items-center justify-center text-white font-bold text-lg" id="minutes">59</div>
                            <div class="text-xs mt-1 text-gray-600">Menit</div>
                        </div>
                        <div class="flex flex-col items-center ">
                            <div class="w-12 h-12 bg-[#ff9a00] rounded-lg flex items-center justify-center text-white font-bold text-lg" id="seconds">59</div>
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
                                <button class="bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300" onclick="copyToClipboard('8790123456')">Salin</button>
                            </div>
                        </div>
                        <div class="flex justify-between mb-3">
                            <div class="font-medium">Atas Nama:</div>
                            <div>PT E-Catering Indonesia</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="font-medium">Jumlah:</div>
                            <div class="text-[#ff9a00] font-bold flex items-center">
                                Rp 350.000
                                <button class="bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300" onclick="copyToClipboard('350000')">Salin</button>
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
                    <div class="flex mb-4 pb-4 border-b border-gray-200">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden mr-4">
                            <img src="/api/placeholder/64/64" alt="Rendang Daging Sapi" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold mb-1">Rendang Daging Sapi</div>
                            <div class="text-sm text-gray-600">15 x Rp 20.000</div>
                        </div>
                        <div class="font-semibold">Rp 300.000</div>
                    </div>
                    
                    <div class="flex mb-4 pb-4 border-b border-gray-200">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden mr-4">
                            <img src="/api/placeholder/64/64" alt="Mie Kuning Goreng" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold mb-1">Mie Kuning Goreng</div>
                            <div class="text-sm text-gray-600">20 x Rp 5.000</div>
                        </div>
                        <div class="font-semibold">Rp 100.000</div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <div>Subtotal</div>
                        <div>Rp 400.000</div>
                    </div>
                    <div class="flex justify-between mb-2">
                        <div>Diskon</div>
                        <div>- Rp 50.000</div>
                    </div>
                    <div class="flex justify-between font-bold text-lg text-[#ff9a00] mt-4 pt-4 border-t border-gray-200">
                        <div>Total</div>
                        <div>Rp 350.000</div>
                    </div>
                </div>
                
                <!-- Delivery Details -->
                <div>
                    <h3 class="text-xl font-semibold mb-6 pb-2 border-b-2 border-[#ff9a00] inline-block">Detail Pengiriman</h3>
                    
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Tanggal:</div>
                        <div>20 April 2025</div>
                    </div>
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Waktu:</div>
                        <div>12:00 WIB</div>
                    </div>
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Alamat:</div>
                        <div>Jl. Kebon Jeruk Raya No. 123, Jakarta Barat</div>
                    </div>
                    <div class="flex mb-3">
                        <div class="w-24 font-medium">Catatan:</div>
                        <div>Mohon diantarkan tepat waktu</div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-200 text-gray-800 py-4 rounded-lg font-medium mt-6 hover:bg-gray-300 cursor-pointer transition-colors">Kembali ke Pesanan</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Timer functionality
    function startTimer(duration) {
        let timer = duration;
        const hoursElem = document.getElementById('hours');
        const minutesElem = document.getElementById('minutes');
        const secondsElem = document.getElementById('seconds');
        
        function updateTimer() {
            const hours = Math.floor(timer / 3600);
            const minutes = Math.floor((timer % 3600) / 60);
            const seconds = timer % 60;
            
            hoursElem.textContent = hours < 10 ? "0" + hours : hours;
            minutesElem.textContent = minutes < 10 ? "0" + minutes : minutes;
            secondsElem.textContent = seconds < 10 ? "0" + seconds : seconds;
            
            if (--timer < 0) {
                timer = 0;
                clearInterval(interval);
                alert('Waktu pembayaran sudah habis!');
            }
        }
        
        updateTimer();
        const interval = setInterval(updateTimer, 1000);
        return interval;
    }
    
    // Start timer with 24 hours (86400 seconds)
    let timerInterval;
    window.onload = function() {
        // Setting timer to match the display - 23:59:59
        timerInterval = startTimer(23 * 3600 + 59 * 60 + 59);
    };
    
    // Payment Method Selection
    const transferBank = document.getElementById('transfer-bank');
    const bayarDiTempat = document.getElementById('bayar-ditempat');
    const bankSelection = document.getElementById('bank-selection');
    
    transferBank.addEventListener('click', function() {
        transferBank.classList.add('bg-amber-50', 'border-[#ff9a00]');
        transferBank.classList.remove('border-gray-200');
        bayarDiTempat.classList.remove('bg-amber-50', 'border-[#ff9a00]');
        bayarDiTempat.classList.add('border-gray-200');
        bankSelection.style.display = 'block';
    });
    
    bayarDiTempat.addEventListener('click', function() {
        bayarDiTempat.classList.add('bg-amber-50', 'border-[#ff9a00]');
        bayarDiTempat.classList.remove('border-gray-200');
        transferBank.classList.remove('bg-amber-50', 'border-[#ff9a00]');
        transferBank.classList.add('border-gray-200');
        bankSelection.style.display = 'none';
    });
    
    // Bank Option Selection
    function selectBank(element, bankName) {
        // Remove active class from all options
        const bankOptions = document.querySelectorAll('[onclick^="selectBank"]');
        bankOptions.forEach(option => {
            option.classList.remove('bg-amber-50', 'border-[#ff9a00]');
            option.classList.add('border-gray-200');
        });
        
        // Add active class to clicked option
        element.classList.add('bg-amber-50', 'border-[#ff9a00]');
        element.classList.remove('border-gray-200');
        
        // Check the radio button
        const radioBtn = element.querySelector('input[type="radio"]');
        radioBtn.checked = true;
        
        // Update bank name in details
        document.getElementById('bank-name').textContent = bankName;
        
        // Define different account numbers for each bank
        const bankAccounts = {
            'BCA': '8790123456',
            'Mandiri': '1234567890',
            'BNI': '0987654321',
            'BRI': '1357924680'
        };
        
        // Update account number based on selected bank
        const accountNumberElement = document.querySelector('.flex.justify-between.mb-3:nth-child(2) .flex.items-center');
        const accountNumber = bankAccounts[bankName];
        
        // Update the account number display
        accountNumberElement.innerHTML = accountNumber + 
            ' <button class="bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300" onclick="copyToClipboard(\'' + accountNumber + '\')">Salin</button>';
    }
    
    // Copy to clipboard functionality
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Disalin ke clipboard: ' + text);
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>
</x-layout>