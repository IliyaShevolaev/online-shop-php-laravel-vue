<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function filter(Request $request) {
        $filterOpen = $request->input('filter');

        if ($filterOpen) {
            $orders = Order::where('status', 'true')->get();
        } else {
            $orders = Order::where('status', 'false')->get();
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function close(Order $order) 
    {
        $order->status = !$order->status;
        $order->save();

        return redirect()->route('orders.index');
    }
}
