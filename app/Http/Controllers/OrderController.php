<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pickup_address' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'pickup_time' => 'required|date',
            'delivery_time' => 'required|date|after_or_equal:pickup_time',
            'weight' => 'required|numeric|min:0',
            'size' => 'required|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'pickup_address' => $validated['pickup_address'],
            'delivery_address' => $validated['delivery_address'],
            'pickup_time' => $validated['pickup_time'],
            'delivery_time' => $validated['delivery_time'],
            'weight' => $validated['weight'],
            'size' => $validated['size'],
            'status' => 'pending',
        ]);

        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function index()
    {
        $orders = Auth::user()->orders;
        return response()->json(['orders' => $orders], 200);
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json(['order' => $order], 200);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,delivered',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}
