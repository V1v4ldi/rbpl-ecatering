@php
    $routehome = 'admin.home';
    $routeprofile = 'admin.profile';
    if(Auth::guard('owner')->check()) {
        $routehome = 'owner.home';
        $routeprofile = 'owner.profile';
    }
@endphp

{{-- DESKTOP NAVBAR --}}
<nav class="fixed justify-around items-center bottom-0 w-screen bg-gray-50 lg:hidden flex h-[80px] z-999 rounded-t-[15px]">
    <div class="w-1/2 flex items-center pb-[10px] pl-[24px]">
        <a href="{{ route($routehome) }}" class="space-x-3 flex items-center mr-[25px]">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" class="h-[50px]">
            <span class="pb-[5px] text-3xl">E-Catering</span>
        </a>
        <a href="{{ route($routehome) }}" class="pt-1 text-center w-[96px] hover:text-[#FFA900] hover:-translate-y-0.5 transition-all duration-300 border-b-4 rounded-[6px] cursor-pointer {{ request()->routeIs($routehome) ? 'text-[#ff9a00] border-[#ff9a00]' : 'border-transparent'}}">
            Home
        </a>
    </div>
    <div class="w-1/2 float-right flex items-center justify-end pb-[10px] pr-[24px] gap-[20px]">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                <i class='text-3xl bx bx-log-out'></i>
            </button>
        </form>
        <a href="{{ route($routeprofile) }}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-user-circle'></i>
        </a>
    </div>
</nav>



{{-- MOBILE NAVBAR --}}
<nav class="fixed justify-around items-center bottom-0 w-screen bg-gray-50 lg:hidden flex h-[60px] z-999 rounded-full">
        <a href="{{ route($routeprofile) }}" class="flex flex-col items-center justify-center w-10 h-10">
            <i class='text-3xl bx bx-user-circle'></i>
            <span class="text-xs mt-1">Profile</span>
        </a>
        <a href="{{ route($routehome) }}" class="flex flex-col items-center justify-center w-10 h-10 {{ request()->routeIs($routehome) ? 'text-[#FFA900]' : ''}}">
        <i class="text-3xl bx bx-home"></i>
            <span class="text-xs mt-1">Beranda</span>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex flex-col items-center justify-center w-10 h-10 cursor-pointer">
                <i class='text-3xl bx bx-log-out'></i>
                <span class="text-xs mt-1">Logout</span>
            </button>
        </form>
</nav>