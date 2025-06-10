<script>
    if(document.querySelector('.add-to-cart')){
        window.addEventListener('load', function() {
            $('.add-to-cart').on('click', function() {
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
                btn.text('Added!');
                btn.removeClass('text-[#ff9a00] border-[#ff9a00]')
                   .addClass('bg-[#4CAF50] text-white border-[#4CAF50]');
                   setTimeout(function() {
                    btn.text('Add to Cart');
                    btn.removeClass('bg-[#4CAF50] text-white border-[#4CAF50]')
                       .addClass('text-[#ff9a00] border-[#ff9a00]');
                    }, 2000);
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
    });
};

</script>