<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile()
    {
        $products = Product::all();
        dd($products);
    }
}
