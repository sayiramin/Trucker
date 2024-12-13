<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
<h1>Welcome to the Admin Dashboard</h1>

<h2>Statistics</h2>
<p>Total Orders: {{ $totalOrders }}</p>
<p>Total Users: {{ $totalUsers }}</p>

<h2>Recent Orders</h2>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($recentOrders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? 'N/A' }}</td>
            <td>{{ $order->product_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
