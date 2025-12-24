@extends('layouts.app')

@section('title', 'Laporan Laba Rugi')
@section('page-title', 'Laporan Laba Rugi')
@section('page-subtitle', 'Laporan perbandingan pendapatan dan beban')

@section('content')
<div class="mb-8">
    <form action="{{ route('laporan.laba-rugi') }}" method="GET" class="flex gap-4 items-end">
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
    <h3 class="text-lg font-bold text-gray-800 mb-6 text-center">LAPORAN LABA RUGI</h3>
    <h4 class="text-sm text-gray-600 mb-6 text-center">Kembang Lestari Travel</h4>
    <h4 class="text-sm text-gray-600 mb-8 text-center">Untuk Periode {{ \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') }} {{ $tahun }}</h4>

    <div class="space-y-6">
        <!-- Pendapatan -->
        <div>
            <h4 class="font-bold text-gray-800 mb-3">PENDAPATAN</h4>
            <div class="bg-gray-50 p-4 rounded-lg space-y-2 ml-4 mb-4">
                @foreach($pendapatanDetail as $akun)
                @php
                $subtotal = $akun->orders->sum('total_biaya');
                @endphp
                @if($subtotal > 0)
                <div class="flex justify-between text-sm">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                @endif
                @endforeach
            </div>
            <div class="flex justify-between font-bold text-gray-800 border-b-2 border-gray-300 pb-2 mb-4">
                <span>Total Pendapatan</span>
                <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Beban -->
        <div>
            <h4 class="font-bold text-gray-800 mb-3">BEBAN</h4>
            <div class="bg-gray-50 p-4 rounded-lg space-y-2 ml-4 mb-4">
                @foreach($bebanDetail as $akun)
                @php
                $subtotal = $akun->biayaOperasionals->sum('nominal');
                @endphp
                @if($subtotal > 0)
                <div class="flex justify-between text-sm">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                @endif
                @endforeach
            </div>
            <div class="flex justify-between font-bold text-gray-800 border-b-2 border-gray-300 pb-2 mb-4">
                <span>Total Beban</span>
                <span class="text-orange-600">Rp {{ number_format($totalBeban, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Laba/Rugi -->
        <div class="bg-blue-50 p-6 rounded-lg">
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-gray-800">LABA/(RUGI) BERSIH</span>
                <span class="text-3xl font-bold {{ $labaRugi >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $labaRugi >= 0 ? '+' : '-' }} Rp {{ number_format(abs($labaRugi), 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="flex gap-4">
    <a href="{{ route('laporan.index') }}" class="btn-secondary">← Kembali</a>
    <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>
@endsection