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

    // ===========================
    // DASHBOARD
    // ===========================
    public function dashboard(Request $request)
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
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->paginate(10);

        return view('dashboard', compact('items'));
    }

    // ===========================
    // LOST ITEMS
    // ===========================
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

    // ===========================
    // FOUND ITEMS (UPDATED)
    // ===========================
    public function foundItems(Request $request)
    {
        $query = LostFound::with('user')
            ->where('status', 'ditemukan')
            ->latest();

        // Search
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

    // ===========================
    // LIST ITEMS (NEW)
    // ===========================
    public function listItems()
    {
        $items = LostFound::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('list-items.index', compact('items'));
    }

    // ===========================
    // MY REPORTS
    // ===========================
    public function myReports(Request $request)
    {
        $userId = Auth::id();

        $query = LostFound::where('user_id', $userId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('my-reports.index', compact('items'));
    }

    // ===========================
    // FORM CREATE
    // ===========================
    public function createLost()
    {
        return view('lost-items.create');
    }

    public function createFound()
    {
        return view('found-items.create');
    }

    // ===========================
    // STORE DATA
    // ===========================
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

        // Upload Foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['foto'] = 'uploads/' . $filename;
        }

        LostFound::create($validated);

        return redirect()
            ->route($validated['status'] === 'hilang' ? 'lost-items.index' : 'found-items.index')
            ->with('success', 'Laporan berhasil dibuat!');
    }

    // ===========================
    // SHOW DETAIL
    // ===========================
    public function show($id)
    {
        $item = LostFound::findOrFail($id);
        return view('items.show_item', compact('item'));
    }

    // ===========================
    // EDIT REPORT
    // ===========================
    public function edit($id)
    {
        $item = LostFound::findOrFail($id);

        if ($item->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('items.show_item', compact('item'));
    }

    // ===========================
    // UPDATE REPORT
    // ===========================
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

        // Upload Foto Baru
        if ($request->hasFile('foto')) {

            if ($item->foto && file_exists(public_path($item->foto))) {
                unlink(public_path($item->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['foto'] = 'uploads/' . $filename;
        }

        $item->update($validated);

        return redirect()
            ->route('my-reports.index')
            ->with('success', 'Laporan berhasil diupdate!');
    }

    // ===========================
    // DELETE REPORT
    // ===========================
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
}
