@php
        $routeName = Route::currentRouteName();
        $showNav = !in_array($routeName, ['login', 'register']);
    @endphp

    {{-- Tidak tampil di halaman login/register --}}
    @if (!in_array($routeName, ['login', 'register']))
    @auth
        {{-- Jika sudah login --}}
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
            <x-navadmin />
        @elseif (auth()->user()->role === 'customer')
            <x-navcustomer />
        @endif
    @else
        {{-- Untuk guest --}}
        <x-navdefault />
    @endauth
@endif