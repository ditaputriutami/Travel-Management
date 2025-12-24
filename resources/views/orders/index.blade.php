@extends('layouts.app')

@section('title', 'Orders / Penyewaan')
@section('page-title', 'Orders / Penyewaan')
@section('page-subtitle', 'Kelola data penyewaan kendaraan')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div></div>
    <a href="{{ route('orders.create') }}" class="btn-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Buat Order
    </a>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Pelanggan</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Kategori</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Tanggal</th>
                    <th class="text-right py-4 px-6 font-semibold text-gray-700">Biaya</th>
                    <th class="text-right py-4 px-6 font-semibold text-gray-700">Uang Muka</th>
                    <th class="text-center py-4 px-6 font-semibold text-gray-700">Status</th>
                    <th class="text-center py-4 px-6 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="table-row border-b border-gray-100">
                    <td class="py-4 px-6 font-medium">{{ $order->nama_pelanggan }}</td>
                    <td class="py-4 px-6 text-gray-600 text-sm">{{ $order->kategori->nama_kategori }}</td>
                    <td class="py-4 px-6 text-gray-600 text-sm">
                        {{ $order->tanggal_sewa->format('d/m/Y') }} - {{ $order->tanggal_selesai->format('d/m/Y') }}
                    </td>
                    <td class="text-right py-4 px-6 font-medium">Rp {{ number_format($order->total_biaya, 0, ',', '.') }}</td>
                    <td class="text-right py-4 px-6">Rp {{ number_format($order->uang_muka, 0, ',', '.') }}</td>
                    <td class="text-center py-4 px-6">
                        <span class="badge {{ $order->getStatusBadge() }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm bg-yellow-50 text-yellow-700 hover:bg-yellow-100">
                                Edit
                            </a>
                            <button data-delete-url="{{ route('orders.destroy', $order) }}" class="btn-delete btn btn-sm bg-red-50 text-red-700 hover:bg-red-100">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-500">
                        Belum ada order. <a href="{{ route('orders.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
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

                if (confirm('Apakah Anda yakin ingin menghapus order ini?')) {
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