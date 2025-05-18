<nav class="fixed top-0 h-[80px] w-screen z-999999 bg-white lg:flex hidden">
    <div class="w-full flex px-[24px]">
        <a href="{{ route('homepage') }}" class="space-x-3 flex items-center">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" class="h-[50px]">
            <span class="self-center whitespace-nowrap text-3xl">E-Catering</span>
        </a>
        <div class="w-full flex items-center ml-[35px] pl-[20px] pt-[15px] h-full">
            <ul class="flex justify-center">
                <li>
                    <a href="{{ route('homepage') }}" class="mr-[10px] pb-2 justify-center items-center flex w-[95px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] {{ request()->is('/') ? 'text-[#FFA900] border-[#FFA900]' : 'border-transparent' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{route('catalog')}}" class="pb-2 justify-center items-center flex w-[95px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] {{ request()->is('catalog') ? 'text-[#FFA900] border-[#FFA900]' : 'border-transparent' }}">
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="pb-2 justify-center items-center flex w-[95px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300">
                        Pesan
                    </a>
                </li>
            </ul>
            <div class="flex ml-auto gap-[15px] pb-[15px]">
                <a href="{{ route('login') }}">
                    <button class="border border-[#FFA900] text-[#FFA900] rounded-[10px] w-[160px] h-[36px] cursor-pointer hover:bg-[#FFA900] hover:text-white hover:-translate-y-0.5 transition-all duration-300">
                        <i class='bx bx-lock'></i>
                        Masuk
                    </button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="bg-[#FFA900] rounded-[10px] w-[160px] h-[36px] cursor-pointer text-white hover:bg-transparent hover:text-[#FFA900] hover:border-[#FFA900] border border-[#FFA900] hover:-translate-y-0.5 transition-all duration-300">
                        <i class='bx bxs-user'></i>
                        Daftar
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navbar -->
<nav class="fixed bottom-0 w-full bg-white shadow-md lg:hidden flex justify-around items-center h-[60px] z-50">
    <a href="{{ route('homepage') }}" class="flex flex-col items-center hover:text-[#FFA900] {{ request()->is('/') ? 'text-[#FFA900]' : 'text-gray-600' }}">
        <i class='bx bx-home text-2xl'></i>
        <span class="text-sm">Beranda</span>
    </a>
    <a href="{{ route('catalog') }}" class="flex flex-col items-center hover:text-[#FFA900] {{ request()->is('catalog') ? 'text-[#FFA900]' : 'text-gray-600' }}">
        <i class='bx bx-book text-2xl'></i>
        <span class="text-sm">Katalog</span>
    </a>
    <a href="{{ route('register') }}" class="flex flex-col items-center text-gray-600 hover:text-[#FFA900]">
        <i class='bx bx-cart text-2xl'></i>
        <span class="text-sm">Pesan</span>
    </a>
    <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-600 hover:text-[#FFA900]">
        <i class='bx bx-user text-2xl'></i>
        <span class="text-sm">Masuk</span>
    </a>
</nav>