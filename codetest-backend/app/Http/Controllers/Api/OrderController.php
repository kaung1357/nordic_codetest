<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        try {
            return DB::transaction(function () use ($request) {

                $productIds = collect($request->products)->pluck('product_id');
                $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

                foreach ($request->products as $item) {
                    if (!$products->has($item['product_id'])) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Product not found',
                            'errors' => [
                                'product_id' => $item['product_id']
                            ]
                        ], 404);
                    }
                }

                $totalPrice = 0;

                foreach ($request->products as $item) {
                    $product = $products[$item['product_id']];
                    $totalPrice += $product->price * $item['qty'];
                }

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $totalPrice
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Order created successfully',
                    'data' => $order
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }}
