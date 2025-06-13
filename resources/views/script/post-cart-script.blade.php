<script>    
        window.addtocart = function() {
        $('.add-to-cart').off('click').on('click', function(){

            var btn = $(this);
            var productId = btn.data('productid');
            
            $.ajax({
                url: '{{ route("cart.add") }}',
                type: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // SweetAlert Toast
                console.log('Success:', response);
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
                },
                error: function(xhr) {
                    console.log('AJAX Error:', xhr.responseText);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gagal menambahkan Item!',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                }
            });
        });
    };
    if(document.querySelector('.add-to-cart')){
    window.addEventListener('load', function(){
        addtocart();
    });
    };

</script>