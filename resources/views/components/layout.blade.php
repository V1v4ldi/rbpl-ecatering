<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'E-Catering'}}</title>
    @livewireStyles
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hide spin buttons in Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
        .swal2-container {
        z-index: 10000 !important; /* Pastikan toast berada di atas elemen lain */
        }
        [x-cloak]{
            display: none;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/icon.png') }}">
</head>

<header>
    @php
        $routeName = Route::currentRouteName();
        $showNav = !in_array($routeName, ['login', 'register']);
    @endphp
    @include('script.custom-header')
</header>

<body @class([$showNav ? 'lg:pt-[80px] pb-[40px]' : 'pt-0', 'bg-[#f5f5f5]' => request()->routeIs('adminhome'),])>

    <main>
        {{ $slot }}
    </main>
    
</body>
    @yield('notlogin')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @if (!in_array($routeName, ['login', 'register']))
    @auth
        @if (auth()->user()->role === 'customer')
            @yield('script')
            @include('script.post-cart-script')
        @elseif(auth()->user()->role === 'admin' || 'owner')
            @yield('scriptAO')
        @endif
    @else
        @endauth
    @endif
</html>