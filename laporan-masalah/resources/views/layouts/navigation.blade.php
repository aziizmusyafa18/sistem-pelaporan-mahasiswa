<!-- Sidebar Navigation -->
<nav x-data="{ open: false, databaseOpen: false }" class="bg-white shadow-lg">
    <!-- Desktop & Tablet Sidebar (Large screens: >= 1024px) -->
    <aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:w-64 bg-white border-r border-gray-200 z-40">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 lg:h-20 border-b border-gray-200 px-3 lg:px-4">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('img/logosipma.png') }}" alt="SIPMA Logo" class="w-28 lg:w-32 h-auto">
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 flex flex-col overflow-y-auto py-3 lg:py-4">
            <nav class="flex-1 px-3 lg:px-4 space-y-1 lg:space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 lg:px-4 py-2.5 lg:py-3 text-sm lg:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="bi bi-speedometer2 text-lg lg:text-xl mr-2 lg:mr-3"></i>
                    <span class="font-medium">{{ __('Dashboard') }}</span>
                </a>

                @if(auth()->user()->role === 'mahasiswa')
                <a href="{{ route('laporan.index') }}" class="flex items-center px-3 lg:px-4 py-2.5 lg:py-3 text-sm lg:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('laporan.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="bi bi-file-text text-lg lg:text-xl mr-2 lg:mr-3"></i>
                    <span class="font-medium">{{ __('Laporan') }}</span>
                </a>
                @endif

                @canany(['isDPA'])
                <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-3 lg:px-4 py-2.5 lg:py-3 text-sm lg:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="bi bi-shield-check text-lg lg:text-xl mr-2 lg:mr-3"></i>
                    <span class="font-medium">{{ __('Laporan (Admin)') }}</span>
                </a>

                <!-- Database Section -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-3 lg:px-4 py-2.5 lg:py-3 text-sm lg:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                        <div class="flex items-center">
                            <i class="bi bi-database text-lg lg:text-xl mr-2 lg:mr-3"></i>
                            <span class="font-medium">Database</span>
                        </div>
                        <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="mt-1 lg:mt-2 ml-3 lg:ml-4 space-y-1 lg:space-y-2">
                        <a href="{{ route('dosen.index') }}" class="flex items-center px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('dosen.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                            <i class="bi bi-person-badge text-base lg:text-lg mr-2 lg:mr-3"></i>
                            <span>{{ __('Dosen') }}</span>
                        </a>
                        <a href="{{ route('mahasiswa.index') }}" class="flex items-center px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('mahasiswa.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                            <i class="bi bi-people text-base lg:text-lg mr-2 lg:mr-3"></i>
                            <span>{{ __('Mahasiswa') }}</span>
                        </a>
                    </div>
                </div>
                @endcanany
            </nav>
        </div>

        <!-- User Profile Section -->
        <div class="border-t border-gray-200">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 lg:px-4 py-3 lg:py-4 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center space-x-2 lg:space-x-3 overflow-hidden">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-7 h-7 lg:w-8 lg:h-8 rounded-full object-cover flex-shrink-0 border border-gray-300">
                        @else
                            <div class="w-7 h-7 lg:w-8 lg:h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold text-sm lg:text-base flex-shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="text-left overflow-hidden">
                            <div class="font-medium text-xs lg:text-sm truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 flex-shrink-0" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" x-transition class="absolute bottom-full left-0 right-0 mb-2 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-700 hover:bg-gray-50">
                        <i class="bi bi-person text-base lg:text-lg mr-2 lg:mr-3"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-700 hover:bg-gray-50">
                            <i class="bi bi-box-arrow-right text-base lg:text-lg mr-2 lg:mr-3"></i>
                            <span>{{ __('Log Out') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Mobile & Tablet Header (< 1024px) -->
    <div class="lg:hidden bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center justify-between px-3 sm:px-4 md:px-6 py-2.5 sm:py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('img/logosipma.png') }}" alt="SIPMA Logo" class="w-20 sm:w-24 md:w-28 h-auto">
            </a>
            <button @click="open = !open" class="p-1.5 sm:p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors">
                <svg class="h-5 w-5 sm:h-6 sm:w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Spacer for fixed header on mobile/tablet -->
    <div class="lg:hidden h-12 sm:h-14 md:h-16"></div>

    <!-- Mobile & Tablet Menu (Slide-in from right) -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-full"
         @click.away="open = false"
         class="lg:hidden fixed inset-y-0 right-0 w-56 sm:w-64 md:w-72 bg-white shadow-2xl z-50 overflow-y-auto">

        <!-- Mobile Menu Header -->
        <div class="flex items-center justify-between px-4 sm:px-5 md:px-6 py-3 sm:py-4 border-b border-gray-200 sticky top-0 bg-white">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800">Menu</h2>
            <button @click="open = false" class="p-1.5 sm:p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="px-3 sm:px-4 md:px-5 py-3 sm:py-4 space-y-1 sm:space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                <i class="bi bi-speedometer2 text-lg sm:text-xl mr-2.5 sm:mr-3"></i>
                <span class="font-medium">{{ __('Dashboard') }}</span>
            </a>

            @if(auth()->user()->role === 'mahasiswa')
            <a href="{{ route('laporan.index') }}" class="flex items-center px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors {{ request()->routeIs('laporan.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                <i class="bi bi-file-text text-lg sm:text-xl mr-2.5 sm:mr-3"></i>
                <span class="font-medium">{{ __('Laporan') }}</span>
            </a>
            @endif

            @canany(['isDPA'])
            <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors {{ request()->routeIs('admin.laporan.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                <i class="bi bi-shield-check text-lg sm:text-xl mr-2.5 sm:mr-3"></i>
                <span class="font-medium">{{ __('Laporan (Admin)') }}</span>
            </a>

            <!-- Database Section for Mobile -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                    <div class="flex items-center">
                        <i class="bi bi-database text-lg sm:text-xl mr-2.5 sm:mr-3"></i>
                        <span class="font-medium">Database</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 ml-3 sm:ml-4 space-y-1">
                    <a href="{{ route('dosen.index') }}" class="flex items-center px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors {{ request()->routeIs('dosen.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="bi bi-person-badge text-base sm:text-lg mr-2.5 sm:mr-3"></i>
                        <span>{{ __('Dosen') }}</span>
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="flex items-center px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors {{ request()->routeIs('mahasiswa.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="bi bi-people text-base sm:text-lg mr-2.5 sm:mr-3"></i>
                        <span>{{ __('Mahasiswa') }}</span>
                    </a>
                </div>
            </div>
            @endcanany
        </div>

        <!-- Mobile User Section -->
        <div class="border-t border-gray-200 px-3 sm:px-4 md:px-5 py-3 sm:py-4 mt-4">
            <div class="flex items-center space-x-2.5 sm:space-x-3 mb-3 sm:mb-4">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-9 h-9 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full object-cover flex-shrink-0 border-2 border-gray-300">
                @else
                    <div class="w-9 h-9 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold text-sm sm:text-base flex-shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <div class="overflow-hidden flex-1">
                    <div class="font-medium text-sm sm:text-base text-gray-800 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs sm:text-sm text-gray-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="bi bi-person text-base sm:text-lg mr-2.5 sm:mr-3"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="bi bi-box-arrow-right text-base sm:text-lg mr-2.5 sm:mr-3"></i>
                        <span>{{ __('Log Out') }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Overlay for mobile/tablet menu -->
    <div x-show="open"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>
</nav>
