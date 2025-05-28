{{-- DESKTOP NAVBAR --}}
<nav class="lg:flex h-[80px] w-screen top-0 bg-gray-50 z-999 fixed hidden">
    <div class="w-1/2 flex items-center pb-[10px] pl-[24px]">
        <a href="{{ route('home') }}" class="space-x-3 flex items-center mr-[24px]">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="" class="h-[50px]">
            <span class="pb-[5px] text-3xl">E-Catering</span>
        </a>
    </div>
    <div class="w-1/2 float-right flex items-center justify-end pb-[10px] pr-[24px] gap-[20px]">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                <i class='text-3xl bx bx-log-out'></i>
            </button>
        </form>
        <a href="{{ route('admin.profile') }}" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300">
            <i class='text-3xl bx bx-user-circle'></i>
        </a>
    </div>
</nav>



{{-- MOBILE NAVBAR --}}
<nav class="fixed justify-around items-center bottom-0 w-screen bg-gray-50 lg:hidden flex h-[60px] z-999 rounded-full">

</nav>