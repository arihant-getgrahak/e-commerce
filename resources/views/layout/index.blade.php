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
    <footer>This is footer</footer>
</body>

</html>