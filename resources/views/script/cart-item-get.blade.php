<script>
        window.getcart = function(){
                $.ajax({
                    url: '{{ route("cart.get") }}',
                    type: 'GET',
                    dataType:'json',
                    success: function(response){
                        if(document.querySelector('#ordercontainer')){
                        rendercart(response);
                        removeitem()
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
    window.addEventListener('load', function() {
        getcart();
    });
</script>