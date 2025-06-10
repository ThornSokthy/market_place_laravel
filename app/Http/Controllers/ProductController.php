<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->where('is_active', 1)->get();
        $latestProducts = Product::with('images')
            ->where('is_active', 1)
            ->latest()
            ->take(5)
            ->get();
        return view('home.index', [
            'products' => $products,
            'latestProducts' => $latestProducts
        ]);
    }
}
