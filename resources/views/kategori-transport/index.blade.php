@extends('layouts.app')

@section('title', 'Kategori Transport')
@section('page-title', 'Kategori Transport')
@section('page-subtitle', 'Kelola jenis dan kategori transportasi')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div></div>
    <a href="{{ route('kategori-transport.create') }}" class="btn-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Nama Kategori</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Kapasitas</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Total Order</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Deskripsi</th>
                    <th class="text-center py-4 px-6 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $kategori)
                <tr class="table-row border-b border-gray-100">
                    <td class="py-4 px-6 font-medium text-gray-800">{{ $kategori->nama_kategori }}</td>
                    <td class="py-4 px-6 text-gray-600">{{ $kategori->kapasitas }} seat</td>
                    <td class="py-4 px-6">
                        <span class="badge-primary">{{ $kategori->orders_count }}</span>
                    </td>
                    <td class="py-4 px-6 text-gray-600 text-sm">{{ Str::limit($kategori->deskripsi, 50) }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('kategori-transport.edit', $kategori) }}" class="btn btn-sm bg-yellow-50 text-yellow-700 hover:bg-yellow-100">
                                Edit
                            </a>
                            <button data-delete-url="{{ route('kategori-transport.destroy', $kategori) }}" class="btn-delete btn btn-sm bg-red-50 text-red-700 hover:bg-red-100">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500">
                        Belum ada kategori. <a href="{{ route('kategori-transport.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $kategoris->links() }}
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

                if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
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