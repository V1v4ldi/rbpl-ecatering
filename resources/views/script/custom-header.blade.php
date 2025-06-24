@php
        $routeName = Route::currentRouteName();
        $showNav = !in_array($routeName, ['login', 'register']);
    @endphp

    {{-- Tidak tampil di halaman login/register --}}
    @if (!in_array($routeName, ['login', 'register']))
    @auth
        {{-- Jika sudah login --}}
        @if (auth()->user()->role === 'admin')
            <x-navadmin />
        @elseif(auth()->user()->role === 'owner')
            <x-navadmin />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        @elseif (auth()->user()->role === 'customer')
            <x-navcustomer />
        @endif
    @else
        {{-- Untuk guest --}}
        <x-navdefault />
    @endauth
@endif