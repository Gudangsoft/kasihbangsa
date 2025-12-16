@php
    $allMenus = \App\Models\Menu::where('status', 1)
        ->where('parent_id', 0)
        ->where('category', 'home')
        ->orderBy('number')
        ->with(['submenus' => function($query) {
            $query->where('status', 1)->orderBy('number');
        }])
        ->get();

    $visibleMenus = $allMenus->take(7);
    $hiddenMenus = $allMenus->skip(7);
@endphp

<nav x-data="{ mobileMenuOpen: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.pageYOffset > 50 })"
     :class="scrolled ? 'backdrop-blur-xl shadow-lg' : 'backdrop-blur-md'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     :style="scrolled ? 'background-color: rgba(5, 100, 110, 0.85); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);' : 'background-color: rgba(5, 100, 110);'">

    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3 group flex-shrink-0">
                <div class="relative">
                    <img src="{{ company()->image }}"
                         alt="{{ company()->name }}"
                         class="h-14 w-auto transition-all duration-300 group-hover:scale-105 drop-shadow-sm">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 rounded-full blur-xl transition-opacity duration-300"></div>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-1 flex-1 justify-end">
                @foreach($visibleMenus as $menu)
                    @if($menu->submenus->count() > 0)
                        <!-- Dropdown Menu -->
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <button class="px-3 xl:px-4 py-2 rounded-lg text-sm font-semibold text-white/90 hover:text-white hover:bg-white/20 transition-all duration-200 flex items-center gap-1 whitespace-nowrap group">
                                <span>{{ $menu->name }}</span>
                                <svg class="w-4 h-4 transition-all duration-200 group-hover:text-primary-700" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-2"
                                 class="absolute left-0 mt-2 w-64 rounded-xl shadow-xl ring-1 ring-white/20 py-2 overflow-hidden backdrop-blur-xl"
                                 style="display: none; background-color: rgba(5, 100, 110, 0.95);">
                                @foreach($menu->submenus as $submenu)
                                    <a href="{{ $submenu->url }}"
                                       class="group/item flex items-center justify-between px-4 py-2.5 text-sm text-white/90 hover:bg-white/20 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-white"
                                       @if(str_starts_with($submenu->url, 'http')) target="_blank" rel="noopener" @endif>
                                        <span class="font-medium">{{ $submenu->name }}</span>
                                        @if(str_starts_with($submenu->url, 'http'))
                                            <svg class="w-3.5 h-3.5 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Regular Menu -->
                        <a href="{{ $menu->url }}"
                           class="px-3 xl:px-4 py-2 rounded-lg text-sm font-semibold text-white/90 hover:text-white hover:bg-white/20 transition-all duration-200 whitespace-nowrap {{ request()->is(ltrim($menu->url, '/')) ? 'text-white bg-white/30' : '' }}"
                           @if(str_starts_with($menu->url, 'http')) target="_blank" rel="noopener" @endif>
                            {{ $menu->name }}
                        </a>
                    @endif
                @endforeach

                @if($hiddenMenus->count() > 0)
                    <!-- Menu Lainnya -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button class="px-3 xl:px-4 py-2 rounded-lg text-sm font-semibold text-white/90 hover:text-white hover:bg-white/20 transition-all duration-200 flex items-center gap-1 whitespace-nowrap group">
                            <span>Lainnya</span>
                            <svg class="w-4 h-4 transition-all duration-200 group-hover:text-primary-700" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="absolute right-0 mt-2 w-64 rounded-xl shadow-xl ring-1 ring-white/20 py-2 overflow-hidden max-h-[calc(100vh-120px)] overflow-y-auto backdrop-blur-xl"
                             style="display: none; background-color: rgba(5, 100, 110, 0.95);">
                            @foreach($hiddenMenus as $menu)
                                @if($menu->submenus->count() > 0)
                                    <div class="px-3 py-1.5">
                                        <div class="text-xs font-bold text-white uppercase tracking-wider mb-1 px-1">
                                            {{ $menu->name }}
                                        </div>
                                        @foreach($menu->submenus as $submenu)
                                            <a href="{{ $submenu->url }}"
                                               class="group/item flex items-center justify-between px-3 py-2 text-sm text-white/90 hover:bg-white/20 hover:text-white transition-all duration-200 rounded-lg"
                                               @if(str_starts_with($submenu->url, 'http')) target="_blank" rel="noopener" @endif>
                                                <span class="font-medium">{{ $submenu->name }}</span>
                                                @if(str_starts_with($submenu->url, 'http'))
                                                    <svg class="w-3.5 h-3.5 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                    </svg>
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                    @if(!$loop->last)
                                        <div class="border-t border-gray-200 my-2"></div>
                                    @endif
                                @else
                                    <a href="{{ $menu->url }}"
                                       class="group/item flex items-center justify-between px-4 py-2.5 text-sm text-white/90 hover:bg-white/20 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-white"
                                       @if(str_starts_with($menu->url, 'http')) target="_blank" rel="noopener" @endif>
                                        <span class="font-medium">{{ $menu->name }}</span>
                                        @if(str_starts_with($menu->url, 'http'))
                                            <svg class="w-3.5 h-3.5 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        @endif
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Search Button -->
                <a href="{{ route('search') }}"
                   class="hidden lg:block px-3 py-2 rounded-lg text-white/90 hover:text-white hover:bg-white/20 transition-all duration-200"
                   title="Pencarian">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>

                <!-- Auth Buttons Desktop -->
                <div class="hidden lg:flex items-center gap-2 ml-2">
                    @auth
                        <!-- Dashboard Button -->
                        <a href="/admin"
                           class="px-4 py-2 rounded-lg text-sm font-semibold text-white/90 hover:text-white hover:bg-white/20 transition-all duration-200 flex items-center gap-2 whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 rounded-lg text-sm font-semibold bg-white/10 text-white hover:bg-white/20 border border-white/30 transition-all duration-200 flex items-center gap-2 whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <!-- Login Button -->
                        <a href="/admin/login"
                           class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-primary-600 hover:bg-white/90 transition-all duration-200 flex items-center gap-2 whitespace-nowrap shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2.5 rounded-xl text-white/90 hover:bg-white/20 hover:text-white transition-all duration-200 border border-white/30"
                    aria-label="Toggle menu">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen"
         @click.away="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-gradient-to-b from-white to-gray-50 border-t border-gray-200 shadow-xl"
         style="display: none;">

        <div class="container mx-auto px-4 py-6 max-h-[calc(100vh-88px)] overflow-y-auto">
            <div class="space-y-2">
                <!-- Search Link -->
                <a href="{{ route('search') }}"
                   class="flex items-center justify-between px-4 py-3.5 rounded-xl text-gray-800 hover:bg-white hover:text-primary-700 transition-all duration-200 font-semibold shadow-sm border border-gray-100 bg-white ps-3">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Pencarian
                    </span>
                </a>

                @foreach($allMenus as $menu)
                    @if($menu->submenus->count() > 0)
                        <div x-data="{ open: false }" class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100">
                            <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3.5 text-gray-800 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                                <span class="font-semibold text-base">{{ $menu->name }}</span>
                                <svg class="w-5 h-5 transition-transform duration-300" :class="open ? 'rotate-180 text-primary-700' : 'text-gray-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open"
                                 x-collapse
                                 class="bg-gray-50/50 border-t border-gray-100">
                                <div class="px-3 py-2 space-y-1">
                                    @foreach($menu->submenus as $submenu)
                                        <a href="{{ $submenu->url }}"
                                           class="group flex items-center justify-between px-3 py-2.5 text-sm text-gray-700 hover:text-primary-700 hover:bg-white rounded-lg transition-all duration-200"
                                           @if(str_starts_with($submenu->url, 'http')) target="_blank" rel="noopener" @endif>
                                            <span class="font-medium">{{ $submenu->name }}</span>
                                            @if(str_starts_with($submenu->url, 'http'))
                                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->url }}"
                           class="flex items-center justify-between px-4 py-3.5 rounded-xl text-gray-800 hover:bg-white hover:text-primary-700 transition-all duration-200 font-semibold shadow-sm border border-gray-100 bg-white {{ request()->is(ltrim($menu->url, '/')) ? 'bg-primary-50 text-primary-700 border-primary-200' : '' }}"
                           @if(str_starts_with($menu->url, 'http')) target="_blank" rel="noopener" @endif>
                            <span>{{ $menu->name }}</span>
                            @if(str_starts_with($menu->url, 'http'))
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            @endif
                        </a>
                    @endif
                @endforeach

                <!-- Auth Buttons Mobile -->
                @auth
                    <!-- Dashboard Link Mobile -->
                    <a href="/admin"
                       class="flex items-center justify-between px-4 py-3.5 rounded-xl text-gray-800 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200 font-semibold shadow-sm border border-gray-100 bg-white">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </span>
                    </a>

                    <!-- Logout Button Mobile -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl text-white bg-red-600 hover:bg-red-700 transition-all duration-200 font-semibold shadow-sm">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </span>
                        </button>
                    </form>
                @else
                    <!-- Login Button Mobile -->
                    <a href="/admin/login"
                       class="flex items-center justify-between px-4 py-3.5 rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-all duration-200 font-semibold shadow-lg">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login
                        </span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Spacer for fixed navigation -->
<div class="h-20"></div>
