<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LostFound;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $query = LostFound::query();

    // FILTER STATUS
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // SEARCH JUDUL
    if ($request->filled('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    $items = $query->latest()->get();

    return view('dashboard', compact('items'));
}
}
