<nav class="lg:flex h-[80px] w-screen top-0 bg-white z-9999 fixed hidden">
    <div class="w-1/2 flex items-center pb-[10px] pl-[24px]">
        <a href="{{ route('home') }}" class="space-x-3 flex items-center mr-[24px]">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" class="h-[50px]">
            <span class="pb-[5px] text-3xl">E-Catering</span>
        </a>
        <div class="flex h-[52px] pt-[13px]">
                <a href="{{ route('home') }}" class="text-center w-[96px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] cursor-pointer {{ request()->is('home') ? 'text-[#ff9a00] border-[#ff9a00]' : 'border-transparent'}}">Beranda</a>
                <a href="{{ route('order') }}" class="text-center w-[96px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] cursor-pointer {{ request()->is('order') ? 'text-[#ff9a00] border-[#ff9a00]' : 'border-transparent'}}">Pesan</a>
        </div>
    </div>
    <div class="w-1/2 float-right flex items-center justify-end pb-[10px] pr-[24px] gap-[20px]">
        <a href="{{ route('checkout') }}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-cart'></i>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                <i class='text-3xl bx bx-log-out'></i>
            </button>
        </form>
        <a href="{{ route('cust.profile') }}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-user-circle'></i>
        </a>
    </div>
</nav>

<nav class="fixed justify-around items-center bottom-0 w-screen bg-gray-50 lg:hidden flex h-[80px] z-999 rounded-t-[15px]">
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-10 h-10 {{ request()->routeIs('home') ? 'text-[#FFA900]' : ''}}">
            <i class="text-3xl bx bx-home">
            </i>
            <span class="text-xs mt-1">Beranda</span>
        </a>
        <a href="{{ route('checkout') }}" 
            class="flex flex-col items-center justify-center w-10 h-10 {{ request()->routeIs('checkout') ? 'text-[#FFA900]' : ''}}">
            <i class="text-3xl bx bx-cart"></i>
            <span class="text-xs">Checkout</span>
        </a>
        <a href="{{ route('order') }}" 
            class="flex flex-col items-center justify-center w-10 h-10 {{ request()->routeIs('order') ? 'text-[#FFA900]' : ''}}">
            <i class="text-3xl bx bxs-shopping-bag"></i>
            <span class="text-xs">Pesan</span>
        </a>
        <a href="{{ route('cust.profile') }}" 
            class="flex flex-col items-center justify-center w-10 h-10 {{ request()->routeIs('cust.profile') ? 'text-[#FFA900]' : ''}}">
            <i class="text-3xl bx bx-user-circle"></i>
            <span class="text-xs">Profile</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="flex flex-col items-center justify-center w-10 h-10">
            @csrf
            <button type="submit" class="flex flex-col items-center justify-center cursor-pointer">
                <i class='text-3xl bx bx-log-out'></i>
                <span class="text-xs">Logout</span>
            </button>
        </form>
</nav>