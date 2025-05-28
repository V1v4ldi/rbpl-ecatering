<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-12" x-data="{'page': 'km'}" x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">
        <section class="border-b-4 pb-10">
            <div class="flex gap-20">
                <button class="w-[110px] ">
                    Katalog Menu
                </button>

                <button class="w-[110px] ">
                    Pesanan
                </button>

                <button class="w-[110px] ">
                    Reservasi
                </button>
            </div>
        </section>
        


        <section>
            <div class="mb-5 flex">
            <h2 class="w-1/2">Katalog Menu</h2>
            <div class="w-1/2 float-right flex justify-end" @click="isModalOpen = true">
                <button class="">
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
                    <p class="font-medium text-gray-800 mt-2 mb-3">{{ $product->harga }}</p>
                    <div>
                        <button class="w-1/2 border border-[#ff9a00] rounded-full py-2 px-4">
                        Edit
                        </button>

                        <button class="w-1/2 border border-[#ff9a00] rounded-full float-right py-2 px-4">
                        Hapus
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </section>
        
        
        
        
        
        
        
        
        
        
        {{-- MODAL CRUD --}}
        <div
            class="fixed inset-0 flex items-center justify-center z-9999 backdrop-blur-sm"
            role="dialog"
            tabindex="-1"
            x-show="isModalOpen"
            x-on:click.away="isModalOpen = false"
            x-cloak
            x-transition>
        <div class="bg-white m-auto border rounded-[0.5em] p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-lg">Tambah Menu Baru</h3>
                <button aria-label="Close" x-on:click="isModalOpen=false">
                    <i class='bx bx-x text-3xl'></i>
                </button>
            </div>
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Nama Menu</label>
                        <input type="text" class="w-full border rounded px-3 py-2" placeholder="Masukkan nama menu" name="nama">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Harga (Rp)</label>
                        <input type="number" class="w-full border rounded px-3 py-2" placeholder="Masukkan harga" name="harga">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Deskripsi</label>
                        <textarea class="w-full border rounded px-3 py-2" placeholder="Masukkan deskripsi" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-base mb-2">Gambar</label>
                        <input type="file" class="w-full border rounded px-3 py-2" name="imgname">
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button type="button" @click="isModalOpen=false" class="px-4 py-2 bg-gray-200 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="overlay" x-show="isModalOpen" x-cloak></div>
    </div>
</x-layout>