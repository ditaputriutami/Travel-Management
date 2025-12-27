@extends('layouts.app')

@section('title', 'Tambah Kategori Transport')
@section('page-title', 'Tambah Kategori Transport')
@section('page-subtitle', 'Isi form untuk menambah kendaraan baru')

@section('content')
<div class="max-w-4xl">
    <div class="card">
        <form action="{{ route('kategori-transport.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- ID Kendaraan (Kode Internal) -->
                <div>
                    <label for="kode_kendaraan" class="form-label">ID Kendaraan (Kode Internal)*</label>
                    <input type="text" name="kode_kendaraan" id="kode_kendaraan" class="form-input"
                        placeholder="Contoh: BUS001" value="{{ old('kode_kendaraan') }}" required>
                    @error('kode_kendaraan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Polisi -->
                <div>
                    <label for="nomor_polisi" class="form-label">Nomor Polisi*</label>
                    <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-input"
                        placeholder="Contoh: B 1234 XYZ" value="{{ old('nomor_polisi') }}" required>
                    @error('nomor_polisi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Jenis Kendaraan -->
                <div>
                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan*</label>
                    <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-input" required>
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="bus" {{ old('jenis_kendaraan') == 'bus' ? 'selected' : '' }}>Bus</option>
                    </select>
                    @error('jenis_kendaraan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Merk dan Tipe Kendaraan -->
                <div>
                    <label for="merk_tipe" class="form-label">Merk dan Tipe Kendaraan*</label>
                    <input type="text" name="merk_tipe" id="merk_tipe" class="form-input"
                        placeholder="Contoh: Toyota Hiace" value="{{ old('merk_tipe') }}" required>
                    @error('merk_tipe')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Tahun Kendaraan -->
                <div>
                    <label for="tahun_kendaraan" class="form-label">Tahun Kendaraan*</label>
                    <input type="number" name="tahun_kendaraan" id="tahun_kendaraan" class="form-input"
                        placeholder="Contoh: 2020" value="{{ old('tahun_kendaraan') }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('tahun_kendaraan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kapasitas Penumpang -->
                <div>
                    <label for="kapasitas_penumpang" class="form-label">Kapasitas Penumpang*</label>
                    <input type="number" name="kapasitas_penumpang" id="kapasitas_penumpang" class="form-input"
                        placeholder="Contoh: 50" value="{{ old('kapasitas_penumpang') }}" min="1" required>
                    @error('kapasitas_penumpang')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Status Kendaraan -->
                <div>
                    <label for="status_kendaraan" class="form-label">Status Kendaraan*</label>
                    <select name="status_kendaraan" id="status_kendaraan" class="form-input" required>
                        <option value="">Pilih Status Kendaraan</option>
                        <option value="tersedia" {{ old('status_kendaraan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status_kendaraan') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="perawatan" {{ old('status_kendaraan') == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                    </select>
                    @error('status_kendaraan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tarif Section -->
            <div class="border-t pt-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tarif Sewa</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tarif 12 Jam -->
                    <div>
                        <label for="tarif_12_jam" class="form-label">Tarif 12 Jam (Half Day)*</label>
                        <input type="number" name="tarif_12_jam" id="tarif_12_jam" class="form-input"
                            placeholder="Contoh: 800000" value="{{ old('tarif_12_jam') }}" min="0" step="0.01" required>
                        @error('tarif_12_jam')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tarif 24 Jam -->
                    <div>
                        <label for="tarif_24_jam" class="form-label">Tarif 24 Jam (Full Day)*</label>
                        <input type="number" name="tarif_24_jam" id="tarif_24_jam" class="form-input"
                            placeholder="Contoh: 1500000" value="{{ old('tarif_24_jam') }}" min="0" step="0.01" required>
                        @error('tarif_24_jam')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tarif Overtime -->
                    <div>
                        <label for="tarif_overtime_per_jam" class="form-label">Tarif Overtime (Per Jam)</label>
                        <input type="number" name="tarif_overtime_per_jam" id="tarif_overtime_per_jam" class="form-input"
                            placeholder="Contoh: 100000" value="{{ old('tarif_overtime_per_jam') }}" min="0" step="0.01">
                        @error('tarif_overtime_per_jam')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Opsional - untuk kelebihan jam</p>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input" rows="4"
                    placeholder="Deskripsi lengkap tentang kendaraan ini">{{ old('deskripsi') }}</textarea>
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