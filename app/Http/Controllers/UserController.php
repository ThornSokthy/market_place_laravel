<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function edit()
    {
        $user = auth()->user();

        $address = $user->addresses()->where('is_default', true)->first() ?? new Address();

        return view('profile.edit', [
            'user' => $user,
            'address' => $address
        ]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $userData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Validate address data
        $addressData = $request->validate([
            'street' => 'nullable|string|max:255',
            'commune' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'is_default' => 'boolean',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads/profiles', $filename, 'public');
            $userData['profile_picture'] = Storage::url($path);
        }
        $user->update($userData);

        if ($request->input('is_default', false)) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->updateOrCreate(
            ['id' => $request->input('address_id')],
            array_merge($addressData, ['user_id' => $user->id])
        );

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully');
    }

}
