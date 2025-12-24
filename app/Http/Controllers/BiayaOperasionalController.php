<?php

namespace App\Http\Controllers;

use App\Models\AkunAkuntansi;
use App\Models\BiayaOperasional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BiayaOperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $biaya = BiayaOperasional::with('akunBeban')->paginate(10);
        return view('biaya-operasional.index', compact('biaya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $akun = AkunAkuntansi::where('jenis', 'Beban')->get();
        return view('biaya-operasional.create', compact('akun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'akun_beban_id' => 'required|exists:akun_akuntansis,id',
            'keterangan' => 'nullable|string',
        ]);

        BiayaOperasional::create($validated);

        return redirect()->route('biaya-operasional.index')
            ->with('success', 'Biaya operasional berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BiayaOperasional $biayaOperasional): View
    {
        $biayaOperasional->load('akunBeban');
        return view('biaya-operasional.show', compact('biayaOperasional'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BiayaOperasional $biayaOperasional): View
    {
        $akun = AkunAkuntansi::where('jenis', 'Beban')->get();
        return view('biaya-operasional.edit', compact('biayaOperasional', 'akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BiayaOperasional $biayaOperasional): RedirectResponse
    {
        $validated = $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'akun_beban_id' => 'required|exists:akun_akuntansis,id',
            'keterangan' => 'nullable|string',
        ]);

        $biayaOperasional->update($validated);

        return redirect()->route('biaya-operasional.index')
            ->with('success', 'Biaya operasional berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiayaOperasional $biayaOperasional): RedirectResponse
    {
        $biayaOperasional->delete();

        return redirect()->route('biaya-operasional.index')
            ->with('success', 'Biaya operasional berhasil dihapus.');
    }
}
