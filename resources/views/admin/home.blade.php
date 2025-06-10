<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-5" x-data="{'isModalOpen': false, page: 'dp'}" x-on:keydown.escape="isModalOpen=false">
        <section class="border-b border-gray-200 mb-10 flex px-2">
            <div class="flex gap-20">
                <button @click="page = 'km'" class="nav-tab px-8 py-4 text-sm font-medium hover:text-gray-800 hover:border-none text-[#ff9a00] border-b-2 border-[#ff9a00] bg-white cursor-pointer">
                Katalog Menu
                </button>
                <button @click="page = 'dp'" class="nav-tab px-8 py-4 text-sm font-medium text-gray-600 hover:border-none hover:text-gray-800 cursor-pointer">
                Pesanan
                </button>
                <button @click="page = 'dr'" class="nav-tab px-8 py-4 text-sm font-medium text-gray-600 hover:border-none hover:text-gray-800 cursor-pointer">
                Reservasi
                </button>
            </div>
        </section>
        


        <section>
            <div x-show="page === 'km'" x-cloak>
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 px-2">Katalog Menu</h2>
                    <div class="w-1/2 float-right flex justify-end " @click="isModalOpen = 'add'">
                        <button class="bg-[#ff9a00] hover:bg-[#ff6a00] text-white px-5 py-2.5 rounded-md font-medium transition-colors cursor-pointer duration-300">
                            Tambah Menu
                        </button>
                    </div>
                </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-5 lg:px-0 sm:px-0">
                <!-- Product 1 -->
                @foreach ($products as $product)
            <div class="overflow-hidden rounded-lg bg-gray-50 p-3">
                <img src="{{ asset('storage/product/'. $product->imgname) }}" alt="Rendang Daging Sapi" class="rounded-[6px] w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">{{ $product->nama }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $product->deskripsi }}</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp.{{ $product->harga }}</p>
                    <div>
                        <button class="w-1/2 border border-[#ff9a00] rounded-full py-2 px-4 hover:text-white hover:bg-[#ff9a00] cursor-pointer duration-300">
                            Edit
                        </button>
                        
                        <button class="w-1/2 border border-[#ff9a00] rounded-full float-right py-2 px-4 hover:text-white hover:bg-[#ff9a00] cursor-pointer duration-300">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

            {{-- Page Pesanan --}}
            <div x-show="page === 'dp'" class="">
                <div class="">

                </div>

                <div class="">

                </div>

                <table>
                    <thead>
                        <tr class="">
                            <th scope="col" class="space-x-3">
                                ID
                            </th>
                            <th scope="col">
                                Nama Pelanggan
                            </th>
                            <th scope="col">
                                Tanggal
                            </th>
                            <th scope="col">
                                Total
                            </th>
                            <th scope="col">
                                Status
                            </th>
                            <th scope="col">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>#id</td>
                            <td>Mas Amba</td>
                            <td>2025</td>
                            <td>350000</td>
                            <td>status</td>
                            <td>aksi</td>
                        </tr>
                    </tbody>
                </table>
            </div>













        </section>
        
        
        
        
        
        
        
        
        
        
        {{-- MODAL CRUD --}}
        <div
            class="fixed inset-0 flex items-center justify-center z-9999 backdrop-blur-sm"
            role="dialog"
            tabindex="-1"
            x-show="isModalOpen === 'add'"
            x-cloak
            x-transition>
        <div class="bg-white m-auto border rounded-[0.5em] p-6 w-full max-w-md mx-4" @click.outside="isModalOpen = false">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-lg">Tambah Menu Baru</h3>
                <button aria-label="Close" class="cursor-pointer" x-on:click="isModalOpen=false">
                    <i class='bx bx-x text-3xl'></i>
                </button>
            </div>
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Nama Menu</label>
                        <input type="text" class="w-full border rounded px-3 py-2" placeholder="Masukkan nama menu" name="nama" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Harga (Rp)</label>
                        <input type="number" class="w-full border rounded px-3 py-2" placeholder="Masukkan harga" name="harga" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Deskripsi</label>
                        <textarea class="w-full border rounded px-3 py-2" placeholder="Masukkan deskripsi" rows="3" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Gambar</label>
                        <input type="file" class="w-full border rounded px-3 py-2" name="imgname" required>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button type="button" @click="isModalOpen=false" class="px-4 py-2 bg-gray-200 rounded cursor-pointer">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-[#ff9a00] text-white rounded cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="overlay" x-show="isModalOpen" x-cloak></div>
    </div>
</x-layout>