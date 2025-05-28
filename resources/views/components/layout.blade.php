<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'E-Catering'}}</title>
    @livewireStyles
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        [x-cloak]{
            display: none;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="https://www.flaticon.com/free-icon/spoon-and-fork-crossed_15417">
</head>

<header>
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
</header>

<body class="{{ $showNav ? 'lg:pt-[80px]' : 'pt-0'}}" >

    <main>
        {{ $slot }}
    </main>
    
</body>
@livewireScripts
</html>