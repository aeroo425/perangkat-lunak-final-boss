<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostFound;

class DashboardController extends Controller
{
    public function index()
    {
        $items = LostFound::with('user')
                    ->latest()
                    ->get();

        return view('admin.dashboard', compact('items'));
    }
}
