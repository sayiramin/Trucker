@extends('layouts.app')

@section('content')
    <h1>Order #{{ $order->id }}</h1>
    <p>Pickup: {{ $order->pickup_address }}</p>
    <p>Delivery: {{ $order->delivery_address }}</p>
    <p>Status: {{ $order->status }}</p>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="status">
            <option value="pending" @selected($order->status=='pending')>Pending</option>
            <option value="in_progress" @selected($order->status=='in_progress')>In Progress</option>
            <option value="delivered" @selected($order->status=='delivered')>Delivered</option>
        </select>
        <button type="submit">Update Status</button>
    </form>

    <hr>

    <form action="{{ route('admin.orders.notify', $order) }}" method="POST">
        @csrf
        <textarea name="message" placeholder="Enter a message to the user"></textarea>
        <button type="submit">Send Message</button>
    </form>
@endsection
