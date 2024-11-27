<?php

namespace App\Http\Controllers\User;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController
{
    public function index()
    {
        $services = Service::with('shop')->paginate(9);
        return view('user.service', compact('services'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $services = Service::with('shop')
                          ->where('name', 'like', "%{$search}%")
                          ->paginate(9);
        
        return view('user.service', compact('services', 'search'));
    }

    public function detail($id)
    {
        $service = Service::with('shop')->findOrFail($id);
        return view('user.serviceDetail', compact('service'));
    }
}
