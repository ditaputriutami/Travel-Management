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
                <label for="kategori_id" class="form-label">Pilih Kendaraan*</label>
                <select name="kategori_id" id="kategori_id" class="form-input" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        data-tarif-12="{{ $kategori->tarif_12_jam }}"
                        data-tarif-24="{{ $kategori->tarif_24_jam }}"
                        data-tarif-ot="{{ $kategori->tarif_overtime_per_jam ?? 0 }}"
                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->merk_tipe }} ({{ $kategori->nomor_polisi }}) - {{ $kategori->kapasitas_penumpang }} seat
                    </option>
                    @endforeach
                </select>
                @error('kategori_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="durasi_sewa" class="form-label">Durasi Sewa*</label>
                <select name="durasi_sewa" id="durasi_sewa" class="form-input" required>
                    <option value="">-- Pilih Durasi --</option>
                    <option value="12_jam" data-label="12 Jam (Half Day)" {{ old('durasi_sewa') == '12_jam' ? 'selected' : '' }}>12 Jam (Half Day)</option>
                    <option value="24_jam" data-label="24 Jam (Full Day)" {{ old('durasi_sewa') == '24_jam' ? 'selected' : '' }}>24 Jam (Full Day)</option>
                </select>
                @error('durasi_sewa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Informasi Tarif Otomatis -->
            <div id="tarif-info-box" class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                <h4 class="font-semibold text-blue-900 mb-2">Rincian Biaya</h4>
                <div class="space-y-1 text-sm text-blue-800">
                    <div class="flex justify-between">
                        <span id="tarif-label">Tarif Sewa:</span>
                        <span id="tarif-value" class="font-semibold">Rp 0</span>
                    </div>
                    <div id="overtime-section" class="hidden">
                        <div class="flex justify-between items-center mt-3 pt-3 border-t border-blue-200">
                            <span>Jam Overtime:</span>
                            <input type="number" name="jam_overtime" id="jam_overtime"
                                class="w-20 px-2 py-1 text-right border border-blue-300 rounded"
                                value="{{ old('jam_overtime', 0) }}" min="0" max="99">
                        </div>
                        <div class="flex justify-between mt-1">
                            <span>Biaya Overtime (<span id="tarif-ot-label">Rp 0</span>/jam):</span>
                            <span id="overtime-value" class="font-semibold">Rp 0</span>
                        </div>
                    </div>
                    <div class="flex justify-between pt-2 mt-2 border-t border-blue-300">
                        <span class="font-semibold">Total Biaya:</span>
                        <span id="total-value" class="font-bold text-lg text-blue-900">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Hidden fields untuk menyimpan nilai -->
            <input type="hidden" name="tarif_dasar" id="tarif_dasar" value="{{ old('tarif_dasar', 0) }}">
            <input type="hidden" name="biaya_overtime" id="biaya_overtime" value="{{ old('biaya_overtime', 0) }}">
            <input type="hidden" name="total_biaya" id="total_biaya" value="{{ old('total_biaya', 0) }}">

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
                    <label for="uang_muka" class="form-label">Uang Muka (Rp)*</label>
                    <input type="number" name="uang_muka" id="uang_muka" class="form-input"
                        placeholder="0" value="{{ old('uang_muka') }}" step="0.01" min="0" required>
                    @error('uang_muka') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="denda" class="form-label">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" class="form-input"
                        placeholder="0" value="{{ old('denda', 0) }}" step="0.01" min="0">
                    @error('denda') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Script loaded');

        const kategoriSelect = document.getElementById('kategori_id');
        const durasiSelect = document.getElementById('durasi_sewa');
        const tarifDasarInput = document.getElementById('tarif_dasar');
        const jamOvertimeInput = document.getElementById('jam_overtime');
        const biayaOvertimeInput = document.getElementById('biaya_overtime');
        const totalBiayaInput = document.getElementById('total_biaya');
        const tarifInfoBox = document.getElementById('tarif-info-box');
        const tarifLabel = document.getElementById('tarif-label');
        const tarifValue = document.getElementById('tarif-value');
        const totalValue = document.getElementById('total-value');
        const overtimeSection = document.getElementById('overtime-section');
        const overtimeValue = document.getElementById('overtime-value');
        const tarifOtLabel = document.getElementById('tarif-ot-label');

        let currentTarifOt = 0;

        function formatRupiah(number) {
            const formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
            console.log('Format', number, 'to', formatted);
            return formatted;
        }

        function updateDurasiOptions() {
            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];

            if (!selectedOption || !selectedOption.value) {
                durasiSelect.options[1].text = '12 Jam (Half Day)';
                durasiSelect.options[2].text = '24 Jam (Full Day)';
                return;
            }

            const tarif12Attr = selectedOption.getAttribute('data-tarif-12');
            const tarif24Attr = selectedOption.getAttribute('data-tarif-24');

            console.log('Data attributes:', {
                'data-tarif-12': tarif12Attr,
                'data-tarif-24': tarif24Attr
            });

            const tarif12 = parseFloat(tarif12Attr) || 0;
            const tarif24 = parseFloat(tarif24Attr) || 0;

            console.log('Parsed tarif:', {
                tarif12: tarif12,
                tarif24: tarif24
            });

            durasiSelect.options[1].text = `12 Jam (Half Day) - ${formatRupiah(tarif12)}`;
            durasiSelect.options[2].text = `24 Jam (Full Day) - ${formatRupiah(tarif24)}`;
        }

        function updateTarif() {
            console.log('updateTarif called');
            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
            const durasi = durasiSelect.value;

            console.log('Selected kategori:', selectedOption ? selectedOption.text : 'none');
            console.log('Selected durasi:', durasi);

            if (!selectedOption || !selectedOption.value || !durasi) {
                tarifInfoBox.classList.add('hidden');
                tarifDasarInput.value = '0';
                totalBiayaInput.value = '0';
                return;
            }

            const tarif12 = parseFloat(selectedOption.getAttribute('data-tarif-12')) || 0;
            const tarif24 = parseFloat(selectedOption.getAttribute('data-tarif-24')) || 0;
            const tarifOt = parseFloat(selectedOption.getAttribute('data-tarif-ot')) || 0;
            currentTarifOt = tarifOt;

            console.log('Tarif values:', {
                tarif12: tarif12,
                tarif24: tarif24,
                tarifOt: tarifOt
            });

            let tarifDasar = 0;
            let labelDurasi = '';

            if (durasi === '12_jam') {
                tarifDasar = tarif12;
                labelDurasi = 'Tarif Sewa (12 Jam):';
            } else if (durasi === '24_jam') {
                tarifDasar = tarif24;
                labelDurasi = 'Tarif Sewa (24 Jam):';
            }

            console.log('Tarif dasar selected:', tarifDasar);

            tarifLabel.textContent = labelDurasi;
            tarifValue.textContent = formatRupiah(tarifDasar);
            tarifDasarInput.value = tarifDasar;

            if (tarifOt > 0) {
                overtimeSection.classList.remove('hidden');
                tarifOtLabel.textContent = formatRupiah(tarifOt);
            } else {
                overtimeSection.classList.add('hidden');
                jamOvertimeInput.value = '0';
            }

            tarifInfoBox.classList.remove('hidden');
            calculateTotal();
        }

        function calculateTotal() {
            const tarifDasar = parseFloat(tarifDasarInput.value || 0);
            const jamOt = parseInt(jamOvertimeInput.value || 0);

            const biayaOt = jamOt * currentTarifOt;
            biayaOvertimeInput.value = biayaOt;
            overtimeValue.textContent = formatRupiah(biayaOt);

            const total = tarifDasar + biayaOt;
            totalBiayaInput.value = total;
            totalValue.textContent = formatRupiah(total);
        }

        kategoriSelect.addEventListener('change', function() {
            updateDurasiOptions();
            updateTarif();
        });
        durasiSelect.addEventListener('change', updateTarif);
        jamOvertimeInput.addEventListener('input', calculateTotal);

        // Trigger update jika ada old values (after validation error)
        if (kategoriSelect.value && durasiSelect.value) {
            updateDurasiOptions();
            updateTarif();
        } else if (kategoriSelect.value) {
            updateDurasiOptions();
        }
    });
</script>
@endpush