@extends('layouts.main') @section('title', 'Dashboard') @section('content')
<div class="container mx-auto mt-4">
    <div class="flex flex-col">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-md shadow-md p-4">
                <h3 class="text-gray-800 font-bold mb-2">Users</h3>
                <h1 class="text-2xl font-bold text-blue-500">
                    {{ $data["userCount"] }}
                </h1>
            </div>

            <div class="bg-white rounded-md shadow-md p-4">
                <h3 class="text-gray-800 font-bold mb-2">Products</h3>
                <h1 class="text-2xl font-bold text-green-500">
                    {{ $data["productCount"] }}
                </h1>
            </div>

            <div class="bg-white rounded-md shadow-md p-4">
                <h3 class="text-gray-800 font-bold mb-2">Order</h3>
                <h1 class="text-2xl font-bold text-orange-500">
                    {{ $data["orderCount"] }}
                </h1>
            </div>

            <div class="bg-white rounded-md shadow-md p-4">
                <h3 class="text-gray-800 font-bold mb-2">Supplier</h3>
                <h1 class="text-2xl font-bold text-red-500">
                    {{ $data["supplierCount"] }}
                </h1>
            </div>
        </div>

        <div class="mt-4">
            <h3 class="text-gray-800 font-bold mb-2">Recent Orders</h3>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Order ID</th>
                        <th class="px-4 py-2 text-left">Customer</th>
                        <th class="px-4 py-2 text-left">Total</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['recentOrders'] as $order)
                    <tr>
                        <td class="px-4 py-2">{{ $order->id }}</td>
                        <td class="px-4 py-2">{{ $order->customer_name }}</td>
                        <td class="px-4 py-2">{{ $order->total }}</td>
                        <td class="px-4 py-2">{{ $order->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
