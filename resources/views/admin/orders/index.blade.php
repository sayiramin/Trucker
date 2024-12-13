@extends('layouts.app')

@section('content')
    <h1>All Orders</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th><th>User</th><th>Status</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->status }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
