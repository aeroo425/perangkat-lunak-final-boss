<?php

namespace App\Http\Controllers;

use App\Models\LostFound;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalItems' => LostFound::count(),
            'claimed' => LostFound::where('status','diklaim')->count(),
            'users' => User::count()
        ]);
    }
}
