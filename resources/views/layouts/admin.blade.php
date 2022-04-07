<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle"> 
        <div class="drawer-content flex flex-col">
          <!-- Navbar -->
          <div class="w-full navbar bg-base-300">
            <div class="flex-none lg:hidden">
              <label for="my-drawer-3" class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
              </label>
            </div> 
            <a href="/admin" class="btn btn-ghost normal-case text-xl">PanierMedia Admin</a>
            <div class="flex-none hidden lg:block">
              <ul class="menu menu-horizontal">
                <!-- Navbar menu content here -->
                <li><a href="/admin/category">Categories</a></li>
                <li><a href="/admin/product">Produits</a></li>
                <li><a href="/admin/extra">extras</a></li>
                <li><a href="/admin/order">commandes</a></li>
                <li><a href="/admin/slider">slider</a></li>
                <li><a href="/admin/list">listes</a></li>
                <li><a href="/admin/settings">réglages</a></li>


                <li class=" border-l border-slate-900">
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket  mr-2"></i>logout</button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
          <!-- Page content here -->
          <div class="w-full md:w-1/2 mx-auto">
            @include('partials.flash-message')
          </div>
          @yield('content')
        </div> 
        <div class="drawer-side">
          <label for="my-drawer-3" class="drawer-overlay"></label> 
          <ul class="menu p-4 overflow-y-auto w-60 md:w-80 bg-base-100">
            <!-- Sidebar content here -->
            <li><a href="/admin/category">Categories</a></li>
            <li><a href="/admin/product">Produits</a></li>
            <li><a href="/admin/extra">extras</a></li>
            <li><a href="/admin/order">commandes</a></li>
            <li><a href="/admin/slider">slider</a></li>
            <li><a href="/admin/list">listes</a></li>
            <li><a href="/admin/settings">réglages</a></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>logout</button>
              </form>
            </li>
          </ul>
          
        </div>
      </div>
</body>
</html>