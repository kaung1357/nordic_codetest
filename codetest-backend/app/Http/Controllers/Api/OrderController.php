<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{



    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $totalPrice = 0;

        foreach ($request->products as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                return response()->json([
                    'message' => "Product not found"
                ], 404);
            }

            $totalPrice += $product->price * $item['qty'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ]);
    }


}
