<script>
    document.addEventListener('DOMContentLoaded', function() {
    //Delivery Date
    const deliveryDateInput = document.getElementById('delivery-date');

    // Address Functionality
    const deliveryAddressInput = document.getElementById('delivery-address');
    
    // Notes Functionality
    const deliveryNotesInput = document.getElementById('delivery-notes');

    //Confirm Button
    const confirmDeliveryBtn = document.getElementById('confirm-delivery');

    //Time Handler
    const deliveryTimeInput = document.getElementById('delivery-time');

    function setupTimePicker() {
        console.log('⏰ Setting up time picker...');
        
        const timeOptions = [
            '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30',
            '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30',
            '19:00', '19:30', '20:00'
        ];

        const timePickerContainer = document.createElement('div');
        timePickerContainer.className = 'relative';
        
        const timePickerInput = document.createElement('input');
        timePickerInput.type = 'text';
        timePickerInput.id = 'delivery-time-custom';
        timePickerInput.className = 'w-full p-2 border border-gray-200 rounded cursor-pointer';
        timePickerInput.placeholder = 'Pilih waktu pengiriman';
        timePickerInput.readOnly = true;
        
        const timePickerDropdown = document.createElement('div');
        timePickerDropdown.className = 'absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-b max-h-48 overflow-y-auto z-10 hidden';
        
        // Add time options to dropdown
        timeOptions.forEach(time => {
            const timeOption = document.createElement('div');
            timeOption.className = 'p-2 hover:bg-gray-100 cursor-pointer text-sm';
            timeOption.textContent = time;
            timeOption.addEventListener('click', function() {
                
                // Update visible input
                timePickerInput.value = time;
                
                // Update hidden input
                const hiddenInput = document.getElementById('delivery-time');
                if (hiddenInput) {
                    hiddenInput.value = time;
                } else {
                    console.error('❌ Hidden input not found!');
                }
                
                // Close dropdown
                timePickerDropdown.classList.add('hidden');
                
                // Show success feedback
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: `Waktu ${time} dipilih`,
                    showConfirmButton: false,
                    timer: 2000
                });
            });
            timePickerDropdown.appendChild(timeOption);
        });
        
        // Toggle dropdown
        timePickerInput.addEventListener('click', function() {
            timePickerDropdown.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!timePickerContainer.contains(e.target)) {
                timePickerDropdown.classList.add('hidden');
            }
        });
        
        timePickerContainer.appendChild(timePickerInput);
        timePickerContainer.appendChild(timePickerDropdown);
        
        // Replace original time input
        const originalTimeInput = document.getElementById('delivery-time');
        if (originalTimeInput) {
            originalTimeInput.parentNode.replaceChild(timePickerContainer, originalTimeInput);
            
            // Keep reference to original input (hidden)
            const hiddenTimeInput = document.createElement('input');
            hiddenTimeInput.type = 'hidden';
            hiddenTimeInput.id = 'delivery-time';
            hiddenTimeInput.name = 'delivery_time';
            timePickerContainer.appendChild(hiddenTimeInput);
            
            console.log('✅ Time picker setup complete');
        } else {
            console.error('❌ Original time input not found');
        }
    }

    window.BookedDates = [];
    // Calendar functionality
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const calendarMonth = document.getElementById('calendar-month');
    const calendarGrid = document.getElementById('calendar-grid');

    function getdate(){
        return new Promise((resolve, reject) =>{
        $.ajax({
            url: '{{ route("order.get.date") }}',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                if(response.booked_dates){
                    window.BookedDates = response.booked_dates;
                    
                    // ✅ Trigger calendar update
                    if (typeof window.updateCalendarWithBookedDates === 'function') {
                        window.updateCalendarWithBookedDates();
                    }
                    resolve(response);
                }
            },
            error: function(xhr){
                let errorMessage = 'Gagal memuat data';
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                        errorMessage = Object.values(errors).flat().join('\n');
                        }
                        } else if (xhr.status === 401) {
                            errorMessage = 'Sesi telah berakhir, silakan login kembali';
                        } else if (xhr.status === 404) {
                            errorMessage = 'Route tidak ditemukan';
                        } else if (xhr.status === 500) {
                            errorMessage = 'Terjadi kesalahan pada server';
                    }
                    reject(new Error(errorMessage));
                }
            });
        });
    }

    // Calendar variables
    let currentDate = new Date();
    let selectedDate = null;

    function formatDateToString(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Booked Dates Function
    function isDateBooked(date) {
        if (!window.BookedDates || !Array.isArray(window.BookedDates)) {
            return false;
        }
        
        const dateString = formatDateToString(date);
        const isBooked = BookedDates.includes(dateString);
        
        return isBooked;
    }

    // ✅ Global function to update calendar when booked dates are loaded
    window.updateCalendarWithBookedDates = function() {
        renderCalendar();
    };


    // Calendar functions
    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        // Update month display
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        calendarMonth.textContent = `${monthNames[month]} ${year}`;
        
        // Clear calendar grid (keep headers)
        const headers = calendarGrid.querySelectorAll('.text-sm.font-medium');
        calendarGrid.innerHTML = '';
        headers.forEach(header => calendarGrid.appendChild(header));
        
        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - (firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1));
        
        // Generate calendar days
        for (let i = 0; i < 42; i++) {
            const currentCalendarDate = new Date(startDate);
            currentCalendarDate.setDate(startDate.getDate() + i);
            
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center p-2 text-sm cursor-pointer hover:text-black hover:bg-gray-100 rounded';
            dayElement.textContent = currentCalendarDate.getDate();
            
            // Style for different month days
            if (currentCalendarDate.getMonth() !== month) {
                dayElement.classList.add('text-gray-400');
            }
            
            // Disable past dates
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const isBooked = isDateBooked(currentCalendarDate);

            if (currentCalendarDate <= today) {
                    // Tanggal masa lalu - abu-abu dengan garis diagonal
                    dayElement.classList.add('text-gray-300', 'cursor-not-allowed', 'line-through', 'opacity-50');
                    dayElement.classList.remove('hover:bg-gray-100', 'cursor-pointer');
                    dayElement.style.textDecoration = 'line-through';
                } else if (isBooked) {
                    // Tanggal sudah dibooking - merah dengan icon X
                    dayElement.classList.add('text-red-500', 'cursor-not-allowed', 'bg-red-50', 'font-semibold');
                    dayElement.classList.remove('hover:bg-gray-100', 'cursor-pointer');
                    dayElement.innerHTML = `${currentCalendarDate.getDate()} <span class="text-xs">✗</span>`;
                    dayElement.title = 'Tanggal sudah dibooking';
                } else if (currentCalendarDate.getMonth() !== month) {
                    // Tanggal bukan bulan ini - abu-abu terang
                    dayElement.classList.add('text-gray-300', 'cursor-not-allowed', 'opacity-60');
                    dayElement.classList.remove('hover:bg-gray-100', 'cursor-pointer');
                } else {
                // Add click event for future dates
                dayElement.addEventListener('click', function() {
                    if (currentCalendarDate >= today) {
                        selectedDate = new Date(currentCalendarDate);
                        
                        // Remove previous selection
                        calendarGrid.querySelectorAll('.bg-orange-500').forEach(el => {
                            el.classList.remove('bg-orange-500', 'text-white');
                        });
                        
                        // Highlight selected date
                        dayElement.classList.add('bg-orange-500', 'text-white');
                        
                        // Update input
                        const options = { 
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric',
                            timeZone: 'Asia/Jakarta'
                        };
                        deliveryDateInput.value = selectedDate.toLocaleDateString('id-ID', options);
                        Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: `Tanggal Dipilih!`,
                    showConfirmButton: false,
                    timer: 2000
                });
                    }
                });
            }
            calendarGrid.appendChild(dayElement);
        }
    }

    // Confirm delivery button
    confirmDeliveryBtn.addEventListener('click', function() {
        const deliveryTime = document.getElementById('delivery-time').value;
        const deliveryAddress = deliveryAddressInput.value.trim();
        const deliveryNotes = deliveryNotesInput.value.trim();
        
        // Validation
        if (!selectedDate) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanggal Belum Dipilih',
                text: 'Silakan pilih tanggal pengiriman terlebih dahulu',
                confirmButtonColor: '#ff9a00'
            });
            return;
        }
        
        if (!deliveryTime) {
            Swal.fire({
                icon: 'warning',
                title: 'Waktu Belum Dipilih',
                text: 'Silakan pilih waktu pengiriman terlebih dahulu',
                confirmButtonColor: '#ff9a00'
            });
            return;
        }
        
        if (!deliveryAddress) {
            Swal.fire({
                icon: 'warning',
                title: 'Alamat Belum Diisi',
                text: 'Silakan isi alamat pengiriman terlebih dahulu',
                confirmButtonColor: '#ff9a00'
            });
            deliveryAddressInput.focus();
            return;
        }
        const formattedDate = formatDateToString(selectedDate);
        
        // Show confirmation
        Swal.fire({
            title: 'Konfirmasi Pengiriman',
            html: `
                <div class="text-left">
                    <p><strong>Tanggal:</strong> ${deliveryDateInput.value}</p>
                    <p><strong>Waktu:</strong> ${deliveryTime}</p>
                    <p><strong>Alamat:</strong> ${deliveryAddress}</p>
                    ${deliveryNotes ? `<p><strong>Catatan:</strong> ${deliveryNotes}</p>` : ''}
                    <p class="mt-3 text-red-600"><strong>Semua Barang Didalam Keranjang Akan Dicheckout</strong></p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ff9a00',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Konfirmasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("order.create") }}',
                    type: 'POST',
                    data: {
                        tanggal_kirim: formattedDate,
                        alamat: deliveryAddress,
                        catatan: deliveryNotes,
                        waktu: deliveryTime,
                        checkoutt: 1,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Pengiriman Dikonfirmasi!',
                            text: 'Jadwal pengiriman berhasil disimpan',
                            confirmButtonColor: '#ff9a00'
                        }).then(() => {
                            // Redirect to cart or order summary
                            window.location.href = '{{ route("checkout") }}';
                        });
                    },
                    error: function(xhr){
                        let errorMessage = 'Gagal menyimpan jadwal pengiriman';
                        
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                errorMessage = Object.values(errors).flat().join('\n');
                            }
                        } else if (xhr.status === 401) {
                            errorMessage = 'Sesi telah berakhir, silakan login kembali';
                        } else if (xhr.status === 404) {
                            errorMessage = 'Route tidak ditemukan';
                        } else if (xhr.status === 500) {
                            errorMessage = 'Terjadi kesalahan pada server';
                        }

                        Swal.fire({
                                icon: 'error',
                                title: 'Gagal Menyimpan!',
                                text: errorMessage,
                                confirmButtonColor: '#ff9a00'
                            });
                        }
                });
            }
        });
    });


    //Default Date function
    function setDefaultDate() {
        
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        // ✅ Find next available date if tomorrow is booked
        let attempts = 0;
        while (isDateBooked(tomorrow) && attempts < 30) {
            tomorrow.setDate(tomorrow.getDate() + 1);
            attempts++;
        }
        
        selectedDate = new Date(tomorrow);
        const options = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        deliveryDateInput.value = tomorrow.toLocaleDateString('id-ID', options);
    }

    // Navigation buttons
    prevMonthBtn.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    async function initializeOrder() {
        try{
        await getdate();
        // ✅ Wait for booked dates then set default
        setTimeout(() => {
            setupTimePicker();
            setDefaultDate();
            renderCalendar();
        }, 500);
        }
        catch{
            setupTimePicker();
            setDefaultDate();
            renderCalendar();
        }
    }
    
    initializeOrder();
    });
</script>