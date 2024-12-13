<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Example data for the dashboard
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'recentOrders' => $recentOrders,
        ]);
    }
}
