<nav class="flex fixed top-0 h-[75px] w-screen z-999999 bg-white">
    <div class="w-full flex px-[24px] ">
        <a href="/" class="space-x-3 flex items-center">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" class="h-[50px]">
            <span class="self-center whitespace-nowrap text-3xl">E-Catering</span>
        </a>
        <div class="w-full flex items-center ml-[35px] pl-[20px] h-full">
            <ul class="flex justify-center">
                <li>
                    <a href="/" class="mr-[10px] pb-2 justify-center items-center flex w-[95px] hover:text-[#FFA900] hover:-translate-y-0.5 -transition-all duration-300 border-b-4 rounded-[6px] {{ request()->is('/') ? 'text-[#FFA900] border-[#FFA900]' : 'border-transparent' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="/catalog" class="pb-2 justify-center items-center flex w-[95px] hover:text-[#FFA900] hover:-translate-y-0.5 -transition-all duration-300 border-b-4 rounded-[6px] {{ request()->is('catalog') ? 'text-[#FFA900] border-[#FFA900]' : 'border-transparent' }}">
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="/register" class="pb-2 justify-center items-center flex w-[95px] hover:text-[#FFA900] hover:-translate-y-0.5 -transition-all duration-300">
                        Pesan
                    </a>
                </li>
            </ul>
            <div class="flex ml-auto gap-[15px]">
                <a href="/login">
                    <button class="border border-[#FFA900] text-[#FFA900] rounded-[10px] w-[160px] h-[36px] cursor-pointer hover:bg-[#FFA900] hover:text-white hover:-translate-y-0.5 -transition-all duration-300">
                        <i class='bx bx-lock'></i>
                        Masuk
                    </button>
                </a>
                <a href="/register">
                    <button class="bg-[#FFA900] rounded-[10px] w-[160px] h-[36px] cursor-pointer text-white  hover:bg-transparent hover:text-[#FFA900] hover:border-[#FFA900] border border-[#FFA900] hover:-translate-y-0.5 -transition-all duration-300">
                        <i class='bx bxs-user'></i>
                        Daftar
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>
