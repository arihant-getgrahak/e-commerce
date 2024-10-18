<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

</head>

<body class="bg-gray-100">
    <header>This is header</header>
    <div class="flex">
        <aside class="w-1/4 bg-gray-800 text-white h-screen p-5">
            <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="#" class="hover:text-gray-400">Dashboard</a>
                    </li>
                    <li class="mb-3">
                        <a href="add" class="hover:text-gray-400">Add Product</a>
                    </li>
                    <li class="mb-3">
                        <a href="view" class="hover:text-gray-400">View Products</a>
                    </li>
                    <li class="mb-3">
                        <a href="category" class="hover:text-gray-400">Add Category</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="w-3/4 p-8">
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
        </main>
    </div>
    <footer>This is footer</footer>
</body>

</html>