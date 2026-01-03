<?php

namespace App\Http\Controllers;

use App\Models\LostFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LostFoundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ============================================================
        DASHBOARD
    ============================================================ */
    public function dashboard(Request $request)
    {
        $query = LostFound::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
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
        LIST SEMUA ITEM
    ============================================================ */
    public function listItems(Request $request)
    {
        $query = LostFound::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(10);

        return view('list-items.index', compact('items'));
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
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // ✅ FILTER TANGGAL (BUKAN created_at)
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
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
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // ✅ FILTER TANGGAL (BUKAN created_at)
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $items = $query->paginate(10);

        return view('found-items.index', compact('items'));
    }

    /* ============================================================
        MY REPORTS
    ============================================================ */
    public function myReports(Request $request)
    {
        $query = LostFound::where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->paginate(10);

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
        STORE
    ============================================================ */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:primer,sekunder,tersier',
            'deskripsi' => 'required|string',
            'lokasi'    => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'status'    => 'required|in:hilang,ditemukan',
            'foto'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('lost_found', 'public');
        }

        LostFound::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Laporan berhasil dibuat');
    }

    /* ============================================================
        SHOW
    ============================================================ */
    public function show($id)
    {
        $item = LostFound::with('user')->findOrFail($id);
        return view('items.show_item', compact('item'));
    }

    /* ============================================================
        EDIT
    ============================================================ */
    public function edit($id)
    {
        $item = LostFound::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        return view('items.edit', compact('item'));
    }

    /* ============================================================
        UPDATE
    ============================================================ */
    public function update(Request $request, $id)
    {
        $item = LostFound::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:primer,sekunder,tersier',
            'deskripsi' => 'required|string',
            'lokasi'    => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'status'    => 'required|in:hilang,ditemukan',
            'foto'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($item->foto && Storage::disk('public')->exists($item->foto)) {
                Storage::disk('public')->delete($item->foto);
            }
            $validated['foto'] = $request->file('foto')->store('lost_found', 'public');
        }

        $item->update($validated);

        return redirect()->route('my-reports.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    /* ============================================================
        DELETE (ADMIN ONLY)
    ============================================================ */
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $item = LostFound::findOrFail($id);

        if ($item->foto && Storage::disk('public')->exists($item->foto)) {
            Storage::disk('public')->delete($item->foto);
        }

        $item->delete();

        return back()->with('success', 'Item berhasil dihapus');
    }

    /* ============================================================
        SEARCH GLOBAL
    ============================================================ */
    public function search(Request $request)
    {
        $search = $request->search;

        $items = LostFound::with('user')
            ->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('list-items.index', compact('items', 'search'));
    }
}
