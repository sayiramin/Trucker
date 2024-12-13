<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pickup_address' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'pickup_address' => $validated['pickup_address'],
            'delivery_address' => $validated['delivery_address'],
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function index()
    {
        $orders = Auth::user()->orders; // Assuming a `hasMany` relationship
        return response()->json(['orders' => $orders], 200);
    }

    public function show($id)
    {
        // Find the order by ID that belongs to the authenticated user
        $order = Auth::user()->orders()->find($id);

        // If the order doesn't exist or doesn't belong to the user, return an error
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Return the order as JSON
        return response()->json(['order' => $order], 200);
    }
}
