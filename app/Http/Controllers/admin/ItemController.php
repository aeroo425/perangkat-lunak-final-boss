<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostFound;
use Illuminate\Http\Request;

class ItemController extends Controller
{
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

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Item berhasil diperbarui');
    }

    public function destroy($id)
    {
        LostFound::findOrFail($id)->delete();

        return back()->with('success', 'Item berhasil dihapus');
    }
}
