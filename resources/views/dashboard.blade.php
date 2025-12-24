@extends('layouts.app')

@section('title', 'Dashboard - Kembang Lestari Travel')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Statistik dan ringkasan bisnis Anda')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Kategori -->
    <div class="card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Kategori</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalKategori }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Jenis transportasi</p>
    </div>

    <!-- Total Kendaraan -->
    <div class="card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Order</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrder }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Penyewaan kendaraan</p>
    </div>

    <!-- Total Pendapatan -->
    <div class="card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Pendapatan</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Bulan ini</p>
    </div>

    <!-- Total Biaya -->
    <div class="card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Biaya</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">30 hari terakhir</p>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="lg:col-span-2 card">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Pendapatan 6 Bulan Terakhir</h3>
        <div style="height: 300px;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Revenue vs Cost Pie -->
    <div class="card">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Pendapatan vs Biaya (Bulan Ini)</h3>
        <div style="height: 300px;">
            <canvas id="pieChart"></canvas>
        </div>
    </div>
</div>

<!-- Profit & Loss Chart -->
<div class="card mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-6">Grafik Laba Rugi 6 Bulan Terakhir</h3>
    <div style="height: 350px;">
        <canvas id="profitLossChart"></canvas>
    </div>
</div>

<!-- Latest Orders and Biaya Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Latest Orders -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Order Terbaru</h3>
            <a href="{{ route('orders.index') }}" class="text-blue-600 text-sm hover:text-blue-700">Lihat Semua →</a>
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
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Biaya Operasional Terbaru</h3>
            <a href="{{ route('biaya-operasional.index') }}" class="text-blue-600 text-sm hover:text-blue-700">Lihat Semua →</a>
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
                        <td class="text-right py-3 px-4 font-medium text-orange-600">Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</td>
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
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.months,
                datasets: [{
                    label: 'Pendapatan',
                    data: revenueData.data,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
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
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                    ],
                    borderColor: ['#22c55e', '#ef4444'],
                    borderWidth: 2
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
                        backgroundColor: 'rgba(34, 197, 94, 0.7)',
                        borderColor: '#22c55e',
                        borderWidth: 1
                    },
                    {
                        label: 'Biaya',
                        data: profitLossData.loss,
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: '#ef4444',
                        borderWidth: 1
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