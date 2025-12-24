<?php

namespace App\Http\Controllers;

use App\Models\AkunAkuntansi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AkunAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $akuns = AkunAkuntansi::paginate(10);
        return view('akun-akuntansi.index', compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jenis = ['Aset', 'Utang', 'Modal', 'Pendapatan', 'Beban'];
        return view('akun-akuntansi.create', compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_akun' => 'required|string|unique:akun_akuntansis|max:20',
            'nama_akun' => 'required|string|max:255',
            'jenis' => 'required|in:Aset,Utang,Modal,Pendapatan,Beban',
            'deskripsi' => 'nullable|string',
        ]);

        AkunAkuntansi::create($validated);

        return redirect()->route('akun-akuntansi.index')
            ->with('success', 'Akun akuntansi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunAkuntansi $akunAkuntansi): View
    {
        $saldo = $akunAkuntansi->getSaldo();
        $transaksis = $akunAkuntansi->transaksis()->latest()->paginate(10);
        return view('akun-akuntansi.show', compact('akunAkuntansi', 'saldo', 'transaksis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunAkuntansi $akunAkuntansi): View
    {
        $jenis = ['Aset', 'Utang', 'Modal', 'Pendapatan', 'Beban'];
        return view('akun-akuntansi.edit', compact('akunAkuntansi', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunAkuntansi $akunAkuntansi): RedirectResponse
    {
        $validated = $request->validate([
            'kode_akun' => 'required|string|unique:akun_akuntansis,kode_akun,' . $akunAkuntansi->id . '|max:20',
            'nama_akun' => 'required|string|max:255',
            'jenis' => 'required|in:Aset,Utang,Modal,Pendapatan,Beban',
            'deskripsi' => 'nullable|string',
        ]);

        $akunAkuntansi->update($validated);

        return redirect()->route('akun-akuntansi.index')
            ->with('success', 'Akun akuntansi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunAkuntansi $akunAkuntansi): RedirectResponse
    {
        if ($akunAkuntansi->transaksis()->exists() || $akunAkuntansi->orders()->exists() || $akunAkuntansi->biayaOperasionals()->exists()) {
            return redirect()->route('akun-akuntansi.index')
                ->with('error', 'Tidak dapat menghapus akun yang memiliki transaksi.');
        }

        $akunAkuntansi->delete();

        return redirect()->route('akun-akuntansi.index')
            ->with('success', 'Akun akuntansi berhasil dihapus.');
    }
}
