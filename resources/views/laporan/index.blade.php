@extends('layouts.app')

@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')
@section('page-subtitle', 'Dashboard laporan keuangan lengkap')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Laporan Pendapatan -->
    <div class="card hover:shadow-lg transition cursor-pointer">
        <a href="{{ route('laporan.pendapatan') }}" class="block">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Pendapatan</h3>
            <p class="text-sm text-gray-600">Detail pendapatan per akun dan periode tertentu</p>
        </a>
    </div>

    <!-- Laporan Laba Rugi -->
    <div class="card hover:shadow-lg transition cursor-pointer">
        <a href="{{ route('laporan.laba-rugi') }}" class="block">
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Laba Rugi</h3>
            <p class="text-sm text-gray-600">Perbandingan pendapatan dan beban operasional</p>
        </a>
    </div>

    <!-- Neraca -->
    <div class="card hover:shadow-lg transition cursor-pointer">
        <a href="{{ route('laporan.neraca') }}" class="block">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Neraca</h3>
            <p class="text-sm text-gray-600">Posisi keuangan aset, utang, dan modal</p>
        </a>
    </div>

    <!-- Laporan Perubahan Modal -->
    <div class="card hover:shadow-lg transition cursor-pointer">
        <a href="{{ route('laporan.perubahan-modal') }}" class="block">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Perubahan Modal</h3>
            <p class="text-sm text-gray-600">Perubahan ekuitas sepanjang tahun</p>
        </a>
    </div>
</div>
@endsection