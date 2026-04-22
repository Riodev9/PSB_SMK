<aside
    x-data="{ open: true, openProfile: false }"
    :class="{ 'w-16': !open, 'w-60': open }"
    class="font-inter fixed inset-y-0 left-0
           bg-slate-900 text-slate-200
           flex flex-col
           transition-all duration-300">
    <!-- Header -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-slate-800">
        <span
            x-show="open"
            x-transition
            class="text-lg font-semibold tracking-wide text-white">
            PSB SMKT OBI
        </span>

        <button
            @click="open = !open"
            class="text-slate-400 hover:text-white transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <nav class="flex-1 px-2 py-6 space-y-1">
        @php $role = Auth::user()->role; @endphp

        {{-- ================= ADMIN ================= --}}
        @if($role === 'admin')
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Dashboard</span>
            </a>

            <!-- Informasi -->
            <a href="{{ route('admin.informasi') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('admin.informasi')
                        ? 'bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="info" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Informasi</span>
            </a>

            <!-- Pendaftaran -->
            <a href="{{ route('admin.pendaftaran') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('admin.pendaftaran')
                        ? 'bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="clipboard-list" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Pendaftaran</span>
            </a>

            <!-- Berkas -->
            <a href="{{ route('admin.berkas') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('admin.berkas')
                        ? 'bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="archive" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Berkas</span>
            </a>

            <!-- Tahun Ajaran -->
            <a href="{{ route('admin.tahun_ajaran') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('admin.tahun_ajaran')
                        ? 'bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="calendar" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Tahun Ajaran</span>
            </a>
        @endif

        {{-- ================= PELAJAR ================= --}}
        @if($role === 'pelajar')
            <!-- Dashboard -->
            <a href="{{ route('pelajar.dashboard') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('pelajar.dashboard')
                        ? 'bg-emerald-400/10 backdrop-blur-md border border-emerald-300/20 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Dashboard</span>
            </a>

            <!-- Data Diri -->
            <a href="{{ route('pelajar.data_diri') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('pelajar.data_diri')
                        ? 'bg-emerald-400/10 backdrop-blur-md border border-emerald-300/20 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="user" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Data Diri</span>
            </a>

            <!-- Informasi -->
            <a href="{{ route('pelajar.informasi') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('pelajar.informasi')
                        ? 'bg-emerald-400/10 backdrop-blur-md border border-emerald-300/20 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="info" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Informasi</span>
            </a>

            <!-- Pendaftaran -->
            <a href="{{ route('pelajar.pendaftaran_pelajar') }}"
            class="flex items-center h-11 px-3 rounded-xl
                    text-sm font-medium whitespace-nowrap transition-all duration-300
                    {{ request()->routeIs('pelajar.pendaftaran_pelajar')
                        ? 'bg-emerald-400/10 backdrop-blur-md border border-emerald-300/20 text-white shadow-lg'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="clipboard-list" class="h-5 w-5 shrink-0"></i>
                <span x-show="open" x-transition class="ml-3">Pendaftaran</span>
            </a>
        @endif
    </nav>

    <!-- Profile Section di Bawah -->
    <div class="mt-auto px-4 py-4 border-t border-slate-800 relative">
        <button
            @click="open && (openProfile = !openProfile)"
            class="flex items-center w-full gap-3">

            <img class="h-10 w-10 rounded-full shrink-0"
                src="{{ Auth::user()->profile_photo_url
                    ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}">

            <div x-show="open" x-transition class="flex flex-col">
                <span class="text-sm text-white">{{ Auth::user()->name }}</span>
                <span class="text-xs text-slate-400">View Profile</span>
            </div>

            <svg x-show="open"
                :class="{ 'rotate-180': openProfile }"
                class="ml-auto h-4 w-4 transition-transform">
                ...
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="openProfile" @click.away="openProfile = false" x-transition class="absolute left-4 bottom-16 w-52 bg-slate-800 text-white rounded-lg shadow-lg border border-slate-700 z-50">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-slate-700">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-slate-700">Logout</button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>

</aside>
