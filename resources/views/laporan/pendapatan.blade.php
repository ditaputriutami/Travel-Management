@extends('layouts.app')

@section('title', 'Laporan Pendapatan')
@section('page-title', 'Laporan Pendapatan')
@section('page-subtitle', 'Detail laporan pendapatan per akun')

@section('content')
<div class="mb-8">
    <form action="{{ route('laporan.pendapatan') }}" method="GET" class="flex gap-4 items-end">
        <div>
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-input" style="width: 120px;">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('bulan', now()->month) == $m ? 'selected' : '' }}>
                    {{ Carbon\Carbon::createFromFormat('m', $m)->format('F') }}
                    </option>
                    @endfor
            </select>
        </div>
        <div>
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-input" style="width: 120px;">
                @for($y = now()->year - 5; $y <= now()->year + 1; $y++)
                    <option value="{{ $y }}" {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
            </select>
        </div>
        <button type="submit" class="btn-primary">Filter</button>
    </form>
</div>

<div class="card mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-6">Laporan Pendapatan - {{ \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') }} {{ $tahun }}</h3>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Akun Pendapatan</th>
                    <th class="text-right py-4 px-6 font-semibold text-gray-700">Jumlah Order</th>
                    <th class="text-right py-4 px-6 font-semibold text-gray-700">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendapatanAkuns as $akun)
                @php
                $total = $akun->orders->sum('total_biaya');
                @endphp
                @if($total > 0 || $akun->orders->count() > 0)
                <tr class="table-row border-b border-gray-100">
                    <td class="py-4 px-6 font-medium">
                        {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                    </td>
                    <td class="text-right py-4 px-6">{{ $akun->orders->count() }}</td>
                    <td class="text-right py-4 px-6 font-bold text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="3" class="py-6 text-center text-gray-500">Tidak ada data pendapatan untuk periode ini</td>
                </tr>
                @endforelse
                <tr class="border-t-2 border-gray-300 bg-gray-50">
                    <td class="py-4 px-6 font-bold text-gray-800">TOTAL PENDAPATAN</td>
                    <td class="text-right py-4 px-6"></td>
                    <td class="text-right py-4 px-6 font-bold text-2xl text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="flex gap-4">
    <a href="{{ route('laporan.index') }}" class="btn-secondary">← Kembali</a>
    <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>
@endsection