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
     :class="scrolled ? 'bg-white shadow-lg' : 'bg-white/98 backdrop-blur-md'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b"
     :style="scrolled ? 'border-color: rgba(4, 23, 27, 0.1)' : 'border-color: transparent'">

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
                            <button class="px-3 xl:px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-primary-700 hover:bg-primary-50/80 transition-all duration-200 flex items-center gap-1 whitespace-nowrap group">
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
                                 class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-xl ring-1 ring-primary-900 ring-opacity-5 py-2 overflow-hidden"
                                 style="display: none;">
                                @foreach($menu->submenus as $submenu)
                                    <a href="{{ $submenu->url }}"
                                       class="group/item flex items-center justify-between px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary-50 hover:to-primary-100/50 hover:text-primary-800 transition-all duration-200 border-l-2 border-transparent hover:border-primary-600"
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
                           class="px-3 xl:px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-primary-700 hover:bg-primary-50/80 transition-all duration-200 whitespace-nowrap {{ request()->is(ltrim($menu->url, '/')) ? 'text-primary-700 bg-primary-50' : '' }}"
                           @if(str_starts_with($menu->url, 'http')) target="_blank" rel="noopener" @endif>
                            {{ $menu->name }}
                        </a>
                    @endif
                @endforeach

                @if($hiddenMenus->count() > 0)
                    <!-- Menu Lainnya -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button class="px-3 xl:px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-primary-700 hover:bg-primary-50/80 transition-all duration-200 flex items-center gap-1 whitespace-nowrap group">
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
                             class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl ring-1 ring-primary-900 ring-opacity-5 py-2 overflow-hidden max-h-[calc(100vh-120px)] overflow-y-auto"
                             style="display: none;">
                            @foreach($hiddenMenus as $menu)
                                @if($menu->submenus->count() > 0)
                                    <div class="px-3 py-1.5">
                                        <div class="text-xs font-bold text-primary-800 uppercase tracking-wider mb-1 px-1">
                                            {{ $menu->name }}
                                        </div>
                                        @foreach($menu->submenus as $submenu)
                                            <a href="{{ $submenu->url }}"
                                               class="group/item flex items-center justify-between px-3 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary-50 hover:to-primary-100/50 hover:text-primary-800 transition-all duration-200 rounded-lg"
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
                                       class="group/item flex items-center justify-between px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary-50 hover:to-primary-100/50 hover:text-primary-800 transition-all duration-200 border-l-2 border-transparent hover:border-primary-600"
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
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2.5 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200 border border-gray-200"
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
            </div>
        </div>
    </div>
</nav>

<!-- Spacer for fixed navigation -->
<div class="h-20"></div>
