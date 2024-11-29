<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController
{
    public function index()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        // Update basic info
        $user->name = $request->name;
        $user->address = $request->address;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }
}
