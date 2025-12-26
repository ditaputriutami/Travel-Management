@extends('layouts.app')

@section('title', 'Dashboard - Kembang Lestari Travel')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Statistik dan ringkasan bisnis Anda')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Order -->
    <a href="{{ route('orders.index') }}" class="card bg-gradient-to-br from-blue-50 to-cyan-50 border-blue-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 cursor-pointer block">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Order</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Klik untuk melihat semua order →</p>
    </a>

    <!-- Total Pendapatan -->
    <a href="{{ route('laporan.pendapatan') }}" class="card bg-gradient-to-br from-indigo-50 to-blue-50 border-indigo-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 cursor-pointer block">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Pendapatan</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Klik untuk laporan pendapatan →</p>
    </a>

    <!-- Total Keuntungan -->
    <a href="{{ route('laporan.laba-rugi') }}" class="card bg-gradient-to-br from-blue-50 to-indigo-50 border-blue-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 cursor-pointer block">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Keuntungan</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-blue-700 to-indigo-700 bg-clip-text text-transparent mt-2">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Klik untuk laporan laba rugi →</p>
    </a>

    <!-- Total Biaya -->
    <a href="{{ route('biaya-operasional.index') }}" class="card bg-gradient-to-br from-cyan-50 to-teal-50 border-cyan-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 cursor-pointer block">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Biaya</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mt-2">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Klik untuk biaya operasional →</p>
    </a>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="lg:col-span-2 card hover:shadow-2xl transition-all duration-300">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Pendapatan 6 Bulan Terakhir</h3>
        </div>
        <div style="height: 300px;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Revenue vs Cost Pie -->
    <div class="card hover:shadow-2xl transition-all duration-300">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">Pendapatan vs Biaya (Bulan Ini)</h3>
        </div>
        <div style="height: 300px;">
            <canvas id="pieChart"></canvas>
        </div>
    </div>
</div>

<!-- Profit & Loss Chart -->
<div class="card mb-8 hover:shadow-2xl transition-all duration-300">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Grafik Laba Rugi 6 Bulan Terakhir</h3>
    </div>
    <div style="height: 350px;">
        <canvas id="profitLossChart"></canvas>
    </div>
</div>

<!-- Latest Orders and Biaya Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Latest Orders -->
    <div class="card hover:shadow-2xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Order Terbaru</h3>
            </div>
            <a href="{{ route('orders.index') }}" class="text-blue-600 text-sm hover:text-blue-700 font-medium transition-colors">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Pelanggan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Kategori</th>
                        <th class="text-right py-3 px-4 font-semibold text-gray-700">Biaya</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestOrders as $order)
                    <tr class="table-row border-b border-gray-100">
                        <td class="py-3 px-4">{{ $order->nama_pelanggan }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $order->kategori->nama_kategori }}</td>
                        <td class="text-right py-3 px-4 font-medium">Rp {{ number_format($order->total_biaya, 0, ',', '.') }}</td>
                        <td class="text-center py-3 px-4">
                            <span class="badge {{ $order->getStatusBadge() }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Belum ada order</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Latest Operational Costs -->
    <div class="card hover:shadow-2xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">Biaya Operasional Terbaru</h3>
            </div>
            <a href="{{ route('biaya-operasional.index') }}" class="text-cyan-600 text-sm hover:text-cyan-700 font-medium transition-colors">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama Biaya</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Akun</th>
                        <th class="text-right py-3 px-4 font-semibold text-gray-700">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestBiaya as $biaya)
                    <tr class="table-row border-b border-gray-100">
                        <td class="py-3 px-4">{{ $biaya->nama_biaya }}</td>
                        <td class="py-3 px-4 text-gray-600 text-xs">{{ $biaya->akunBeban->nama_akun }}</td>
                        <td class="text-right py-3 px-4 font-medium text-cyan-600">Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-6 text-center text-gray-500">Belum ada biaya operasional</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script id="chartData" type="application/json">
    {
        "revenue": @json($revenueData),
        "profitLoss": @json($profitLossData),
        "revenueVsCost": @json($revenueVsCostData)
    }
</script>
<script>
    // Wait for DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        // Parse data from JSON script tag
        const chartDataElement = document.getElementById('chartData');
        const allData = JSON.parse(chartDataElement.textContent);

        const revenueData = allData.revenue;
        const profitLossData = allData.profitLoss;
        const revenueVsCostData = allData.revenueVsCost;
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const gradientRevenue = revenueCtx.createLinearGradient(0, 0, 0, 300);
        gradientRevenue.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
        gradientRevenue.addColorStop(1, 'rgba(6, 182, 212, 0.1)');

        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.months,
                datasets: [{
                    label: 'Pendapatan',
                    data: revenueData.data,
                    borderColor: '#3b82f6',
                    backgroundColor: gradientRevenue,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointBackgroundColor: '#06b6d4',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointHoverRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: revenueVsCostData.labels,
                datasets: [{
                    data: revenueVsCostData.data,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(6, 182, 212, 0.8)',
                    ],
                    borderColor: ['#3b82f6', '#06b6d4'],
                    borderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });

        // Profit & Loss Chart
        const profitLossCtx = document.getElementById('profitLossChart').getContext('2d');
        new Chart(profitLossCtx, {
            type: 'bar',
            data: {
                labels: profitLossData.months,
                datasets: [{
                        label: 'Pendapatan',
                        data: profitLossData.profit,
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        borderRadius: 8,
                    },
                    {
                        label: 'Biaya',
                        data: profitLossData.loss,
                        backgroundColor: 'rgba(6, 182, 212, 0.8)',
                        borderColor: '#06b6d4',
                        borderWidth: 2,
                        borderRadius: 8,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }); // End DOMContentLoaded
</script>
@endpush