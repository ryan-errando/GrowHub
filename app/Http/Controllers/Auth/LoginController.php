<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:user,seller'
        ]);

        if($request->role == 'user') {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = Seller::where('email', $request->email)->first();
        }

        dd([
            'user found' => $user ? 'Yes' : 'No',
            'email' => $request->email,
            'role' => $request->role,
            'password match' => $user ? Hash::check($request->password, $user->password) : 'No user found'
        ]);

        if($user && Hash::check($request->password, $user->password)) {
            session([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $request->role
            ]);

            if($request->role == 'user') {
                return redirect()->route('user.home');
            } else {
                return redirect()->route('seller.dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }
}