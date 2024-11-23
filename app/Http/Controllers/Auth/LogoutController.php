<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}