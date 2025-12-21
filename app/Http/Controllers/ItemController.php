<?php

namespace App\Http\Controllers;

use App\Models\lostfound;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // LIST ITEM
    public function index()
    {
        $items = lostfound::latest()->paginate(9);
        return view('items.list_item', compact('items'));
    }

    // DETAIL ITEM
    public function show($id)
    {
        $item = lostfound::findOrFail($id);
    return view('items.show_item', compact('item'));
    }

    public function klaim($id)
{
    $item = LostFound::findOrFail($id);

    if ($item->status === 'diklaim') {
        return response()->json([
            'status' => 'error',
            'message' => 'Item sudah diklaim.'
        ], 400);
    }

    $item->status = 'diklaim';
    $item->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Item berhasil diklaim.'
    ]);
}



}
