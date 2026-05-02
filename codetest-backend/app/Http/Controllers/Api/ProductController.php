<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
{
    $products = Product::all();

    return response()->json([
        'status'  => 'success',
        'message' => 'Products retrieved successfully',
        'data'    => $products
    ], 200);
}

}
