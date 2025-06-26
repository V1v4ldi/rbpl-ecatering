<script>
    // Timer functionality dengan waktu yang akurat dari server
    function startTimer(initialSeconds) {
        let timer = initialSeconds;
        const hoursElem = document.getElementById('hours');
        const minutesElem = document.getElementById('minutes');
        const secondsElem = document.getElementById('seconds');
        
        function updateTimer() {
            if (timer < 0) {
                clearInterval(interval);
                return;
            }
            const hours = Math.floor(timer / 3600);
            const minutes = Math.floor((timer % 3600) / 60);
            const seconds = timer % 60;
            
            if(hoursElem) hoursElem.textContent = hours < 10 ? "0" + hours : hours;
            if(minutesElem) minutesElem.textContent = minutes < 10 ? "0" + minutes : minutes;
            if(secondsElem) secondsElem.textContent = seconds < 10 ? "0" + seconds : seconds;
            
            timer--;
        }

        updateTimer();
        const interval = setInterval(updateTimer, 1000);
    }
    
    function selectBank(element, bankName) {
        const bankOptions = document.querySelectorAll('[onclick^="selectBank"]');
        bankOptions.forEach(option => {
            option.classList.remove('bg-amber-50', 'border-[#ff9a00]');
            option.classList.add('border-gray-200');
        });
        
        element.classList.add('bg-amber-50', 'border-[#ff9a00]');
        element.classList.remove('border-gray-200');
        
        const radioBtn = element.querySelector('input[type="radio"]');
        if (radioBtn) radioBtn.checked = true;
        
        const bankNameElem = document.getElementById('bank-name');
        if (bankNameElem) bankNameElem.textContent = bankName;
        
        const bankAccounts = {
            BCA: '8790123456', Mandiri: '1234567890',
            BNI: '9876543210', BRI: '1122334455'
        };
        
        const accountNumberDisplay = document.getElementById('account-number-display');
        const accountNumber = bankAccounts[bankName];
        
        if (accountNumberDisplay && accountNumber) {
            accountNumberDisplay.innerHTML = accountNumber + 
                ' <button class="cursor-pointer bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300" onclick="copyToClipboard(\'' + accountNumber + '\')">Salin</button>';
        }
    }
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Disalin ke clipboard: ' + text);
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }

    // --- INISIALISASI SCRIPT (Jalan setelah halaman siap) ---
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Ambil semua elemen UI
        const paymentForm = document.getElementById('payment-form');
        const cancelOrderBtn = document.getElementById('cancel-order-btn');
        const transferBankBtn = document.getElementById('transfer-bank');
        const bayarDiTempatBtn = document.getElementById('bayar-ditempat');
        
        const bankSelectionSection = document.getElementById('bank-selection');
        const uploadSection = document.getElementById('upload-section');
        const timeLimitSection = document.getElementById('time-limit');
        const waAdminInfoSection = document.getElementById('wa-admin-info');

        const fileUploadInput = document.getElementById('file-upload');
        const uploadPrompt = document.getElementById('upload-prompt');
        const filePreview = document.getElementById('file-preview');
        const fileNameDisplay = document.getElementById('file-name-display');

        // 2. Definisikan fungsi untuk ganti UI
        function showTransferUI() {
            transferBankBtn.classList.add('bg-amber-50', 'border-[#ff9a00]');
            transferBankBtn.classList.remove('border-gray-200');
            bayarDiTempatBtn.classList.remove('bg-amber-50', 'border-[#ff9a00]');
            bayarDiTempatBtn.classList.add('border-gray-200');

            document.getElementById('payment_method_input').value = 'transfer';

            if (bankSelectionSection) bankSelectionSection.style.display = 'block';
            if (uploadSection) uploadSection.style.display = 'block';
            if (timeLimitSection) timeLimitSection.style.display = 'block';
            if (waAdminInfoSection) waAdminInfoSection.style.display = 'none';
        }

        function showBayarDiTempatUI() {
            bayarDiTempatBtn.classList.add('bg-amber-50', 'border-[#ff9a00]');
            bayarDiTempatBtn.classList.remove('border-gray-200');
            transferBankBtn.classList.remove('bg-amber-50', 'border-[#ff9a00]');
            transferBankBtn.classList.add('border-gray-200');

            document.getElementById('payment_method_input').value = 'cod';

            if (bankSelectionSection) bankSelectionSection.style.display = 'none';
            if (uploadSection) uploadSection.style.display = 'none';
            if (timeLimitSection) timeLimitSection.style.display = 'none';
            if (waAdminInfoSection) waAdminInfoSection.style.display = 'block';
        }

        // 3. Pasang event listener
        if(transferBankBtn) transferBankBtn.addEventListener('click', showTransferUI);
        if(bayarDiTempatBtn) bayarDiTempatBtn.addEventListener('click', showBayarDiTempatUI);

        // TAMBAHKAN EVENT LISTENER UNTUK FILE INPUT
        if (fileUploadInput) {
            fileUploadInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    // Jika ada file yang dipilih
                    const fileName = this.files[0].name;
                    fileNameDisplay.textContent = fileName;
                    
                    uploadPrompt.style.display = 'none';
                    filePreview.style.display = 'block';
                } else {
                    // Jika pengguna membatalkan pilihan file
                    uploadPrompt.style.display = 'block';
                    filePreview.style.display = 'none';
                }
            });
        }

        if (paymentForm) {
            paymentForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Hentikan submit form bawaan

                Swal.fire({
                    title: 'Konfirmasi Pembayaran?',
                    text: "Pastikan data yang Anda masukkan sudah benar.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#ff9a00',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Konfirmasi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading spinner
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading() }
                        });

                        // Kirim form data menggunakan AJAX
                        const formData = new FormData(paymentForm);
                        
                        $.ajax({
                            url: paymentForm.action,
                            type: 'POST',
                            data: formData,
                            processData: false, // Wajib untuk FormData
                            contentType: false, // Wajib untuk FormData
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message,
                                        icon: 'success'
                                    }).then(() => {
                                        // Redirect ke halaman status
                                        window.location.href = response.redirect_url;
                                    });
                                }
                            },
                            error: function(xhr) {
                                const errors = xhr.responseJSON;
                                let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                                if (errors && errors.message) {
                                    errorMessage = errors.message;
                                }
                                Swal.fire('Gagal!', errorMessage, 'error');
                            }
                        });
                    }
                });
            });
        }

        if (cancelOrderBtn) {
            cancelOrderBtn.addEventListener('click', function() {
                const orderId = this.dataset.orderId;

                Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Pesanan ini akan dibatalkan. Aksi ini tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Membatalkan...',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading() }
                        });

                        let urlTemplate = '{{ route("order.cancel", ["order_id" => "PLACEHOLDER"]) }}';
                        let finalUrl = urlTemplate.replace('PLACEHOLDER', orderId);

                        $.ajax({
                            url: finalUrl,
                            type: 'POST',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                Swal.fire('Dibatalkan!', response.message, 'success').then(() => {
                                    window.location.href = '{{ route("checkout") }}';
                                });
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat membatalkan pesanan.', 'error');
                            }
                        });
                    }
                });
            });
        }

        // 4. Atur tampilan awal & jalankan fungsi lain
        showTransferUI(); // Defaultnya tampilkan UI Transfer Bank

        const remainingSeconds = {{ $remainingSeconds ?? 0 }};
        startTimer(remainingSeconds);

        const defaultBankElem = document.querySelector('[onclick^="selectBank"][onclick*="BCA"]');
        if (defaultBankElem) {
            selectBank(defaultBankElem, 'BCA');
        }
    });
</script>