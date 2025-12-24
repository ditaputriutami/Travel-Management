@extends('layouts.app')

@section('title', 'Neraca')
@section('page-title', 'Neraca')
@section('page-subtitle', 'Laporan posisi keuangan perusahaan')

@section('content')
<div class="card mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">NERACA</h3>
    <h4 class="text-sm text-gray-600 mb-6 text-center">Kembang Lestari Travel - Per {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d F Y') }}</h4>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- AKTIVA (Aset) -->
        <div>
            <h4 class="font-bold text-gray-800 mb-4 text-lg">AKTIVA</h4>

            <div class="space-y-2 ml-4 mb-4">
                <h5 class="font-semibold text-gray-700 mb-3">Aset Lancar:</h5>
                @foreach($asetAkuns as $akun)
                @php $saldo = $akun->getSaldo(); @endphp
                @if($saldo > 0)
                <div class="flex justify-between text-sm">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>Rp {{ number_format($saldo, 0, ',', '.') }}</span>
                </div>
                @endif
                @endforeach
            </div>

            <div class="flex justify-between font-bold text-gray-800 border-t-2 border-gray-300 pt-2 mb-4">
                <span>Total Aset</span>
                <span class="text-blue-600">Rp {{ number_format($totalAset, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- PASIVA (Kewajiban & Modal) -->
        <div>
            <h4 class="font-bold text-gray-800 mb-4 text-lg">PASIVA</h4>

            <!-- Utang -->
            <div class="space-y-2 ml-4 mb-6">
                <h5 class="font-semibold text-gray-700 mb-3">Utang:</h5>
                @foreach($utangAkuns as $akun)
                @php $saldo = $akun->getSaldo(); @endphp
                @if($saldo > 0)
                <div class="flex justify-between text-sm">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>Rp {{ number_format($saldo, 0, ',', '.') }}</span>
                </div>
                @endif
                @endforeach
            </div>

            <div class="flex justify-between font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-4">
                <span>Total Utang</span>
                <span>Rp {{ number_format($totalUtang, 0, ',', '.') }}</span>
            </div>

            <!-- Modal -->
            <div class="space-y-2 ml-4 mb-4">
                <h5 class="font-semibold text-gray-700 mb-3">Modal:</h5>
                @foreach($modalAkuns as $akun)
                @php $saldo = $akun->getSaldo(); @endphp
                @if($saldo > 0)
                <div class="flex justify-between text-sm">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>Rp {{ number_format($saldo, 0, ',', '.') }}</span>
                </div>
                @endif
                @endforeach
                @if($labaRugi != 0)
                <div class="flex justify-between text-sm border-t border-gray-200 pt-2">
                    <span>Laba/(Rugi) Tahun Ini</span>
                    <span class="{{ $labaRugi >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        Rp {{ number_format($labaRugi, 0, ',', '.') }}
                    </span>
                </div>
                @endif
            </div>

            <div class="flex justify-between font-bold text-gray-800 border-t-2 border-gray-300 pt-2">
                <span>Total Pasiva</span>
                <span class="text-purple-600">Rp {{ number_format($totalUtang + $totalModal + $labaRugi, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="flex gap-4">
    <a href="{{ route('laporan.index') }}" class="btn-secondary">← Kembali</a>
    <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>
@endsection