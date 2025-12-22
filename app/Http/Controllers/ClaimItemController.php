<?php

namespace App\Http\Controllers;

use App\Models\LostFound;

class ClaimItemController extends Controller
{
    public function index()
    {
        $items = LostFound::where('status', 'diklaim')
            ->latest()
            ->get();

        return view('claim-items.index', compact('items'));
    }
}
