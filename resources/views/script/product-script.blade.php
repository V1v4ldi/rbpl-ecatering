<script>
document.addEventListener('DOMContentLoaded', async function() {
    
    try {
        if (typeof window.getcart === 'function') {
            await window.getcart();
            console.log('Cart loaded successfully, cart items:', window.cartItems);
        }
    } catch (error) {
        console.warn('Failed to load cart, but continuing with products:', error);
    }

    function handlePaginationClick(event) {
        event.preventDefault();
        
        const link = event.target.closest('a');
        if (!link || link.classList.contains('disabled')) {
            return;
        }
        
        const url = link.getAttribute('href');
        if (!url || url === '#') {
            return;
        }
        
        loadProducts(url);
    }
    
    async function loadProducts(url) {
        document.getElementById('loading-indicator').classList.remove('hidden');
        document.getElementById('products-grid').style.opacity = '0.5';
        
        document.getElementById('products-container').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
        
        // Extract page parameter dari URL yang diklik
        const pageParam = new URL(url).searchParams.get('page') || '1';
        
        $.ajax({
            url: '{{ route("product.get") }}',
            type: 'GET',
            data: {
                page: pageParam
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    updateProductsGrid(response.products);
                    updatePagination(response.pagination.links);
                    
                    // Update URL browser
                    if (pageParam && pageParam !== '1') {
                        history.pushState(null, '', `{{ route("order") }}?page=${pageParam}`);
                    } else {
                        history.pushState(null, '', '{{ route("order") }}');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading products:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat produk. Silakan coba lagi.',
                    confirmButtonColor: '#ff9a00'
                });
            },
            complete: function() {
                document.getElementById('loading-indicator').classList.add('hidden');
                document.getElementById('products-grid').style.opacity = '1';
            }
        });
    }
    
    // ✅ TAMBAHKAN FUNCTION INI
    function updateProductsGrid(products) {
        const productsGrid = document.getElementById('products-grid');
        
        if (products.length === 0) {
            productsGrid.innerHTML = `
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Tidak ada produk ditemukan.</p>
                </div>
            `;
            return;
        }
        
        let html = '';
        products.forEach(product => {
            // Check if item is already in cart
            const isInCart = typeof window.isItemInCart === 'function' ? window.isItemInCart(product.product_id) : false;
            
            // Dynamic button classes and attributes
            const buttonClass = isInCart 
                ? 'cursor-not-allowed w-full py-2 bg-gray-400 text-white border border-gray-400 rounded font-medium' 
                : 'cursor-pointer w-full py-2 border border-[#ff9a00] text-[#ff9a00] hover:bg-[#ff9a00] hover:text-white transition-colors rounded font-medium add-to-cart';
            
            const buttonText = isInCart ? 'Sudah di Keranjang' : 'Add to Cart';
            const buttonDisabled = isInCart ? 'disabled' : '';
            const dataAttribute = isInCart ? '' : `data-productid="${product.product_id}"`;
            
            html += `
                <div class="bg-white rounded-lg overflow-hidden shadow hover:-translate-y-1 transition-transform duration-300 p-2">
                    <div class="h-44 overflow-hidden">
                        <img src="{{ asset('storage/product/') }}/${product.image_url}" alt="${product.nama}" class="w-full h-full rounded-[6px] object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-1">${product.nama}</h3>
                        <p class="text-sm text-gray-600 mb-1">${product.deskripsi}</p>
                        <p class="font-semibold mb-3">Rp. ${new Intl.NumberFormat('id-ID').format(product.harga)}</p>
                        <button class="${buttonClass}" ${dataAttribute} ${buttonDisabled}>
                            ${buttonText}
                        </button>
                    </div>
                </div>
            `;
        });
        
        productsGrid.innerHTML = html;

        // Re-attach event listeners only for enabled buttons
        if (typeof window.addtocart === 'function') {
            window.addtocart();
        }
    }
    
    // ✅ TAMBAHKAN FUNCTION INI
    function updatePagination(paginationHtml) {
        const paginationContainer = document.getElementById('pagination-container');
        paginationContainer.innerHTML = paginationHtml;
        attachPaginationListeners();
    }
    
    // ✅ TAMBAHKAN FUNCTION INI
    function attachPaginationListeners() {
        const paginationLinks = document.querySelectorAll('#pagination-container a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', handlePaginationClick);
        });
    }
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(event) {
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get('page') || '1';
        const url = `{{ route('product.get') }}?page=${page}`;
        loadProducts(url);
    });
    
    // ✅ PANGGIL FUNCTION INI SAAT PERTAMA KALI LOAD
    attachPaginationListeners();
});
</script>