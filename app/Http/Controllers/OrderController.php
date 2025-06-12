<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seller_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $buyerId = auth()->id();
            $productId = $validated['product_id'];
            $newQuantity = $validated['quantity'];
            $price = $validated['price'];
            $totalAmount = $newQuantity * $price;

            $product = Product::where('id', $productId)
                ->where('seller_id', $validated['seller_id'])
                ->lockForUpdate()
                ->firstOrFail();
            if ($product->quantity < $newQuantity) {
                return redirect()->back()
                    ->with('error', 'Not enough stock available! Only ' . $product->quantity . ' items left.');
            }

            $existingOrder = Order::where('buyer_id', $buyerId)
                ->where('seller_id', $validated['seller_id'])
                ->latest()
                ->first();

            if ($existingOrder) {
                $existingOrderItem = OrderItem::where('order_id', $existingOrder->id)
                    ->where('product_id', $productId)
                    ->first();
                if ($existingOrderItem) {
                    $existingOrderItem->update([
                        'quantity' => $existingOrderItem->quantity + $newQuantity,
                        'price' => $price,
                    ]);
                    $existingOrder->update([
                        'total_amount' => $existingOrder->total_amount + $totalAmount,
                    ]);
                    $product->decrement('quantity', $newQuantity);
                    DB::commit();
                    return redirect()->back()->with('success', 'Product quantity updated in your existing order!');
                }
            }
            $order = $existingOrder ?? Order::create([
                'buyer_id' => $buyerId,
                'seller_id' => $validated['seller_id'],
                'order_date' => now(),
                'total_amount' => $totalAmount,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $newQuantity,
                'price' => $price,
            ]);
            $product->decrement('quantity', $newQuantity);
            DB::commit();
            return redirect()->back()->with('success', $existingOrder ? 'Product added to your existing order!' : 'New order created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your order: ' . $e->getMessage());
        }
    }
}
