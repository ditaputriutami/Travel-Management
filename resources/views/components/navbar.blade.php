<!-- Top Navbar -->
<header class="bg-white border-b border-gray-100 shadow-lg backdrop-blur-sm">
    <div class="px-8 py-5 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 bg-clip-text text-transparent">@yield('page-title', 'Dashboard')</h2>
            <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', '')</p>
        </div>

        <div class="flex items-center gap-4">
            <!-- Search -->
            <div class="hidden md:block relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2.5 w-64 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 bg-gray-50 focus:bg-white shadow-sm">
            </div>

            <!-- Notifications -->
            <button class="relative p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full"></span>
            </button>

            <!-- User Profile -->
            <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <div class="relative">
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg ring-2 ring-white hover:scale-105 transition-transform duration-200 cursor-pointer">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-white"></div>
                </div>
            </div>
        </div>
    </div>
</header>