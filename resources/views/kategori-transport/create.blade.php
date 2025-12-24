@extends('layouts.app')

@section('title', 'Tambah Kategori Transport')
@section('page-title', 'Tambah Kategori Transport')
@section('page-subtitle', 'Isi form untuk menambah kategori transportasi baru')

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form action="{{ route('kategori-transport.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="nama_kategori" class="form-label">Nama Kategori*</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-input"
                    placeholder="Contoh: Bus Pariwisata 50 seat" value="{{ old('nama_kategori') }}" required>
                @error('nama_kategori')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kapasitas" class="form-label">Kapasitas (seat)*</label>
                <input type="number" name="kapasitas" id="kapasitas" class="form-input"
                    placeholder="Contoh: 50" value="{{ old('kapasitas') }}" min="1" required>
                @error('kapasitas')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input" rows="4"
                    placeholder="Deskripsi lengkap tentang kategori ini">{{ old('deskripsi') }}</textarea>
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
                <a href="{{ route('kategori-transport.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection