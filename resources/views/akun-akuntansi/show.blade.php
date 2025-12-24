@extends('layouts.app')

@section('title', 'Detail Akun - ' . $akunAkuntansi->nama_akun)
@section('page-title', $akunAkuntansi->nama_akun)
@section('page-subtitle', 'Detail dan riwayat transaksi akun')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="card">
        <p class="text-gray-600 text-sm">Kode Akun</p>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $akunAkuntansi->kode_akun }}</p>
    </div>
    <div class="card">
        <p class="text-gray-600 text-sm">Jenis</p>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $akunAkuntansi->jenis }}</p>
    </div>
    <div class="card">
        <p class="text-gray-600 text-sm">Saldo</p>
        <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
    </div>
</div>

<div class="card">
    <h3 class="text-lg font-bold text-gray-800 mb-6">Riwayat Transaksi</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Keterangan</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Tipe</th>
                    <th class="text-right py-3 px-4 font-semibold text-gray-700">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                <tr class="table-row border-b border-gray-100">
                    <td class="py-3 px-4">{{ $transaksi->tanggal_transaksi->format('d/m/Y') }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $transaksi->keterangan }}</td>
                    <td class="py-3 px-4">
                        @if($transaksi->tipe_transaksi === 'debet')
                        <span class="badge bg-green-100 text-green-800">Debet</span>
                        @else
                        <span class="badge bg-red-100 text-red-800">Kredit</span>
                        @endif
                    </td>
                    <td class="text-right py-3 px-4 font-medium">
                        @if($transaksi->tipe_transaksi === 'debet')
                        <span class="text-green-600">+</span>
                        @else
                        <span class="text-red-600">-</span>
                        @endif
                        Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 text-center text-gray-500">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>
</div>

<div class="mt-8">
    <a href="{{ route('akun-akuntansi.index') }}" class="btn-secondary">
        ← Kembali
    </a>
</div>
@endsection