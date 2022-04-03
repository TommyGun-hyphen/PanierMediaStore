<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/shopping.js') }}" defer></script>
    <script src="{{ asset('js/utils.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar bg-base-100 sm:flex sm:justify-center">
            <div class="flex-1">
                <a href="/" class="btn btn-ghost normal-case text-xl">PanierMedia</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal p-0 ">
                    <li><a href="/category/desktops">desktops</a></li>
                    <li><a href="/category/laptops">laptops</a></li>
                    <li><a href="/category/accessoires">accessoires</a></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
                </ul>
                
            </div>
        </nav> --}}
        <div class="navbar bg-base-100">
            <div class="navbar-start">
              <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                </label>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="/category/desktops">desktops</a></li>
                    <li><a href="/category/laptops">laptops</a></li>
                    <li><a href="/category/accessoires">accessoires</a></li>
                </ul>
              </div>
              <a href="/" class="btn btn-ghost normal-case text-xl">PanierMedia</a>
            </div>
            <div class="navbar-center hidden lg:flex">
              <ul class="menu menu-horizontal p-0">
                <li><a href="/category/desktops">desktops</a></li>
                <li><a href="/category/laptops">laptops</a></li>
                <li><a href="/category/accessoires">accessoires</a></li>
              </ul>
            </div>
            <a href="/cart" class="btn btn-neutral mr-5"><i class="fa-solid fa-cart-shopping"></i></a>
          </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>