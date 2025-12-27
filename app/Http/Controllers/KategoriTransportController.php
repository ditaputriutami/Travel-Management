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
            'kode_kendaraan' => 'required|string|unique:kategori_transports|max:255',
            'nomor_polisi' => 'required|string|unique:kategori_transports|max:255',
            'jenis_kendaraan' => 'required|in:mobil,bus',
            'merk_tipe' => 'required|string|max:255',
            'tahun_kendaraan' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kapasitas_penumpang' => 'required|integer|min:1',
            'status_kendaraan' => 'required|in:tersedia,disewa,perawatan',
            'tarif_12_jam' => 'required|numeric|min:0',
            'tarif_24_jam' => 'required|numeric|min:0',
            'tarif_overtime_per_jam' => 'nullable|numeric|min:0',
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
            'kode_kendaraan' => 'required|string|unique:kategori_transports,kode_kendaraan,' . $kategoriTransport->id . '|max:255',
            'nomor_polisi' => 'required|string|unique:kategori_transports,nomor_polisi,' . $kategoriTransport->id . '|max:255',
            'jenis_kendaraan' => 'required|in:mobil,bus',
            'merk_tipe' => 'required|string|max:255',
            'tahun_kendaraan' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kapasitas_penumpang' => 'required|integer|min:1',
            'status_kendaraan' => 'required|in:tersedia,disewa,perawatan',
            'tarif_12_jam' => 'required|numeric|min:0',
            'tarif_24_jam' => 'required|numeric|min:0',
            'tarif_overtime_per_jam' => 'nullable|numeric|min:0',
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
