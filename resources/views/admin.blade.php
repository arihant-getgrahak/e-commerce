@extends('layout.index')
@section('dashboard')
<div class="flex">
    <aside class="w-1/4 bg-gray-800 text-white h-screen p-5">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
        <nav>
            <ul>
                <li class="mb-3">
                    <a href="#" class="hover:text-gray-400">Dashboard</a>
                </li>
                <li class="mb-3">
                    <a href="product/add" class="hover:text-gray-400">Add Product</a>
                </li>
                <li class="mb-3">
                    <a href="product/view" class="hover:text-gray-400">View Products</a>
                </li>
                <li class="mb-3">
                    <a href="category" class="hover:text-gray-400">Add Category</a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="w-3/4 p-8">
        <h2 class="text-3xl font-bold mb-4">Welcome, Admin!</h2>
        <p>This is your dashboard.</p>
    </main>
</div>
@stop