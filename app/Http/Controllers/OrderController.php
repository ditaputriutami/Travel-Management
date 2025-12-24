<?php

namespace App\Http\Controllers;

use App\Models\AkunAkuntansi;
use App\Models\KategoriTransport;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::with('kategori', 'akunPendapatan')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = KategoriTransport::all();
        $akunPendapatan = AkunAkuntansi::where('jenis', 'Pendapatan')->get();
        return view('orders.create', compact('kategoris', 'akunPendapatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_transports,id',
            'akun_pendapatan_id' => 'required|exists:akun_akuntansis,id',
            'nama_pelanggan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'tanggal_sewa' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_sewa',
            'total_biaya' => 'required|numeric|min:0',
            'uang_muka' => 'required|numeric|min:0|max:' . $request->total_biaya,
            'denda' => 'nullable|numeric|min:0',
            'jaminan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('jaminan')) {
            $validated['jaminan'] = $request->file('jaminan')->store('jaminan', 'public');
        }

        Order::create($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        $order->load('kategori', 'akunPendapatan');
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        $kategoris = KategoriTransport::all();
        $akunPendapatan = AkunAkuntansi::where('jenis', 'Pendapatan')->get();
        return view('orders.edit', compact('order', 'kategoris', 'akunPendapatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_transports,id',
            'akun_pendapatan_id' => 'required|exists:akun_akuntansis,id',
            'nama_pelanggan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'tanggal_sewa' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_sewa',
            'total_biaya' => 'required|numeric|min:0',
            'uang_muka' => 'required|numeric|min:0|max:' . $request->total_biaya,
            'denda' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,aktif,selesai,dibatalkan',
            'jaminan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('jaminan')) {
            if ($order->jaminan) {
                Storage::disk('public')->delete($order->jaminan);
            }
            $validated['jaminan'] = $request->file('jaminan')->store('jaminan', 'public');
        }

        $order->update($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        if ($order->jaminan) {
            Storage::disk('public')->delete($order->jaminan);
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil dihapus.');
    }
}
