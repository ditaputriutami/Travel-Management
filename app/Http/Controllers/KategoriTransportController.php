<?php

namespace App\Http\Controllers;

use App\Models\KategoriTransport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kategoris = KategoriTransport::withCount('orders')->paginate(10);
        return view('kategori-transport.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kategori-transport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|unique:kategori_transports|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriTransport::create($validated);

        return redirect()->route('kategori-transport.index')
            ->with('success', 'Kategori transportasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriTransport $kategoriTransport): View
    {
        $kategoriTransport->load('orders');
        return view('kategori-transport.show', compact('kategoriTransport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriTransport $kategoriTransport): View
    {
        return view('kategori-transport.edit', compact('kategoriTransport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriTransport $kategoriTransport): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|unique:kategori_transports,nama_kategori,' . $kategoriTransport->id . '|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriTransport->update($validated);

        return redirect()->route('kategori-transport.index')
            ->with('success', 'Kategori transportasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriTransport $kategoriTransport): RedirectResponse
    {
        if ($kategoriTransport->orders()->exists()) {
            return redirect()->route('kategori-transport.index')
                ->with('error', 'Tidak dapat menghapus kategori yang memiliki order.');
        }

        $kategoriTransport->delete();

        return redirect()->route('kategori-transport.index')
            ->with('success', 'Kategori transportasi berhasil dihapus.');
    }
}
