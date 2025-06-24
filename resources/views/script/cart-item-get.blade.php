<script>
    window.cartItems = [];
    window.cartLoaded = false;
        window.getcart = function(){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '{{ route("cart.get") }}',
                    type: 'GET',
                    dataType:'json',
                    success: function(response){
                        if(document.querySelector('#containercart')){
                        rendercart(response);
                        removeitem();
                    }

                         // Update global cart items list
                    if (response.items && Array.isArray(response.items)) {
                        window.cartItems = response.items.map(item => item.product_id.toString());
                    } else if (response && Array.isArray(response)) {
                        window.cartItems = response.map(item => item.product_id.toString());
                    }
                    
                    // Update button states if function exists
                    if (typeof updateButtonStates === 'function') {
                        updateButtonStates();
                    }
                    resolve(response);
                    cartLoaded = true;
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
                    reject(xhr);
            }
        });
    });
}

    window.isItemInCart = function(productId) {
        return window.cartItems.includes(productId.toString());
    }

    window.addToCartItems = function(productId) {
        if (!window.cartItems.includes(productId.toString())) {
            window.cartItems.push(productId.toString());
        }
        
        // Update button states after adding
        if (typeof window.updateButtonStates === 'function') {
            window.updateButtonStates();
        }
    }

    window.removeFromCartItems = function(productId) {
        window.cartItems = window.cartItems.filter(id => id !== productId.toString());
        
        // Update button states after removing
        if (typeof window.updateButtonStates === 'function') {
            window.updateButtonStates();
        }
    }

    window.addEventListener('load', function() {
        getcart();
    });
</script>