<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="max-w-6xl mx-auto px-4 py-12">
        
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-15 lg:mb-10">Pilihan Produk Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-5 lg:px-0 sm:px-0">
            <!-- Product -->
                @foreach ($products as $product)
            <div class="overflow-hidden rounded-lg bg-gray-50 p-3">
                <img src="{{ Vite::asset('resources/images/Rendang.jpg') }}" alt="Rendang Daging Sapi" class="rounded-[6px] w-full h-56 object-cover">
                    <div class="py-4">
                        <h3 class="font-bold text-gray-800 text-lg">Rendang Daging Sapi</h3>
                        <p class="text-sm text-gray-600 mt-1">Rendang daging sapi khas Indonesia, kaya rempah dan lezat.</p>
                        <p class="font-medium text-gray-800 mt-2 mb-3">Rp 20.000</p>
                        <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:-translate-y-1 hover:bg-orange-50 transition duration-300">Add to Cart</a>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </div>
</x-layout>