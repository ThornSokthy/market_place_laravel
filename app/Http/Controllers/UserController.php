<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfile()
    {
        $products = Product::with(['seller', 'images'])
            ->where('is_active', true)
            ->where('seller_id', auth()->id())
            ->get();
        return view('profile.index', ['products' => $products]);
    }
}
