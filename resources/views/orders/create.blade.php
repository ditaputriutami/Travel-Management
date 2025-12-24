@extends('layouts.app')

@section('title', 'Buat Order Baru')
@section('page-title', 'Buat Order Baru')
@section('page-subtitle', 'Input data penyewaan kendaraan')

@section('content')
<div class="max-w-3xl">
    <div class="card">
        <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan*</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-input"
                        placeholder="Nama lengkap" value="{{ old('nama_pelanggan') }}" required>
                    @error('nama_pelanggan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="no_telp" class="form-label">Nomor Telepon*</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-input"
                        placeholder="081xxxxxxxxx" value="{{ old('no_telp') }}" required>
                    @error('no_telp') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="kategori_id" class="form-label">Kategori Transport*</label>
                <select name="kategori_id" id="kategori_id" class="form-input" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }} ({{ $kategori->kapasitas }} seat)
                    </option>
                    @endforeach
                </select>
                @error('kategori_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="tanggal_sewa" class="form-label">Tanggal Sewa*</label>
                    <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-input"
                        value="{{ old('tanggal_sewa') }}" required>
                    @error('tanggal_sewa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai*</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-input"
                        value="{{ old('tanggal_selesai') }}" required>
                    @error('tanggal_selesai') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="total_biaya" class="form-label">Total Biaya (Rp)*</label>
                    <input type="number" name="total_biaya" id="total_biaya" class="form-input"
                        placeholder="0" value="{{ old('total_biaya') }}" step="0.01" min="0" required>
                    @error('total_biaya') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="uang_muka" class="form-label">Uang Muka (Rp)*</label>
                    <input type="number" name="uang_muka" id="uang_muka" class="form-input"
                        placeholder="0" value="{{ old('uang_muka') }}" step="0.01" min="0" required>
                    @error('uang_muka') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="denda" class="form-label">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" class="form-input"
                        placeholder="0" value="{{ old('denda', 0) }}" step="0.01" min="0">
                    @error('denda') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="akun_pendapatan_id" class="form-label">Akun Pendapatan*</label>
                    <select name="akun_pendapatan_id" id="akun_pendapatan_id" class="form-input" required>
                        <option value="">-- Pilih Akun --</option>
                        @foreach($akunPendapatan as $akun)
                        <option value="{{ $akun->id }}" {{ old('akun_pendapatan_id') == $akun->id ? 'selected' : '' }}>
                            {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                        </option>
                        @endforeach
                    </select>
                    @error('akun_pendapatan_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="jaminan" class="form-label">File Jaminan (KTP, STNK, dll)</label>
                <input type="file" name="jaminan" id="jaminan" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                <p class="text-xs text-gray-500 mt-2">Format: PDF, JPG, PNG (Max 10MB)</p>
                @error('jaminan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-input" rows="3"
                    placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
                @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('orders.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection