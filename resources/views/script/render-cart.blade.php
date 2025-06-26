<script>
    const cartcontainer = document.querySelector('#containercart');
    if(document.querySelector('#containercart')){cartcontainer.innerHTML = `
                <div class="text-center py-8">
                    <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i>
                    <div class="text-gray-500 mt-2">Memuat keranjang...</div>
                </div>
            `;}
        
        function rendercart(response){
            if(response.items && response.items.length > 0){
            cartcontainer.innerHTML= '';
                response.items.forEach(item => {
                    const itemElement= `
                    <div class="bg-white rounded-lg p-5 mb-4 shadow-sm border flex items-center gap-5 border-gray-200">
                            <div class="w-16 h-16 flex-shrink-0 ">
                            <img src="${item.product.image_url}" alt="Rendang Daging Sapi" class="w-full h-full rounded-[6px] object-cover">
                            </div>
                        <div class="flex-grow">
                            <div class="font-medium mb-1">${item.product.nama}</div>
                            <div class="text-gray-600 text-sm">Harga (Satuan): ${item.product.harga.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="float-right pr-3">
                            <button class="cursor-pointer rm-item" data-itemid="${item.cart_d_id}">
                            <i class='text-red-600 text-2xl bx bxs-trash'></i>
                            </button>
                        </div>
                    </div>`;
                cartcontainer.innerHTML += itemElement;
                });
            }
            else{
                cartcontainer.innerHTML = `
        <div class="text-center py-8">
            <i class='bx bx-cart text-4xl text-gray-400 mb-2'></i>
            <div class="text-gray-500">Belum ada makanan 😞</div>
            <div class="text-sm text-gray-400 mt-1">Buat ayo tambahkan makanan untuk melanjutkan</div>
            <a href="{{ route('order') }}" class="mt-3 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                <i class='bx bx-shopping-bag mr-1'></i> Belanja Sekarang
            </a>
        </div>`;
            }
        }
</script>