<?php

namespace App\Http\Controllers;

use App\Models\LostFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LostFoundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ============================================================
       DASHBOARD - Semua items
    ============================================================ */
    public function dashboard(Request $request)
    {
        $query = LostFound::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->paginate(10);

        return view('dashboard', compact('items'));
    }

    /* ============================================================
       LIST ITEMS GLOBAL (BARU DITAMBAHKAN)
    ============================================================ */
    public function listItems(Request $request)
    {
        $query = LostFound::with('user')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status') && in_array($request->status, ['hilang','ditemukan'])) {
            $query->where('status', $request->status);
        }

        $items = $query->paginate(10);

        return view('list-items', compact('items'));
    }

    /* ============================================================
       LOST ITEMS
    ============================================================ */
    public function lostItems(Request $request)
    {
        $query = LostFound::with('user')
            ->where('status', 'hilang')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(10);

        return view('lost-items.index', compact('items'));
    }

    /* ============================================================
       FOUND ITEMS
    ============================================================ */
    public function foundItems(Request $request)
    {
        $query = LostFound::with('user')
            ->where('status', 'ditemukan')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(10);

        return view('found-items.index', compact('items'));
    }

    /* ============================================================
       REPORT USER SENDIRI
    ============================================================ */
    public function myReports(Request $request)
    {
        $query = LostFound::where('user_id', Auth::id())->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->paginate(10);

        return view('my-reports.index', compact('items'));
    }

    /* ============================================================
       CREATE FORM
    ============================================================ */
    public function createLost()
    {
        return view('lost-items.create');
    }

    public function createFound()
    {
        return view('found-items.create');
    }

    /* ============================================================
       STORE DATA
    ============================================================ */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status' => 'required|in:hilang,ditemukan',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['foto'] = 'uploads/'.$filename;
        }

        LostFound::create($validated);

        return redirect()
            ->route($validated['status'] === 'hilang' ? 'lost-items.index' : 'found-items.index')
            ->with('success', 'Laporan berhasil dibuat!');
    }

    /* ============================================================
       SHOW DETAIL ITEM
    ============================================================ */
    public function show($id)
    {
        $item = LostFound::with('user')->findOrFail($id);
        return view('lost-founds.show', compact('item'));
    }

    /* ============================================================
       EDIT ITEM
    ============================================================ */
    public function edit($id)
    {
        $item = LostFound::findOrFail($id);

        if ($item->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('lost-founds.edit', compact('item'));
    }

    /* ============================================================
       UPDATE ITEM
    ============================================================ */
    public function update(Request $request, $id)
    {
        $item = LostFound::findOrFail($id);

        if ($item->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status' => 'required|in:hilang,ditemukan',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            if ($item->foto && file_exists(public_path($item->foto))) {
                unlink(public_path($item->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['foto'] = 'uploads/'.$filename;
        }

        $item->update($validated);

        return redirect()
            ->route('my-reports.index')
            ->with('success', 'Laporan berhasil diupdate!');
    }

    /* ============================================================
       DELETE ITEM
    ============================================================ */
    public function destroy($id)
    {
        $item = LostFound::findOrFail($id);

        if ($item->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($item->foto && file_exists(public_path($item->foto))) {
            unlink(public_path($item->foto));
        }

        $item->delete();

        return redirect()
            ->route('my-reports.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }

    public function search(Request $request)
{
    $search = $request->input('search');

    $items = LostFound::where('judul', 'like', "%{$search}%")
        ->orWhere('deskripsi', 'like', "%{$search}%")
        ->orWhere('lokasi', 'like', "%{$search}%")
        ->latest()
        ->paginate(12);

    return view('list-items.index', compact('items'));
}

}

