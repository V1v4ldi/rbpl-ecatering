<nav class="lg:flex h-[80px] w-screen top-0 bg-white z-99999 fixed hidden">
    <div class="w-1/2 flex items-center pb-[10px] pl-[24px]">
        <a href="{{ route('home') }}" class="space-x-3 flex items-center mr-[24px]">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" class="h-[50px]">
            <span class="pb-[5px] text-3xl">E-Catering</span>
        </a>
        <ul class="flex h-[52px] pt-[13px]">
            <li class="text-center w-[96px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] cursor-pointer {{ request()->is('home') ? 'text-[#ff9a00] border-[#ff9a00]' : 'border-transparent'}}">
                <a href="{{ route('home') }}">Beranda</a></li>
            <li class="text-center w-[96px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] cursor-pointer {{ request()->is('order') ? 'text-[#ff9a00] border-[#ff9a00]' : 'border-transparent'}}">
                <a href="{{ route('order') }}">Pesan</a></li>
        </ul>
    </div>
    <div class="w-1/2 float-right flex items-center justify-end pb-[10px] pr-[24px] gap-[20px]">
        <a href="{{ route('checkout') }}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-cart'></i>
        </a>
        <a href="{{route('logout')}}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-log-out'></i>
        </a>
        <a href="{{ route('cust.profile') }}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-user-circle'></i>
        </a>
    </div>
</nav>

<nav class="fixed justify-around items-center bottom-0 w-screen bg-slate-200 lg:hidden flex h-[60px] z-999 rounded-full">
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-10 h-10">
            <i class="text-3xl bx bx-home
                {{ request()->routeIs('home') ? '-translate-y-8 text-white bg-[#ff9a00] border-6 rounded-full shadow-lg p-2' : '-translate-y-0' }}">
            </i>
            <span class="text-xs mt-1 {{ request()->routeIs('home') ? 'hidden' : '' }}">Beranda</span>
        </a>
        <a href="{{ route('checkout') }}" 
            class="flex flex-col items-center justify-center w-10 h-10">
            <i class="{{ request()->routeIs('checkout') ? '-translate-y-8 text-white bg-[#ff9a00] border-6 rounded-full shadow-lg p-2' : '-translate-y-0' }} text-3xl bx bx-cart"></i>
            <span class="{{ request()->routeIs('checkout') ? 'hidden' : ''}} text-xs">Checkout</span>
        </a>
        <a href="{{ route('order') }}" 
            class="flex flex-col items-center justify-center w-10 h-10">
            <i class="{{ request()->routeIs('order') ? '-translate-y-8 text-white bg-[#ff9a00] border-6 rounded-full shadow-lg p-2' : '-translate-y-0' }} text-3xl bx bxs-bowl-rice"></i>
            <span class="{{ request()->routeIs('order') ? 'hidden' : ''}} text-xs">Pesan</span>
        </a>
        <a href="{{ route('cust.profile') }}" 
            class="flex flex-col items-center justify-center w-10 h-10">
            <i class="{{ request()->routeIs('cust.profile') ? '-translate-y-8 text-white bg-[#ff9a00] border-6 rounded-full shadow-lg p-2' : '-translate-y-0' }} text-3xl bx bx-user-circle"></i>
            <span class="{{ request()->routeIs('cust.profile') ? 'hidden' : ''}} text-xs">Profile</span>
        </a>
        <a href="{{ route('logout') }}" 
            class="flex flex-col items-center justify-center w-10 h-10">
            <i class='text-3xl bx bx-log-out'></i>
            <span class="text-xs">Logout</span>
        </a>
</nav>