@extends('layouts.app')

@section('title', 'Tambah Akun Akuntansi')
@section('page-title', 'Tambah Akun Akuntansi')
@section('page-subtitle', 'Buat akun baru untuk klasifikasi transaksi')

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form action="{{ route('akun-akuntansi.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="kode_akun" class="form-label">Kode Akun*</label>
                <input type="text" name="kode_akun" id="kode_akun" class="form-input"
                    placeholder="Contoh: 1001" value="{{ old('kode_akun') }}" required>
                @error('kode_akun')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="nama_akun" class="form-label">Nama Akun*</label>
                <input type="text" name="nama_akun" id="nama_akun" class="form-input"
                    placeholder="Contoh: Kas" value="{{ old('nama_akun') }}" required>
                @error('nama_akun')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jenis" class="form-label">Jenis Akun*</label>
                <select name="jenis" id="jenis" class="form-input" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenis as $j)
                    <option value="{{ $j }}" {{ old('jenis') === $j ? 'selected' : '' }}>{{ $j }}</option>
                    @endforeach
                </select>
                @error('jenis')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input" rows="4"
                    placeholder="Deskripsi akun">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('akun-akuntansi.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection