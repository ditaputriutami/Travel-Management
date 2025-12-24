@extends('layouts.app')

@section('title', 'Edit Order')
@section('page-title', 'Edit Order')
@section('page-subtitle', 'Ubah data penyewaan')

@section('content')
<div class="max-w-3xl">
    <div class="card">
        <form action="{{ route('orders.update', $order) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan*</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-input"
                        value="{{ old('nama_pelanggan', $order->nama_pelanggan) }}" required>
                    @error('nama_pelanggan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="no_telp" class="form-label">Nomor Telepon*</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-input"
                        value="{{ old('no_telp', $order->no_telp) }}" required>
                    @error('no_telp') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="kategori_id" class="form-label">Kategori Transport*</label>
                    <select name="kategori_id" id="kategori_id" class="form-input" required>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $order->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="status" class="form-label">Status*</label>
                    <select name="status" id="status" class="form-input" required>
                        <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="aktif" {{ old('status', $order->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ old('status', $order->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status', $order->status) === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="tanggal_sewa" class="form-label">Tanggal Sewa*</label>
                    <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-input"
                        value="{{ old('tanggal_sewa', $order->tanggal_sewa->format('Y-m-d')) }}" required>
                    @error('tanggal_sewa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai*</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-input"
                        value="{{ old('tanggal_selesai', $order->tanggal_selesai->format('Y-m-d')) }}" required>
                    @error('tanggal_selesai') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="total_biaya" class="form-label">Total Biaya (Rp)*</label>
                    <input type="number" name="total_biaya" id="total_biaya" class="form-input"
                        value="{{ old('total_biaya', $order->total_biaya) }}" step="0.01" min="0" required>
                    @error('total_biaya') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="uang_muka" class="form-label">Uang Muka (Rp)*</label>
                    <input type="number" name="uang_muka" id="uang_muka" class="form-input"
                        value="{{ old('uang_muka', $order->uang_muka) }}" step="0.01" min="0" required>
                    @error('uang_muka') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="denda" class="form-label">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" class="form-input"
                        value="{{ old('denda', $order->denda) }}" step="0.01" min="0">
                    @error('denda') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="akun_pendapatan_id" class="form-label">Akun Pendapatan*</label>
                <select name="akun_pendapatan_id" id="akun_pendapatan_id" class="form-input" required>
                    @foreach($akunPendapatan as $akun)
                    <option value="{{ $akun->id }}" {{ old('akun_pendapatan_id', $order->akun_pendapatan_id) == $akun->id ? 'selected' : '' }}>
                        {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                    </option>
                    @endforeach
                </select>
                @error('akun_pendapatan_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="jaminan" class="form-label">File Jaminan</label>
                @if($order->jaminan)
                <p class="text-sm text-gray-600 mb-2">File saat ini: <a href="{{ Storage::url($order->jaminan) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($order->jaminan) }}</a></p>
                @endif
                <input type="file" name="jaminan" id="jaminan" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                <p class="text-xs text-gray-500 mt-2">Kosongkan jika tidak ingin mengubah file</p>
                @error('jaminan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-input" rows="3">{{ old('keterangan', $order->keterangan) }}</textarea>
                @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('orders.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection