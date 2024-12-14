<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $rules = [
            'role' => 'required|in:user,seller',
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
        ];

        if ($request->role === 'seller') {
            $rules['shop_name'] = 'required|string|max:255';
            $rules['shop_description'] = 'nullable|string';
            $rules['email'] .= '|unique:sellers,email';
        } else {
            $rules['email'] .= '|unique:users,email';
        }

        $request->validate($rules);

        if ($request->role === 'seller') {
            $seller = Seller::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Shop::create([
                'seller_id' => $seller->id,
                'name' => $request->shop_name,
                'description' => $request->shop_description ?? null
            ]);
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address
            ]);
        }

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
