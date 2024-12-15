<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Aggregate data for the dashboard stats
        $activeOrders = Order::where('status', '!=', 'delivered')->count();
        $searchingOrders = Order::where('status', 'pending')->count();
        $onTransitOrders = Order::where('status', 'in_progress')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();

        // Fetch paginated orders
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'activeOrders',
            'searchingOrders',
            'onTransitOrders',
            'deliveredOrders',
            'orders'
        ));
    }
}
