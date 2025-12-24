@extends('layouts.app')

@section('title', 'Edit Kategori Transport')
@section('page-title', 'Edit Kategori Transport')
@section('page-subtitle', 'Ubah data kategori transportasi')

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form action="{{ route('kategori-transport.update', $kategoriTransport) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama_kategori" class="form-label">Nama Kategori*</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-input"
                    value="{{ old('nama_kategori', $kategoriTransport->nama_kategori) }}" required>
                @error('nama_kategori')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kapasitas" class="form-label">Kapasitas (seat)*</label>
                <input type="number" name="kapasitas" id="kapasitas" class="form-input"
                    value="{{ old('kapasitas', $kategoriTransport->kapasitas) }}" min="1" required>
                @error('kapasitas')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input" rows="4">{{ old('deskripsi', $kategoriTransport->deskripsi) }}</textarea>
                @error('deskripsi')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('kategori-transport.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection