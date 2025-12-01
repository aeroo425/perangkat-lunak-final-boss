<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard'); // pastikan ada file resources/views/dashboard.blade.php
        $user = Auth::user(); // opsional
        return view('dashboard', compact('user'));
    }
}
