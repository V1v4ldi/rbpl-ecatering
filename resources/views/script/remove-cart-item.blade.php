<script>
    function removeitem(){
            $('.rm-item').on('click', function() {
                var btn = $(this);
        var itemid = btn.data('itemid');

        $.ajax({
            url: '{{ route("cart.remove") }}',
            type: 'POST',
            data: {
                cart_d_id: itemid,
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
                btn.text('Removed!');
                btn.removeClass('text-[#ff9a00] border-[#ff9a00]')
                .addClass('bg-[#c41704] text-white border-[#c41704]');
                setTimeout(function() {
                    btn.text('Add to Cart');
                    btn.removeClass('bg-[#c41704] text-white border-[#c41704]')
                    .addClass('text-[#ff9a00] border-[#ff9a00]');
                }, 2000);
                btn.closest('.bg-white').remove();
                getcart();
            },
            error: function(xhr) {
                console.log('AJAX Error:', xhr.responseText);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal Menghapus Item!',
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
    }
</script>