<!-- Top Navbar -->
<header class="bg-white border-b border-gray-200 shadow-soft">
    <div class="px-8 py-4 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
            <p class="text-sm text-gray-500">@yield('page-subtitle', '')</p>
        </div>

        <div class="flex items-center gap-6">
            <!-- Search -->
            <div class="hidden sm:block">
                <input type="text" placeholder="Cari..." class="form-input px-4 py-2 w-64 text-sm">
            </div>

            <!-- User Profile -->
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </div>
</header>