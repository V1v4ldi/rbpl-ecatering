<script>    
window.addtocart = function() {
    $('.add-to-cart').off('click').on('click', function(){
        var btn = $(this);
        var productId = btn.data('productid');
        
        console.log('Button clicked, productId:', productId);
        
        // ✅ DOUBLE CHECK - Pastikan cart sudah load
        if (!window.cartLoaded) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'info',
                title: 'Mohon tunggu, sedang memuat data keranjang...',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            return;
        }
        
        // Check if item already in cart
        if (typeof window.isItemInCart === 'function' && window.isItemInCart(productId)) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: 'Item sudah ada di keranjang!',
                text: 'Silakan ubah jumlah di halaman keranjang',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            return;
        }
        
        // Disable button immediately
        btn.prop('disabled', true).text('Menambahkan...');
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            type: 'POST',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Success:', response);
                
                // Add to cart items list immediately
                if (typeof window.addToCartItems === 'function') {
                    window.addToCartItems(productId);
                }
                
                // Update this specific button immediately
                updateButtonState(btn, productId, true);
                
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message || 'Item berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            },
            error: function(xhr) {
                console.log('AJAX Error:', xhr.responseText);
                
                // Reset button only if error
                updateButtonState(btn, productId, false);
                
                let message = 'Gagal menambahkan Item!';
                if (xhr.status === 409 || xhr.responseJSON?.message?.includes('sudah ada')) {
                    message = 'Item sudah ada di keranjang!';
                    // If server says item exists, update our local state
                    if (typeof window.addToCartItems === 'function') {
                        window.addToCartItems(productId);
                    }
                    updateButtonState(btn, productId, true);
                }
                
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    });
};

function updateButtonState(btn, productId, inCart) {
    if (inCart) {
        btn.prop('disabled', true)
           .removeClass('border-[#ff9a00] text-[#ff9a00] hover:bg-[#ff9a00] hover:text-white add-to-cart')
           .addClass('bg-gray-400 text-white cursor-not-allowed border-gray-400')
           .text('Sudah di Keranjang')
           .removeAttr('data-productid');
    } else {
        btn.prop('disabled', false)
           .removeClass('bg-gray-400 text-white cursor-not-allowed border-gray-400')
           .addClass('border-[#ff9a00] text-[#ff9a00] hover:bg-[#ff9a00] hover:text-white add-to-cart')
           .text('Add to Cart')
           .attr('data-productid', productId);
    }
}

// Function to update all button states
window.updateButtonStates = function() {
    $('.add-to-cart').each(function() {
        var btn = $(this);
        var productId = btn.data('productid');
        var inCart = typeof window.isItemInCart === 'function' ? window.isItemInCart(productId) : false;
        updateButtonState(btn, productId, inCart);
    });
}

// ✅ DISABLE SEMUA BUTTON SAAT AWAL
window.disableAllCartButtons = function() {
    $('.add-to-cart').each(function() {
        $(this).prop('disabled', true).text('Memuat...');
    });
}

// ✅ AUTO INIT DENGAN DISABLED STATE
if(document.querySelector('.add-to-cart')){
    document.addEventListener('DOMContentLoaded', function(){
        // Disable all buttons first
        disableAllCartButtons();
        
        // Attach click handlers
        addtocart();
    });
}
</script>