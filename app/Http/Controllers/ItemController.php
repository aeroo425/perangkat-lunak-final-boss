<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Tampilkan daftar item
    public function index()
    {
        $items = Item::all();
        return view('items.list_item', compact('items'));
    }

    // Tampilkan detail item berdasarkan ID
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show_item', compact('item'));
    }
}
