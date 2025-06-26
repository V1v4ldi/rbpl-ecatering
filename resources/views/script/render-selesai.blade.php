<script>
    const dncontainer = document.querySelector('#dnContainer');
    if(document.querySelector('#dnContainer')){dncontainer.innerHTML = `
                <div class="text-center py-8">
                    <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i>
                    <div class="text-gray-500 mt-2">Memuat Pesanan...</div>
                </div>
            `;}

    function getOrderDone(){
        $.ajax({
            url: '{{ route("orderdone.get") }}',
            type: 'GET',
            dataType:'json',
            success: function(response){
                if(document.querySelector('#dnContainer')){
                    renderOrderDone(response);
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
            }
        });
    }

    function renderOrderDone(response){
        if(response.orders && response.orders.length > 0){
            dncontainer.innerHTML = '';
            response.orders.forEach(item => {
                const dnElement = `
                <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex-1">
                        <div class="font-medium mb-1">Jumlah Paket: ${item.jumlah}</div>
                        <div class="text-gray-600 text-sm mb-1">Tanggal Kirim: ${item.tanggal_kirim}</div>
                        <div class="text-gray-600 text-sm">Total: Rp.${new Intl.NumberFormat('id-ID').format(item.total)}</div>
                    </div>
                    <div class="ml-4">
                        <a href="payment/status/${item.encrypted_id}" class="py-2 px-4 rounded text-sm cursor-pointer border border-gray-200 bg-white text-gray-600">${item.status_pesanan}</a>
                    </div>
                </div>
            </div>`;
                dncontainer.innerHTML += dnElement;
            });
        }
        else{
            dncontainer.innerHTML = `
            <div class="text-center py-8">
                <i class='bx bx-cart text-4xl text-gray-400 mb-2'></i>
                <div class="text-gray-500">Belum ada pesanan yang selesai 😞</div>
                <div class="text-sm text-gray-400 mt-1">Tolong bersabar atau segera checkout</div>
                <a href="{{ route('order') }}" class="mt-3 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                    <i class='bx bx-shopping-bag mr-1'></i> Belanja Sekarang
                </a>
            </div>`;
        }
    }

    document.addEventListener('DOMContentLoaded', function(){
    getOrderDone();
    });
</script>