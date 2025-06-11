<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);

        $product = Product::create([
            'seller_id' => Auth::id(),
            'title' => $validated['title'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'status' => 'available',
        ]);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $index => $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => Storage::url($path),
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Post created successfully!');

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $product->is_active = false;
        $product->save();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

}
