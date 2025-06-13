<script>
const orderContainer = document.querySelector('#ordercontainer');
    if(document.querySelector('#ordercontainer')){
            orderContainer.innerHTML =
                `<div class="text-center py-8">
                    <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i>
                    <div class="text-gray-500 mt-2">Memuat Pesanan...</div>
                </div>`; // Loading Container
        }
        

        // AJAX Get Order

    function renderorder(response){
        if(response.orders && response.orders.length > 0){
        orderContainer.innerHTML = '';
        response.orders.forEach(order => {
            const orderelement = 
            `<div class="bg-white rounded-lg p-5 mb-4 shadow-sm border border-gray-200">
                <div class="font-medium mb-1">Order tanggal: ${order.created_at}</div>
                <div class="text-gray-600 text-sm mb-1">Order Dikirim: ${order.tanggal_kirim} Jam: ${order.waktu}</div>
                <div class="text-gray-600 text-sm">Total: </div>
                <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-1 mt-3 lg:-mt-15 lg:mb-5">
                    <button class="py-1 px-2 lg:py-2 lg:px-5 rounded text-xs lg:text-sm border border-gray-200 bg-white text-gray-600 w-full sm:w-auto">
                        ${order.status_pesanan}
                    </button>
                    <a href="/payment/${order.encrypted_id}" class="py-1 px-2 lg:py-2 lg:px-4 rounded text-xs lg:text-sm cursor-pointer bg-orange-500 text-white border border-orange-500 w-full sm:w-auto">
                        Bayar Sekarang
                    </a>
                </div>
            </div>`;
            orderContainer.innerHTML += orderelement;
        });
    }
    else{
        orderContainer.innerHTML = `
        <div class="text-center py-8">
            <i class='bx bx-cart text-4xl text-gray-400 mb-2'></i>
            <div class="text-gray-500">Belum ada order 😞</div>
            <div class="text-sm text-gray-400 mt-1">Buat order untuk melanjutkan</div>
            <a href="{{ route('order') }}" class="mt-3 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                <i class='bx bx-shopping-bag mr-1'></i> Belanja Sekarang
            </a>
        </div>`;
        }
    }
</script>