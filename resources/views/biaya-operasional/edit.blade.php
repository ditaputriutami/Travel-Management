@extends('layouts.app')

@section('title', 'Edit Biaya Operasional')
@section('page-title', 'Edit Biaya Operasional')
@section('page-subtitle', 'Ubah data pengeluaran operasional')

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form action="{{ route('biaya-operasional.update', $biayaOperasional) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama_biaya" class="form-label">Nama Biaya*</label>
                <input type="text" name="nama_biaya" id="nama_biaya" class="form-input"
                    value="{{ old('nama_biaya', $biayaOperasional->nama_biaya) }}" required>
                @error('nama_biaya') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="tanggal" class="form-label">Tanggal*</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-input"
                        value="{{ old('tanggal', $biayaOperasional->tanggal->format('Y-m-d')) }}" required>
                    @error('tanggal') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="nominal" class="form-label">Nominal (Rp)*</label>
                    <input type="number" name="nominal" id="nominal" class="form-input"
                        value="{{ old('nominal', $biayaOperasional->nominal) }}" step="0.01" min="0" required>
                    @error('nominal') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="akun_beban_id" class="form-label">Akun Beban*</label>
                <select name="akun_beban_id" id="akun_beban_id" class="form-input" required>
                    @foreach($akun as $a)
                    <option value="{{ $a->id }}" {{ old('akun_beban_id', $biayaOperasional->akun_beban_id) == $a->id ? 'selected' : '' }}>
                        {{ $a->kode_akun }} - {{ $a->nama_akun }}
                    </option>
                    @endforeach
                </select>
                @error('akun_beban_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-input" rows="3">{{ old('keterangan', $biayaOperasional->keterangan) }}</textarea>
                @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('biaya-operasional.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection