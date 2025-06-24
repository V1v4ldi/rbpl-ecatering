<x-layout>
    <div class="w-full px-4 py-5 lg:max-w-6xl lg:mx-auto" x-data="{ page: 'km', currentProductId: null }" x-on:keydown.escape="closeAllModals()">
        <section class="border-b border-gray-200 mb-10 flex">
            <div class="flex lg:gap-20">
                <button @click="page = 'km'; loadDataForPage('km')" class="text-xs nav-tab px-8 py-4 lg:text-sm font-medium hover:text-gray-800 hover:border-none border-b-2 cursor-pointer" :class="page == 'km' ? 'border-[#ff9a00] text-[#ff9a00]' : 'border-transparent text-gray-600'">
                Katalog Menu
                </button>
                <button @click="page = 'dp'; loadDataForPage('dp')" class="text-xs nav-tab px-8 py-4 lg:text-sm font-medium hover:border-none hover:text-gray-800 cursor-pointer border-b-2" :class="page == 'dp' ? 'border-[#ff9a00] text-[#ff9a00]' : 'border-transparent text-gray-600'">
                Pesanan
                </button>
                <button @click="page = 'dr'; loadDataForPage('dr')" class="text-xs nav-tab px-8 py-4 lg:text-sm font-medium hover:border-none hover:text-gray-800 cursor-pointer border-b-2" :class="page == 'dr' ? 'border-[#ff9a00] text-[#ff9a00]' : 'border-transparent text-gray-600'">
                Reservasi
                </button>
            </div>
        </section>

        <section class="bg-white">
            {{-- Katalog Menu Tab --}}
            <div class="p-4" x-show="page === 'km'" x-cloak>
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 px-2">Katalog Menu</h2>
                    <div class="w-1/2 float-right flex justify-end">
                        <button id="openAddMenuModalBtn" class="bg-[#ff9a00] hover:bg-[#ff6a00] text-white px-5 py-2.5 rounded-md font-medium transition-colors cursor-pointer duration-300">
                            Tambah Menu
                        </button>
                    </div>
                </div>
                <div id="katalogMenuList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-5 lg:px-0 sm:px-0">

                    <p class="col-span-full text-center text-gray-500" id="katalogMenuLoading">Memuat data...</p>
                </div>
                {{-- <div id="pagination-container" class="mb-10">{{ $products->links() }}</div> --}}
            </div>

            {{-- Pesanan Tab --}}
            <div x-show="page === 'dp'" class="bg-white rounded-lg shadow-sm overflow-hidden" x-cloak>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kirim</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pesananList" class="bg-white divide-y divide-gray-200">
                            {{-- Data pesanan akan dimuat di sini --}}
                            <tr><td colspan="6" class="text-center py-4 text-gray-500" id="pesananLoading">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Reservasi Tab --}}
            <div x-show="page === 'dr'" class="bg-white rounded-lg shadow-sm overflow-hidden" x-cloak>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kirim</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="reservasiList" class="bg-white divide-y divide-gray-200">
                            {{-- Data reservasi akan dimuat di sini --}}
                            <tr><td colspan="5" class="text-center py-4 text-gray-500" id="reservasiLoading">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- MODAL TAMBAH/EDIT MENU --}}
        <div id="menuModal" class="fixed inset-0 flex items-center justify-center z-[9999] backdrop-blur-sm" role="dialog" tabindex="-1" style="display: none;" x-cloak>
            <div class="bg-white m-auto border rounded-[0.5em] p-6 w-full max-w-md mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="menuModalTitle" class="font-semibold text-lg">Tambah Menu Baru</h3>
                    <button id="closeMenuModalBtn" aria-label="Close" class="cursor-pointer">
                        <i class='bx bx-x text-3xl'></i>
                    </button>
                </div>
                <form id="menuForm" enctype="multipart/form-data">
                    @csrf {{-- Tetap diperlukan jika route API ada di web.php & tidak stateless --}}
                    <input type="hidden" name="_method" id="menuFormMethod" value="POST">
                    <input type="hidden" name="product_id" id="menuProductId">
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Nama Menu</label>
                        <input type="text" id="menuNama" class="w-full border rounded px-3 py-2" placeholder="Masukkan nama menu" name="nama" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Harga (Rp)</label>
                        <input type="number" id="menuHarga" class="w-full border rounded px-3 py-2" placeholder="Masukkan harga" name="harga" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Deskripsi</label>
                        <textarea id="menuDeskripsi" class="w-full border rounded px-3 py-2" placeholder="Masukkan deskripsi" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Gambar</label>
                        <input type="file" id="menuImgname" class="w-full border rounded px-3 py-2" name="imgname">
                        <small id="menuImgnameHelp" class="text-gray-500">Kosongkan jika tidak ingin mengubah gambar (saat edit).</small>
                        <img id="currentMenuImage" src="" alt="Current Image" class="mt-2 max-h-20" style="display:none;"/>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button type="button" id="cancelMenuModalBtn" class="px-4 py-2 bg-gray-200 rounded cursor-pointer">Batal</button>
                        <button type="submit" id="saveMenuBtn" class="px-4 py-2 bg-[#ff9a00] text-white rounded cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Detail (Contoh untuk Pesanan, bisa dibuat generik atau terpisah) --}}
        <div id="detailModal" class="fixed inset-0 flex items-center justify-center z-[9999] backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white m-auto border rounded-[0.5em] p-6 w-full max-w-lg mx-4">
                 <div class="flex justify-between items-center mb-4">
                    <h3 id="detailModalTitle" class="font-semibold text-lg">Detail</h3>
                    <button id="closeDetailModalBtn" aria-label="Close" class="cursor-pointer"><i class='bx bx-x text-3xl'></i></button>
                </div>
                <div id="detailModalContent" class="text-sm">
                    Memuat detail...
                </div>
                 <div class="flex gap-2 justify-end mt-4">
                    <button type="button" id="closeDetailModalBtnSecondary" class="px-4 py-2 bg-gray-200 rounded cursor-pointer">Tutup</button>
                </div>
            </div>
        </div>

    </div>

@section('scriptAO')
@include('script.admin.admin')
@stop

</x-layout>