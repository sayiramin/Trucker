@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen p-5">
        <div class="max-w-screen-xl mx-auto">

            <!-- Dashboard Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <input
                    type="text"
                    placeholder="Search for order ID, user, etc."
                    class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-64"
                />
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-gray-600">Active Orders</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $activeOrders }}</h3>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-gray-600">Searching</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $searchingOrders }}</h3>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-gray-600">On-Transit</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $onTransitOrders }}</h3>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-gray-600">Delivered</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $deliveredOrders }}</h3>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">Orders</h2>
                    <button
                        class="bg-purple-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-purple-800"
                    >
                        Create a Shipment
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Order ID</th>
                            <th scope="col" class="px-6 py-3">User</th>
                            <th scope="col" class="px-6 py-3">Pickup From</th>
                            <th scope="col" class="px-6 py-3">Delivery To</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">ETA</th>
                            <th scope="col" class="px-6 py-3">Created On</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $order->id }}</td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $order->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                                </td>
                                <td class="px-6 py-4">{{ $order->pickup_address }}</td>
                                <td class="px-6 py-4">{{ $order->delivery_address }}</td>
                                <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-lg
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                        "
                                >
                                    {{ ucfirst($order->status) }}
                                </span>
                                </td>
                                <td class="px-6 py-4">2 days</td>
                                <td class="px-6 py-4">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <button
                                            class="text-purple-600 hover:underline text-sm"
                                        >
                                            Details
                                        </button>
                                        <button
                                            class="text-red-600 hover:underline text-sm"
                                        >
                                            Cancel
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4">
                    {{ $orders->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
@endsection
