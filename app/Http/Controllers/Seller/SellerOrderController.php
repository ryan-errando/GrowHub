<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerOrderController
{
    public function sellerProductOrders(Request $request)
    {
        // Get seller's shop
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        $query = Order::where('shop_id', $shop->id)
            ->where('type', 'product')
            ->with('orderItems.product');

        switch ($request->sort) {
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_asc':
                $query->withSum('orderItems as total_price', DB::raw('price * quantity'))
                    ->orderBy('total_price', 'asc');
                break;
            case 'price_desc':
                $query->withSum('orderItems as total_price', DB::raw('price * quantity'))
                    ->orderBy('total_price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate(3)->withQueryString();
        return view('seller.sellerOrderProducts', compact('orders'));
    }

    public function sellerServiceOrders(Request $request)
    {
        // Get seller's shop
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        $query = Order::where('shop_id', $shop->id)
            ->where('type', 'service')
            ->with('serviceOrderItems.service');


        switch ($request->sort) {
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_asc':
                $query->withSum('serviceOrderItems as total_price', DB::raw('price * quantity'))
                    ->orderBy('total_price', 'asc');
                break;
            case 'price_desc':
                $query->withSum('serviceOrderItems as total_price', DB::raw('price * quantity'))
                    ->orderBy('total_price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate(3)->withQueryString();
        return view('seller.sellerOrderServices', compact('orders'));
    }

    public function updateProductOrderStatus(Request $request, $orderId)
    {
        // Get the seller's shop first
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        // Then find the order that belongs to this shop
        $order = Order::where('id', $orderId)
            ->where('shop_id', $shop->id)
            ->firstOrFail();

        if ($request->status === 'completed' || $request->status === 'cancelled') {
            $order->status = $request->status;
            $order->save();

            return redirect()->back()->with('success', 'Order status updated successfully');
        }

        return redirect()->back()->with('error', 'Invalid status update request');
    }

    public function updateServiceOrderStatus(Request $request, $orderId)
    {
        // Get the seller's shop first
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        // Then find the order that belongs to this shop
        $order = Order::where('id', $orderId)
            ->where('shop_id', $shop->id)
            ->where('type', 'service')  // Make sure it's a service order
            ->firstOrFail();

        if ($request->status === 'completed' || $request->status === 'cancelled') {
            $order->status = $request->status;
            $order->save();

            return redirect()->back()->with('success', 'Service order status updated successfully');
        }

        return redirect()->back()->with('error', 'Invalid status update request');
    }

    public function productOrderDetail(Order $order)
    {
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        // Ensure the order belongs to the seller's shop
        if ($order->shop_id !== $shop->id) {
            abort(403);
        }

        return view('seller.orderProductDetail', compact('order'));
    }

    public function serviceOrderDetail(Order $order)
    {
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        // Ensure the order belongs to the seller's shop
        if ($order->shop_id !== $shop->id) {
            abort(403);
        }

        return view('seller.orderServiceDetail', compact('order'));
    }
}
