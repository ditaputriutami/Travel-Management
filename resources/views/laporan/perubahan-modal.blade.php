@extends('layouts.app')

@section('title', 'Laporan Perubahan Modal')
@section('page-title', 'Laporan Perubahan Modal')
@section('page-subtitle', 'Laporan perubahan ekuitas perusahaan')

@section('content')
<div class="card mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">LAPORAN PERUBAHAN MODAL</h3>
    <h4 class="text-sm text-gray-600 mb-6 text-center">Kembang Lestari Travel - Tahun {{ $tahun }}</h4>

    <div class="space-y-4">
        <div class="flex justify-between border-b border-gray-200 pb-3">
            <span class="font-semibold">Modal Awal Tahun</span>
            <span class="font-semibold">Rp {{ number_format($totalModalAwal, 0, ',', '.') }}</span>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg">
            <div class="flex justify-between mb-2">
                <span>Laba/(Rugi) Tahun {{ $tahun }}</span>
                <span class="{{ $labaRugiTahun >= 0 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                    {{ $labaRugiTahun >= 0 ? '+' : '' }} Rp {{ number_format($labaRugiTahun, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="flex justify-between border-t-2 border-gray-300 pt-4 text-lg">
            <span class="font-bold">Modal Akhir Tahun</span>
            <span class="font-bold text-blue-600">Rp {{ number_format($totalModalAkhir, 0, ',', '.') }}</span>
        </div>
    </div>
</div>

<div class="flex gap-4">
    <a href="{{ route('laporan.index') }}" class="btn-secondary">← Kembali</a>
    <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>
@endsection