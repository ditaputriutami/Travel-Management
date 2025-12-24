<?php

namespace App\Http\Controllers;

use App\Models\AkunAkuntansi;
use App\Models\BiayaOperasional;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Laporan Pendapatan
     */
    public function laporanPendapatan(Request $request): View
    {
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        $pendapatanAkuns = AkunAkuntansi::where('jenis', 'Pendapatan')
            ->with(['orders' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal_sewa', $bulan)
                    ->whereYear('tanggal_sewa', $tahun)
                    ->where('status', '!=', 'dibatalkan');
            }])
            ->get();

        $totalPendapatan = Order::whereMonth('tanggal_sewa', $bulan)
            ->whereYear('tanggal_sewa', $tahun)
            ->where('status', '!=', 'dibatalkan')
            ->sum('total_biaya');

        return view('laporan.pendapatan', compact('pendapatanAkuns', 'totalPendapatan', 'bulan', 'tahun'));
    }

    /**
     * Laporan Laba Rugi
     */
    public function laporanLabaRugi(Request $request): View
    {
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        // Total Pendapatan
        $totalPendapatan = Order::whereMonth('tanggal_sewa', $bulan)
            ->whereYear('tanggal_sewa', $tahun)
            ->where('status', '!=', 'dibatalkan')
            ->sum('total_biaya');

        // Total Beban
        $totalBeban = BiayaOperasional::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('nominal');

        // Laba/Rugi
        $labaRugi = $totalPendapatan - $totalBeban;

        // Breakdown by account
        $pendapatanDetail = AkunAkuntansi::where('jenis', 'Pendapatan')
            ->with(['orders' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal_sewa', $bulan)
                    ->whereYear('tanggal_sewa', $tahun)
                    ->where('status', '!=', 'dibatalkan');
            }])
            ->get();

        $bebanDetail = AkunAkuntansi::where('jenis', 'Beban')
            ->with(['biayaOperasionals' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun);
            }])
            ->get();

        return view('laporan.laba-rugi', compact(
            'totalPendapatan',
            'totalBeban',
            'labaRugi',
            'pendapatanDetail',
            'bebanDetail',
            'bulan',
            'tahun'
        ));
    }

    /**
     * Laporan Neraca
     */
    public function laporanNeraca(Request $request): View
    {
        $tanggalAkhir = $request->query('tanggal', now()->toDateString());

        // Aset
        $asetAkuns = AkunAkuntansi::where('jenis', 'Aset')->get();
        $totalAset = 0;
        foreach ($asetAkuns as $akun) {
            $totalAset += $akun->getSaldo();
        }

        // Utang
        $utangAkuns = AkunAkuntansi::where('jenis', 'Utang')->get();
        $totalUtang = 0;
        foreach ($utangAkuns as $akun) {
            $totalUtang += $akun->getSaldo();
        }

        // Modal
        $modalAkuns = AkunAkuntansi::where('jenis', 'Modal')->get();
        $totalModal = 0;
        foreach ($modalAkuns as $akun) {
            $totalModal += $akun->getSaldo();
        }

        // Laba/Rugi tahun ini
        $labaRugi = 0;
        for ($bulan = 1; $bulan <= now()->month; $bulan++) {
            $pendapatan = Order::whereMonth('tanggal_sewa', $bulan)
                ->whereYear('tanggal_sewa', now()->year)
                ->where('status', '!=', 'dibatalkan')
                ->sum('total_biaya');

            $beban = BiayaOperasional::whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $bulan)
                ->sum('nominal');

            $labaRugi += ($pendapatan - $beban);
        }

        return view('laporan.neraca', compact(
            'asetAkuns',
            'totalAset',
            'utangAkuns',
            'totalUtang',
            'modalAkuns',
            'totalModal',
            'labaRugi',
            'tanggalAkhir'
        ));
    }

    /**
     * Laporan Perubahan Modal
     */
    public function laporanPerubahanModal(Request $request): View
    {
        $tahun = $request->query('tahun', now()->year);

        $modalAwal = AkunAkuntansi::where('jenis', 'Modal')->get();
        $totalModalAwal = 0;
        foreach ($modalAwal as $akun) {
            $totalModalAwal += $akun->getSaldo();
        }

        // Calculate profit from start of year
        $labaRugiTahun = 0;
        for ($bulan = 1; $bulan <= now()->month; $bulan++) {
            $pendapatan = Order::whereMonth('tanggal_sewa', $bulan)
                ->whereYear('tanggal_sewa', $tahun)
                ->where('status', '!=', 'dibatalkan')
                ->sum('total_biaya');

            $beban = BiayaOperasional::whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $bulan)
                ->sum('nominal');

            $labaRugiTahun += ($pendapatan - $beban);
        }

        $totalModalAkhir = $totalModalAwal + $labaRugiTahun;

        return view('laporan.perubahan-modal', compact(
            'totalModalAwal',
            'labaRugiTahun',
            'totalModalAkhir',
            'tahun'
        ));
    }

    /**
     * Index of all reports
     */
    public function index(): View
    {
        return view('laporan.index');
    }
}
