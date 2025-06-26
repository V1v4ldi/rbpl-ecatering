<script>
        // Fungsi ini akan dipanggil oleh Alpine saat tab diklik
        // dan juga saat halaman pertama kali dimuat untuk tab default.
        window.dataCache = {
            km: null,
            dp: null,
            dr: null
        };
        window.dataLoaded = {
            km: false,
            dp: false,
            dr: false
        };

        function getStatusClass(status) {
            const statusMap = {
                'Belum Dibayar': 'status-belum-dibayar',
                'Sedang Diverifikasi': 'status-sedang-diverifikasi', 
                'Sudah Diverifikasi': 'status-sudah-diverifikasi',
                'Sedang Dibuat': 'status-sedang-dibuat',
                'Dalam Pengiriman': 'status-dalam-pengiriman',
                'Selesai': 'status-selesai',
                'Dibatalkan': 'status-batal'
            };
            return statusMap[status] || 'status-badge';
        }

        function formatRupiah(angka) {
            if (angka === null || typeof angka === 'undefined') return 'Rp 0';
            return 'Rp. ' + parseInt(angka).toLocaleString('id-ID');
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        // Fungsi untuk memuat data berdasarkan halaman aktif
        window.loadDataForPage = function(pageKey, forceRefresh = false) {
                // Jika Anda ingin memastikan render ulang dari cache jika DOM berubah:
                if (pageKey === 'km' && window.dataCache.km) renderKatalogMenu(window.dataCache.km);
                else if (pageKey === 'dp' && window.dataCache.dp) renderPesanan(window.dataCache.dp);
                else if (pageKey === 'dr' && window.dataCache.dr) renderReservasi(window.dataCache.dr);

            let url = '';
            let loadingElementId = '';
            let successCallback;

            switch (pageKey) {
                default:
                    pageKey = 'km',
                    url = '{{ route("menu.index") }}';
                    loadingElementId = '#katalogMenuLoading';
                    successCallback = function(data) {
                        window.dataCache.km = data;
                        renderKatalogMenu(data);
                    };
                    break;
                case 'dp':
                    url = '{{ route("getOrders") }}';
                    loadingElementId = '#pesananLoading';
                     successCallback = function(data) {
                        window.dataCache.dp = data;
                        renderPesanan(data);
                    };
                    break;
                case 'dr':
                    url = '{{ route("getResv") }}';
                    loadingElementId = '#reservasiLoading';
                    successCallback = function(data) {
                        window.dataCache.dr = data;
                        renderReservasi(data);
                    };
                    break;
            }

            $(loadingElementId).show().text('Memuat data...');
            if (pageKey === 'km') $('#katalogMenuList').empty().append(`<p class="col-span-full text-center text-gray-500" id="katalogMenuLoading">Memuat data...</p>`);
            if (pageKey === 'dp') $('#pesananList').empty().html(`<tr><td colspan="6" class="text-center py-4 text-gray-500" id="pesananLoading">Memuat data...</td></tr>`);
            if (pageKey === 'dr') $('#reservasiList').empty().html(`<tr><td colspan="5" class="text-center py-4 text-gray-500" id="reservasiLoading">Memuat data...</td></tr>`);


            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    window.dataLoaded[pageKey] = true;
                    $(loadingElementId).hide();
                    successCallback(response);
                },
                error: function(xhr, status, error) {
                    $(loadingElementId).text('Gagal memuat data. Coba lagi.');
                    // alert(`Gagal memuat data untuk ${pageKey}.`);
                }
            });
        };

        function renderKatalogMenu(products) {
            const container = $('#katalogMenuList');
            container.empty(); // Kosongkan kontainer
            if (products && products.length > 0) {
                products.forEach(product => {
                    const productHtml = `
                        <div class="overflow-hidden rounded-lg bg-gray-50 p-3 mb-2">
                            <img src="${product.image_url}" alt="${product.nama}" class="rounded-[6px] w-full h-56 object-cover">
                            <div class="py-4">
                                <h3 class="font-bold text-gray-800 text-lg">${product.nama}</h3>
                                <p class="text-sm text-gray-600 mt-1">${product.deskripsi}</p>
                                <p class="font-medium text-gray-800 mt-2 mb-3">${formatRupiah(product.harga)}</p>
                                <div>
                                    <button class="edit-menu-btn w-1/2 border border-[#ff9a00] rounded-full py-2 px-4 hover:text-white hover:bg-[#ff9a00] cursor-pointer duration-300" data-id="${product.enc_id}">
                                        Edit
                                    </button>
                                    <button class="delete-menu-btn w-1/2 border border-red-500 text-red-500 rounded-full float-right py-2 px-4 hover:text-white hover:bg-red-600 cursor-pointer duration-300" data-id="${product.enc_id}">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.append(productHtml);
                });
            } else {
                container.html('<p class="col-span-full text-center text-gray-500">Tidak ada produk ditemukan.</p>');
            }
        }

        function renderPesanan(orders) {
            const tbody = $('#pesananList');
            tbody.empty();
            if (orders && orders.length > 0) {
                orders.forEach(order => {
                    const rowHtml = `
                        <tr>
                            <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">${order.customer.name}</td>
                            <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">${formatDate(order.tanggal_kirim)} ${order.waktu}</td>
                            <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">${formatRupiah(order.total_calculated || order.total)}</td>
                            <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">
                                <span class="status-badge ${getStatusClass(order.status_pesanan)}">${order.status_pesanan}</span>
                            </td>
                            <td class="px-4 py-3 text-center text-xs text-gray-500">
                                <button class="detail-pesanan-btn bg-gray-200 w-[80px] h-[25px] text-black rounded-[6px] cursor-pointer hover:bg-gray-400 hover:text-white duration-300" data-name="${order.customer.name}" data-id="${order.enc_id}">Detail</button>
                                <select  class="px-3 cursor-pointer bg-[#ff9a00] text-white update-status-pesanan w-auto h-[25px] text-xs border-gray-300 rounded-[6px] hover:bg-[#d68100] duration-300" data-id="${order.enc_id}">
                                    <option disabled selected style="display:none">Update</option>
                                    <option value="Dibatalkan">Batal</option>
                                    <option value="Sedang Dibuat">Dibuat</option>
                                    <option value="Dalam Pengiriman">Dikirim</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                    `;
                    tbody.append(rowHtml);
                });
            } else {
                tbody.html('<tr><td colspan="6" class="text-center py-4 text-gray-500">Tidak ada pesanan ditemukan.</td></tr>');
            }
        }

        function renderReservasi(orders) {
            const tbody = $('#reservasiList');
            tbody.empty();
             if (orders && orders.length > 0) {
                orders.forEach(res => {
                    const rowHtml = `
                        <tr>
                            <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">${res.customer.name}</td>
                            <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">${formatDate(res.tanggal_kirim)}</td>
                             <td class="px-4 py-3 text-center text-xs font-medium text-gray-500">
                        <span class="status-badge ${getStatusClass(res.status_pesanan)}">${res.status_pesanan}</span>
                    </td>
                            <td class="px-4 py-3 text-center text-xs text-gray-500">
                                <button class="detail-reservasi-btn bg-gray-200 w-[80px] h-[25px] text-black rounded-[6px] cursor-pointer hover:bg-gray-400 hover:text-white duration-300" data-name="${res.customer.name}" data-id="${res.enc_id}">Detail</button>
                                <button class="update-status-reservasi bg-green-400 w-[80px] h-[25px] text-white rounded-[6px] cursor-pointer hover:bg-green-600 duration-300" data-id="${res.enc_id}">Konfirmasi</button>
                            </td>
                        </tr>
                    `;
                    tbody.append(rowHtml);
                });
            } else {
                tbody.html('<tr><td colspan="5" class="text-center py-4 text-gray-500">Tidak ada reservasi ditemukan.</td></tr>');
            }
        }

        // Fungsi untuk menutup semua modal (dipanggil oleh Alpine)
        window.closeAllModals = function() {
            $('#menuModal').hide();
            $('#detailModal').hide();
            // Reset form jika perlu
            $('#menuForm')[0].reset();
            $('#menuProductId').val('');
            $('#currentMenuImage').hide().attr('src', '');
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadDataForPage('km', true, 1);

            // --- Event Listeners untuk Modal Menu ---
            $('#openAddMenuModalBtn').on('click', function() {
                $('#menuModalTitle').text('Tambah Menu Baru');
                $('#menuForm')[0].reset();
                $('#menuProductId').val('');
                $('#menuFormMethod').val('POST');
                $('#menuImgname').prop('required', true);
                $('#menuImgnameHelp').hide();
                $('#currentMenuImage').hide();
                $('#menuModal').show();
            });

            $('#closeMenuModalBtn, #cancelMenuModalBtn').on('click', function() {
                $('#menuModal').hide();
            });

            // Edit Menu
            $('#katalogMenuList').on('click', '.edit-menu-btn', function() {
                const productId = $(this).data('id');
                $.ajax({
                    url: `/admin/menu/${productId}`,
                    method: 'GET',
                    success: function(product) {
                        $('#menuModalTitle').text('Edit Menu');
                        $('#menuProductId').val(productId);
                        $('#menuFormMethod').val('PUT'); 
                        $('#menuNama').val(product.nama);
                        $('#menuHarga').val(product.harga);
                        $('#menuDeskripsi').val(product.deskripsi);
                        $('#menuImgname').prop('required', false); 
                        $('#menuImgnameHelp').show();
                        if(product.imgname) {
                            $('#currentMenuImage').attr('src', `/storage/product/${product.imgname}`).show();
                        } else {
                            $('#currentMenuImage').hide();
                        }
                        $('#menuModal').show();
                    },
                    error: function() { alert('Gagal mengambil data produk.'); }
                });
            });

            
            $('#menuForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const productId = $('#menuProductId').val();
                let url = '{{ route("menu.store") }}';
                let method = 'POST'; 

                if (productId) { 
                    url = `/admin/menu/${productId}`;
                }
                

                $('#saveMenuBtn').prop('disabled', true).text('Menyimpan...');

                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jika route API di web.php
                    },
                    success: function(response) {
                        Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                        $('#menuModal').hide();
                        loadDataForPage('km', true); // Refresh katalog menu
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            let errorMsg = "Terjadi kesalahan:\n";
                            $.each(errors, function(key, value) {
                                errorMsg += value.join("\n") + "\n";
                            });
                            alert(errorMsg);
                        } else {
                            alert('Gagal menyimpan produk.');
                        }
                    },
                    complete: function() {
                         $('#saveMenuBtn').prop('disabled', false).text('Simpan');
                    }
                });
            });

            // Delete Menu
            $('#katalogMenuList').on('click', '.delete-menu-btn', function() {
                if (!confirm('Anda yakin ingin menghapus produk ini?')) return;
                const productId = $(this).data('id');
                $.ajax({
                    url: `/admin/menu/${productId}`, // Sesuaikan URL
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                        loadDataForPage('km', true);
                    },
                    error: function() { alert('Gagal menghapus produk.'); }
                });
            });

            // --- Event Listeners untuk Pesanan ---
             $('#pesananList').on('click', '.detail-pesanan-btn', function() {
                const orderId = $(this).data('id');
                const orderName = $(this).data('name')
                $('#detailModalTitle').text('Detail Pesanan: ' + orderName);
                $('#detailModalContent').html('<p class="text-center">Memuat detail...</p>');
                $('#detailModal').show();
                $.get(`/admin/order/${orderId}`, function(data) {
                    // --- DESAIN BARU YANG LEBIH BAIK ---
                    let content = `
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Lokasi Pengiriman:</span>
                                <span class="text-gray-800 text-right">${data.alamat || '-'}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Waktu Pengiriman:</span>
                                <span class="text-gray-800">${formatDate(data.tanggal_kirim)} ${data.waktu || ''}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Jumlah Pesanan:</span>
                                <span class="text-gray-800">${data.jumlah || '-'} Porsi</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Metode Pembayaran:</span>
                                <span class="text-gray-800 font-medium">${data.payment_method}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Status Pesanan:</span>
                                <span class="status-badge ${getStatusClass(data.status_pesanan)}">${data.status_pesanan}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Catatan:</span>
                                <span class="text-gray-800 text-right">${data.catatan || '-'}</span>
                            </div>
                            <div class="flex justify-between pt-2 text-base">
                                <span class="font-bold text-gray-700">Total Biaya:</span>
                                <span class="font-bold text-[#ff9a00]">${formatRupiah(data.total || 0)}</span>
                            </div>
                        </div>
                    `;

                    // --- LOGIKA UNTUK MENAMPILKAN GAMBAR ---
                    if (data.payment_method === 'Transfer' && data.payment_proof_url) {
                        content += `
                            <div class="mt-6 pt-4 border-t">
                                <h4 class="font-semibold text-gray-700 mb-2">Bukti Pembayaran:</h4>
                                    <div class="flex justify-center">
                                        <a href="${data.payment_proof_url}" target="_blank" title="Klik untuk melihat ukuran penuh">
                                            <img src="${data.payment_proof_url}" alt="Bukti Pembayaran" class="rounded-lg max-w-full h-[300px] shadow-md">
                                        </a>
                                    </div>
                            </div>
                        `;
                    }

                    $('#detailModalContent').html(content);
                }).fail(function() { $('#detailModalContent').html('<p class="text-center text-red-500">Gagal memuat detail.</p>'); });
            });

            $('#pesananList').on('change', '.update-status-pesanan', function() {
                const orderId = $(this).data('id');
                const newStatus = $(this).val();

                $.ajax({
                    url: `/admin/order/update/${orderId}`, // Sesuaikan URL
                    method: 'PUT',
                    data: JSON.stringify({ status: newStatus }),
                    contentType: 'application/json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                        loadDataForPage('dp', true); // Refresh daftar pesanan
                    },
                    error: function() { alert('Gagal update status pesanan.'); }
                });
            });


            // --- Event Listeners untuk Reservasi ---
            $('#reservasiList').on('click', '.detail-reservasi-btn', function() {
                const reservasiId = $(this).data('id');
                const reservasiName = $(this).data('name');
                $('#detailModalTitle').text('Detail Reservasi: ' + reservasiName);
                $('#detailModalContent').html('<p class="text-center">Memuat detail...</p>');
                $('#detailModal').show();
                 $.get(`/admin/resv/${reservasiId}`, function(data) {
                    // --- DESAIN BARU YANG LEBIH BAIK ---
                    let content = `
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Lokasi Acara:</span>
                                <span class="text-gray-800 text-right">${data.alamat || '-'}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Tanggal Acara:</span>
                                <span class="text-gray-800">${formatDate(data.tanggal_kirim)} ${data.waktu || ''}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Jumlah Tamu:</span>
                                <span class="text-gray-800">${data.jumlah || '-'} Orang</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Metode Pembayaran:</span>
                                <span class="text-gray-800 font-medium">${data.payment_method}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Status Reservasi:</span>
                                <span class="status-badge ${getStatusClass(data.status_pesanan)}">${data.status_pesanan}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-600">Catatan:</span>
                                <span class="text-gray-800 text-right">${data.catatan || '-'}</span>
                            </div>
                            <div class="flex justify-between pt-2 text-base">
                                <span class="font-bold text-gray-700">Total Biaya:</span>
                                <span class="font-bold text-[#ff9a00]">${formatRupiah(data.total || 0)}</span>
                            </div>
                        </div>
                    `;

                    // --- LOGIKA UNTUK MENAMPILKAN GAMBAR ---
                    if (data.payment_method === 'Transfer' && data.payment_proof_url) {
                        content += `
                            <div class="mt-6 pt-4 border-t">
                                <h4 class="font-semibold text-gray-700 mb-2">Bukti Pembayaran:</h4>
                                    <div class="flex justify-center">
                                        <a href="${data.payment_proof_url}" target="_blank" title="Klik untuk melihat ukuran penuh">
                                            <img src="${data.payment_proof_url}" alt="Bukti Pembayaran" class="rounded-lg max-w-full h-[300px] shadow-md">
                                        </a>
                                    </div>
                            </div>
                        `;
                    }

                    $('#detailModalContent').html(content);
                }).fail(function() { $('#detailModalContent').html('<p class="text-center text-red-500">Gagal memuat detail.</p>'); });
            });

            $('#reservasiList').on('click', '.update-status-reservasi', function() {
                const reservasiId = $(this).data('id');
                $.ajax({
                    url: `/admin/resv/update/${reservasiId}`, // Sesuaikan URL
                    method: 'PUT',
                    contentType: 'application/json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                        loadDataForPage('dr', true);
                    },
                    error: function() { alert('Gagal update status reservasi.'); }
                });
            });


            // Close Detail Modal
            $('#closeDetailModalBtn, #closeDetailModalBtnSecondary').on('click', function() {
                $('#detailModal').hide();
            });

        });
</script>