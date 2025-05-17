<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="max-w-6xl mx-auto px-4 py-12">
        
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Pilihan Produk Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Rendang.jpg') }}" alt="Rendang Daging Sapi" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Rendang Daging Sapi</h3>
                    <p class="text-sm text-gray-600 mt-1">Rendang daging sapi khas Indonesia, kaya rempah dan lezat.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 20.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Ayam Bakar.jpg') }}" alt="Ayam Bakar" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Ayam Bakar</h3>
                    <p class="text-sm text-gray-600 mt-1">Ayam bakar dengan bumbu khas, nikmat dan menggugah selera.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 18.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Ayam Kecap.jpg') }}" alt="Ayam Kecap" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Ayam Kecap</h3>
                    <p class="text-sm text-gray-600 mt-1">Ayam dengan saus kecap manis yang gurih dan harum.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 17.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Ayam Balado.jpg') }}" alt="Ayam Balado" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Ayam Balado</h3>
                    <p class="text-sm text-gray-600 mt-1">Ayam balado pedas dengan cita rasa khas nusantara.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 19.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Capcay.jpg') }}" alt="Capcay" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Capcay</h3>
                    <p class="text-sm text-gray-600 mt-1">Sayuran segar dimasak dengan kuah gurih yang ringan.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 6.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Acar.jpg') }}" alt="Acar" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Acar</h3>
                    <p class="text-sm text-gray-600 mt-1">Acar sayuran segar dengan rasa manis dan asam.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 4.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Kentang Balado.jpg') }}" alt="Sambal Goreng Kentang" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Kentang Balado</h3>
                    <p class="text-sm text-gray-600 mt-1">Kentang goreng pedas dengan sambal khas Indonesia.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 7.000</p>
                    <a href={{ route('login') }} class="border-[#FF9A00] border rounded-full py-3 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="overflow-hidden rounded-lg bg-white">
                <img src="{{ Vite::asset('resources/images/Mie Kuning.jpg') }}" alt="Mie Kuning Goreng" class="w-full h-56 object-cover">
                <div class="py-4">
                    <h3 class="font-bold text-gray-800 text-lg">Mie Kuning Goreng</h3>
                    <p class="text-sm text-gray-600 mt-1">Mie kuning kenyal, cocok untuk berbagai hidangan.</p>
                    <p class="font-medium text-gray-800 mt-2 mb-3">Rp 5.000</p>
                    <a href={{ route('login') }} class="border border-[#FF9A00] rounded-full py-2 px-4 block text-center hover:bg-orange-50 transition duration-300">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>