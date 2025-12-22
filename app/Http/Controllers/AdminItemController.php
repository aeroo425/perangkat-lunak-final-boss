<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = LostFound::latest()->get();
        return view('admin.items.index', compact('items'));
    }

    public function edit($id)
    {
        $item = LostFound::findOrFail($id);
        return view('admin.items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = LostFound::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item diperbarui');
    }

    public function destroy($id)
    {
        LostFound::findOrFail($id)->delete();
        return back()->with('success', 'Item dihapus');
    }
}
