@extends('layout.index')
@section('productview')
<main class="w-3/4 p-8">
    <h2 class="text-3xl font-bold mb-4">View Products</h2>
    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-2 px-4">Product Name</th>
                <th class="py-2 px-4">Price</th>
                <th class="py-2 px-4">Category</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="py-2 px-4">Sample Product</td>
                <td class="py-2 px-4">$50</td>
                <td class="py-2 px-4">Electronics</td>
                <td class="py-2 px-4">
                    <button class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                    <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                </td>
            </tr>
            <!-- Repeat rows for more products -->
        </tbody>
    </table>
</main>

@endsection