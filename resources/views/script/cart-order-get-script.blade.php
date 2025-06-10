<script>
window.addEventListener('load', function(){
    function getorder(){
        $.ajax({
            url:'{{ route("order.get") }}',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                    if(document.querySelector('#ordercontainer')){
                        renderorder(response);
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
                    Swal.fire({
                            icon: 'error',
                            title: 'Gagal Memuat Pesanan!',
                            text: errorMessage,
                            confirmButtonColor: '#ff9a00'
                    });
                }
        });
    }
    getorder();
});
</script>