<!-- Sidebar -->
<div class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white shadow-lg hidden md:flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-blue-500">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <span class="text-blue-600 font-bold text-lg">KL</span>
            </div>
            <div>
                <h1 class="font-bold text-lg">Kembang Lestari</h1>
                <p class="text-xs text-blue-100">Travel Management</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('dashboard') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2 3l2-3m2 3l2-3m2-4a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Master Data -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-blue-100 uppercase tracking-wide">Master Data</p>
        </div>

        <!-- Kategori Transport -->
        <a href="{{ route('kategori-transport.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('kategori-transport.*') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span>Kategori Transport</span>
        </a>

        <!-- Akun Akuntansi -->
        <a href="{{ route('akun-akuntansi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('akun-akuntansi.*') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            <span>Akun Akuntansi</span>
        </a>

        <!-- Transaksi -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-blue-100 uppercase tracking-wide">Transaksi</p>
        </div>

        <!-- Orders -->
        <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('orders.*') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span>Orders / Penyewaan</span>
        </a>

        <!-- Biaya Operasional -->
        <a href="{{ route('biaya-operasional.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('biaya-operasional.*') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Biaya Operasional</span>
        </a>

        <!-- Laporan -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-blue-100 uppercase tracking-wide">Laporan</p>
        </div>

        <!-- Laporan Pendapatan -->
        <a href="{{ route('laporan.pendapatan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('laporan.pendapatan') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Laporan Pendapatan</span>
        </a>

        <!-- Laporan Laba Rugi -->
        <a href="{{ route('laporan.laba-rugi') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('laporan.laba-rugi') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Laporan Laba Rugi</span>
        </a>

        <!-- Neraca -->
        <a href="{{ route('laporan.neraca') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('laporan.neraca') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Neraca</span>
        </a>

        <!-- Laporan Perubahan Modal -->
        <a href="{{ route('laporan.perubahan-modal') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition {{ request()->routeIs('laporan.perubahan-modal') ? 'bg-blue-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span>Laporan Perubahan Modal</span>
        </a>
    </nav>

    <!-- User Profile -->
    <div class="border-t border-blue-500 p-4">
        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Sidebar Toggle Button -->
<button onclick="toggleMobileSidebar()" class="md:hidden fixed bottom-8 right-8 z-40 w-14 h-14 bg-blue-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-700 transition">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<script>
    function toggleMobileSidebar() {
        alert('Mobile menu - implement as needed');
    }
</script>