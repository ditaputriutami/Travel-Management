@extends('layouts.app')

@section('title', 'Akun Akuntansi')
@section('page-title', 'Akun Akuntansi')
@section('page-subtitle', 'Kelola akun akuntansi untuk laporan keuangan')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div></div>
    <a href="{{ route('akun-akuntansi.create') }}" class="btn btn-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Akun
    </a>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Kode</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Nama Akun</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Jenis</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Deskripsi</th>
                    <th class="text-center py-4 px-6 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($akuns as $akun)
                <tr class="table-row border-b border-gray-100">
                    <td class="py-4 px-6">
                        <span class="badge badge-primary">{{ $akun->kode_akun }}</span>
                    </td>
                    <td class="py-4 px-6 font-medium text-gray-800">{{ $akun->nama_akun }}</td>
                    <td class="py-4 px-6">
                        @php
                        $badgeClasses = [
                        'Aset' => 'badge badge-primary',
                        'Utang' => 'badge bg-orange-100 text-orange-800',
                        'Modal' => 'badge bg-purple-100 text-purple-800',
                        'Pendapatan' => 'badge bg-green-100 text-green-800',
                        'Beban' => 'badge bg-red-100 text-red-800',
                        ];
                        @endphp
                        <span class="{{ $badgeClasses[$akun->jenis] ?? 'badge badge-primary' }}">
                            {{ $akun->jenis }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-gray-600 text-sm">{{ Str::limit($akun->deskripsi, 40) }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('akun-akuntansi.show', $akun) }}" class="px-3 py-1 text-sm rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                                Detail
                            </a>
                            <a href="{{ route('akun-akuntansi.edit', $akun) }}" class="px-3 py-1 text-sm rounded-lg bg-yellow-50 text-yellow-700 hover:bg-yellow-100 transition">
                                Edit
                            </a>
                            <button data-delete-url="{{ route('akun-akuntansi.destroy', $akun) }}" class="btn-delete px-3 py-1 text-sm rounded-lg bg-red-50 text-red-700 hover:bg-red-100 transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500">
                        Belum ada akun. <a href="{{ route('akun-akuntansi.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $akuns->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Event listener untuk tombol hapus
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-delete-url');

                if (confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // Add CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Add method spoofing
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endpush