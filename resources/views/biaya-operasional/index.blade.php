@extends('layouts.app')

@section('title', 'Biaya Operasional')
@section('page-title', 'Biaya Operasional')
@section('page-subtitle', 'Kelola data pengeluaran operasional')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div></div>
    <a href="{{ route('biaya-operasional.create') }}" class="btn-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Biaya
    </a>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Tanggal</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Nama Biaya</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Akun</th>
                    <th class="text-right py-4 px-6 font-semibold text-gray-700">Nominal</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Keterangan</th>
                    <th class="text-center py-4 px-6 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($biaya as $item)
                <tr class="table-row border-b border-gray-100">
                    <td class="py-4 px-6 text-gray-600">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="py-4 px-6 font-medium">{{ $item->nama_biaya }}</td>
                    <td class="py-4 px-6 text-gray-600 text-xs">{{ $item->akunBeban->nama_akun }}</td>
                    <td class="text-right py-4 px-6 font-medium text-orange-600">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td class="py-4 px-6 text-gray-600 text-xs">{{ Str::limit($item->keterangan, 30) }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('biaya-operasional.edit', $item) }}" class="btn btn-sm bg-yellow-50 text-yellow-700 hover:bg-yellow-100">
                                Edit
                            </a>
                            <button data-delete-url="{{ route('biaya-operasional.destroy', $item) }}" class="btn-delete btn btn-sm bg-red-50 text-red-700 hover:bg-red-100">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-500">
                        Belum ada biaya operasional. <a href="{{ route('biaya-operasional.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $biaya->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Event delegation untuk tombol hapus
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-delete-url');

                if (confirm('Apakah Anda yakin ingin menghapus biaya ini?')) {
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