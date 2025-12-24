<?php

namespace App\Http\Controllers;

use App\Models\AkunAkuntansi;
use App\Models\BiayaOperasional;
use App\Models\KategoriTransport;
use App\Models\Order;
use App\Models\TransaksiAkuntansi;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Total categories
        $totalKategori = KategoriTransport::count();

        // Total orders
        $totalOrder = Order::count();

        // Total revenue
        $totalPendapatan = Order::where('status', '!=', 'dibatalkan')
            ->sum('total_biaya');

        // Total operational costs in last 30 days
        $totalBiaya = BiayaOperasional::where('tanggal', '>=', now()->subDays(30))
            ->sum('nominal');

        // Revenue for last 6 months
        $revenueData = $this->getRevenueByMonth();

        // Profit & Loss for last 6 months
        $profitLossData = $this->getProfitLossByMonth();

        // Revenue vs Cost pie chart
        $revenueVsCostData = $this->getRevenueVsCostData();

        // Latest orders
        $latestOrders = Order::with('kategori', 'akunPendapatan')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Latest operational costs
        $latestBiaya = BiayaOperasional::with('akunBeban')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'totalKategori' => $totalKategori,
            'totalOrder' => $totalOrder,
            'totalPendapatan' => $totalPendapatan,
            'totalBiaya' => $totalBiaya,
            'revenueData' => $revenueData,
            'revenueDataJson' => json_encode($revenueData),
            'profitLossData' => $profitLossData,
            'profitLossDataJson' => json_encode($profitLossData),
            'revenueVsCostData' => $revenueVsCostData,
            'revenueVsCostDataJson' => json_encode($revenueVsCostData),
            'latestOrders' => $latestOrders,
            'latestBiaya' => $latestBiaya,
        ]);
    }

    /**
     * Get revenue data by month for last 6 months
     */
    private function getRevenueByMonth()
    {
        $months = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->format('M Y');

            $revenue = Order::whereMonth('tanggal_sewa', $month->month)
                ->whereYear('tanggal_sewa', $month->year)
                ->where('status', '!=', 'dibatalkan')
                ->sum('total_biaya');

            $data[] = (float)$revenue;
        }

        return [
            'months' => $months,
            'data' => $data,
        ];
    }

    /**
     * Get profit & loss by month for last 6 months
     */
    private function getProfitLossByMonth()
    {
        $months = [];
        $profit = [];
        $loss = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->format('M Y');

            $revenue = Order::whereMonth('tanggal_sewa', $month->month)
                ->whereYear('tanggal_sewa', $month->year)
                ->where('status', '!=', 'dibatalkan')
                ->sum('total_biaya');

            $cost = BiayaOperasional::whereMonth('tanggal', $month->month)
                ->whereYear('tanggal', $month->year)
                ->sum('nominal');

            $profit[] = (float)$revenue;
            $loss[] = (float)$cost;
        }

        return [
            'months' => $months,
            'profit' => $profit,
            'loss' => $loss,
        ];
    }

    /**
     * Get revenue vs cost data for pie chart
     */
    private function getRevenueVsCostData()
    {
        $thisMonth = now();

        $totalRevenue = Order::whereMonth('tanggal_sewa', $thisMonth->month)
            ->whereYear('tanggal_sewa', $thisMonth->year)
            ->where('status', '!=', 'dibatalkan')
            ->sum('total_biaya');

        $totalCost = BiayaOperasional::whereMonth('tanggal', $thisMonth->month)
            ->whereYear('tanggal', $thisMonth->year)
            ->sum('nominal');

        return [
            'labels' => ['Pendapatan', 'Biaya'],
            'data' => [(float)$totalRevenue, (float)$totalCost],
        ];
    }
}
