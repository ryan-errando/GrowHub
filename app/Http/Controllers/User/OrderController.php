<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\OrderItem;
use App\Models\ServiceOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController
{
    public function processOrder(Request $request)
    {
        return DB::transaction(function () {
            $cart = Cart::where('user_id', Auth::id())
                ->with(['cartItems.product', 'serviceCartItems.service'])
                ->firstOrFail();

            // Process product items - group by shop_id
            if ($cart->cartItems->isNotEmpty()) {
                // Group cart items by shop_id
                $groupedProducts = $cart->cartItems->groupBy(function ($item) {
                    return $item->product->shop_id;
                });

                // Create order for each shop's items
                foreach ($groupedProducts as $shopId => $items) {
                    $shopTotal = $items->sum(function ($item) {
                        return $item->product->price * $item->quantity;
                    });

                    $order = Order::create([
                        'user_id' => Auth::id(),
                        'shop_id' => $shopId,
                        'type' => 'product',
                        'total_amount' => $shopTotal,
                        'status' => 'processing',
                        'payment_status' => 'pending'
                    ]);

                    foreach ($items as $cartItem) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $cartItem->product_id,
                            'quantity' => $cartItem->quantity,
                            'price' => $cartItem->product->price
                        ]);
                    }
                }

                $cart->cartItems()->delete();
            }

            // Process service items - group by shop_id
            if ($cart->serviceCartItems->isNotEmpty()) {
                // Group service items by shop_id
                $groupedServices = $cart->serviceCartItems->groupBy(function ($item) {
                    return $item->service->shop_id;
                });

                // Create order for each shop's services
                foreach ($groupedServices as $shopId => $items) {
                    $shopTotal = $items->sum(function ($item) {
                        return $item->service->price_per_hour * $item->quantity;
                    });

                    $order = Order::create([
                        'user_id' => Auth::id(),
                        'shop_id' => $shopId,
                        'type' => 'service',
                        'total_amount' => $shopTotal,
                        'status' => 'processing',
                        'payment_status' => 'pending'
                    ]);

                    foreach ($items as $cartItem) {
                        ServiceOrderItem::create([
                            'order_id' => $order->id,
                            'service_id' => $cartItem->service_id,
                            'quantity' => $cartItem->quantity,
                            'price' => $cartItem->service->price_per_hour,
                            'start_date' => $cartItem->start_date
                        ]);
                    }
                }

                $cart->serviceCartItems()->delete();
            }

            // Delete the empty cart
            $cart->delete();

            // Redirect to success page
            return redirect()->route('user.orderSuccess');
        });
    }

    public function productOrders(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
            ->where('type', 'product')  // Only product orders
            ->with(['orderItems.product', 'shop']);

        // Apply sorting for product orders only
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
        return view('user.orderProducts', compact('orders'));
    }

    public function serviceOrders(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
            ->where('type', 'service')  // Only service orders
            ->with(['serviceOrderItems.service', 'shop']);

        // Apply sorting for service orders only
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
        return view('user.orderServices', compact('orders'));
    }

    public function productOrderDetail(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.orderProductDetail', compact('order'));
    }

    public function serviceOrderDetail(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.orderServiceDetail', compact('order'));
    }
}
