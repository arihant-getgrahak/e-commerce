<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif -->

    <!-- @yield("header") -->
    <link rel="stylesheet" href="{{asset('dist/css/tabler.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-flags.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-payments.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-vendors.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/demo.min.css')}}">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .text-red-500 {
            color: red;
        }
    </style>

</head>

<body class="bg-gray-100">
    <!-- <header>This is header</header> -->
    <div>

        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <!-- home -->
                            <li @class(["nav-item", 'active' => Route::currentRouteName() === 'admin'])>
                                <a class="nav-link" href="{{ route('admin') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title"> Home </span>
                                </a>
                            </li>

                            <li @class(["nav-item", "dropdown", 'active' => in_array(Route::currentRouteName(), ['product.add', 'product.view', 'attribute', "brand", "category"])])>
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                            <path d="M12 12l8 -4.5" />
                                            <path d="M12 12l0 9" />
                                            <path d="M12 12l-8 -4.5" />
                                            <path d="M16 5.25l-8 4.5" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Products
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{route("product.add.view")}}">
                                                Add Products
                                            </a>
                                            <a class="dropdown-item" href="{{route("product.view")}}">
                                                All Products
                                            </a>
                                            <a class="dropdown-item" href="{{route("category")}}">
                                                Category
                                            </a>
                                            <a class="dropdown-item" href="{{route("brand")}}">
                                                Brand
                                            </a>
                                            <a class="dropdown-item" href="{{route("attribute")}}">
                                                Attributes
                                            </a>
                                            <a class="dropdown-item" href="{{route("bulk")}}">
                                                Bulk Import
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu-column"></div>
                                </div>
                            </li>

                            <!-- admin order -->
                            <li @class(["nav-item", 'active' => Route::currentRouteName() === 'admin.order'])>
                                <a class="nav-link" href="{{ route('admin.order') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                            <path d="M3 9l4 0" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title"> Orders </span>
                                </a>
                            </li>
                            <!-- admin order -->
                            <li @class(["nav-item", 'active' => Route::currentRouteName() === 'admin.user'])>
                                <a class="nav-link" href="{{ route('admin.user') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title"> Customers </span>
                                </a>
                            </li>

                            <!-- address -->
                            <li @class(["nav-item", "dropdown", 'active' => in_array(Route::currentRouteName(), ['admin.country', 'admin.state', 'admin.city', 'pickupaddress'])])>
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                            <path d="M12 12l8 -4.5" />
                                            <path d="M12 12l0 9" />
                                            <path d="M12 12l-8 -4.5" />
                                            <path d="M16 5.25l-8 4.5" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Address
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{route("admin.country")}}">
                                                Country
                                            </a>
                                            <a class="dropdown-item" href="{{route("admin.state")}}">
                                                State
                                            </a>
                                            <a class="dropdown-item" href="{{route("admin.city")}}">
                                                City
                                            </a>
                                            <a class="dropdown-item" href="{{ route('pickupaddress') }}">
                                                Pickup Address
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            </main>

                            <!-- navigation -->
                            <li @class(["nav-item", 'active' => Route::currentRouteName() === 'admin.navigation'])>
                                <a class="nav-link" href="{{ route('admin.navigation') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-category">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 4h6v6h-6z" />
                                            <path d="M14 4h6v6h-6z" />
                                            <path d="M4 14h6v6h-6z" />
                                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title"> Navigation </span>
                                </a>
                            </li>
                        </ul>
                        <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                            <a class="nav-link" href="{{ route('logout') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M9 12h12l-3 -3" />
                                        <path d="M18 15l3 -3" />
                                    </svg>
                                </span>
                                <span class="nav-link-title"> Logout </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="w-3/4 p-5">
            <main>
                @yield('dashboard')
            </main>
            <main>
                @yield('category')
            </main>
            <main>
                @yield('productadd')
            </main>
            <main>
                @yield('productview')
            </main>
            <main>
                @yield("brand")
            </main>
            <main>
                @yield("attribute")
            </main>
            <main>
                @yield("bulk")
            </main>
            <main>
                @yield("user")
            </main>
            <main>
                @yield("address")
            </main>
            <main>
                @yield("navigation")
            </main>
            <main>
                @yield("specificOrder")
            </main>
            <main>
                @yield("pickupaddress")
            </main>
        </main>
    </div>
    <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Copyright &copy; 2024
                            <a href="#" class="link-secondary">Arihant</a>.
                            All rights reserved.
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="link-secondary" rel="noopener">
                                v1.0.0
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-auto ms-lg-auto">
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('dist/libs/nouislider/dist/nouislider.min.js')}}" defer></script>
    <script src="{{asset('dist/libs/litepicker/dist/litepicker.js')}}" defer></script>
    <script src="{{asset('dist/libs/tom-select/dist/js/tom-select.base.min.js')}}" defer></script>
    <script src="{{asset('dist/js/tabler.min.js')}}" defer></script>
    <script src="{{asset('dist/js/demo.min.js')}}" defer></script>
    <script src="{{asset('dist/libs/list.js/dist/list.min.js')}}" defer></script>
</body>

</html>