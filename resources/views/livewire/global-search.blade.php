<div>
    <!-- Hero Header -->
    <div class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        </div>

        <!-- Decorative Circles -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-700 rounded-full opacity-20 blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-600 rounded-full opacity-20 blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm mb-6 animate-fade-in">
                <a href="/" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda</span>
                </a>
                <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Pencarian</span>
            </nav>

            <!-- Page Title -->
            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-6 animate-slide-up leading-tight">
                    Pencarian
                </h1>
                <p class="text-lg text-primary-100 animate-fade-in" style="animation-delay: 0.1s;">
                    Temukan informasi, berita, galeri, dan halaman yang Anda cari
                </p>
            </div>
        </div>

        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="rgb(249, 250, 251)"/>
            </svg>
        </div>
    </div>

    <!-- Search Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Search Box -->
            <div class="max-w-4xl mx-auto mb-12">
                <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                    <!-- Search Input -->
                    <div class="relative mb-6">
                        <input type="text"
                               wire:model.live.debounce.500ms="search"
                               placeholder="Ketik minimal 3 karakter untuk mencari..."
                               class="w-full px-6 py-4 pr-12 text-lg border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200">
                        <svg class="absolute right-4 top-1/2 ps-2 transform -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex flex-wrap gap-2">
                        <button wire:click="$set('type', 'all')"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ $type === 'all' ? 'bg-primary-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Semua @if($totalResults > 0 && $type === 'all')({{ $totalResults }})@endif
                        </button>
                        <button wire:click="$set('type', 'information')"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ $type === 'information' ? 'bg-primary-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Informasi @if($informationsCount > 0)({{ $informationsCount }})@endif
                        </button>
                        <button wire:click="$set('type', 'news')"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ $type === 'news' ? 'bg-primary-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Berita @if($postsCount > 0)({{ $postsCount }})@endif
                        </button>
                        <button wire:click="$set('type', 'gallery')"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ $type === 'gallery' ? 'bg-primary-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Galeri @if($galleriesCount > 0)({{ $galleriesCount }})@endif
                        </button>
                        <button wire:click="$set('type', 'page')"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ $type === 'page' ? 'bg-primary-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Halaman @if($pagesCount > 0)({{ $pagesCount }})@endif
                        </button>
                    </div>
                </div>
            </div>

            <!-- Results -->
            @if(strlen($search) >= 3)
                @if($totalResults > 0)
                    <div class="max-w-5xl mx-auto">
                        <div class="mb-6">
                            <p class="text-gray-600">
                                Ditemukan <span class="font-bold text-primary-600">{{ $totalResults }}</span> hasil untuk
                                <span class="font-bold">"{{ $search }}"</span>
                            </p>
                        </div>

                        <div class="space-y-4">
                            @foreach($results as $result)
                                <a href="{{ $result->url }}"
                                   class="block bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                                    <div class="p-6">
                                        <div class="flex items-start gap-4">
                                            <!-- Icon -->
                                            <div class="flex-shrink-0 w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-600 transition-colors duration-300">
                                                @if($result->icon === 'document')
                                                    <svg class="w-6 h-6 text-primary-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                @elseif($result->icon === 'newspaper')
                                                    <svg class="w-6 h-6 text-primary-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                                    </svg>
                                                @elseif($result->icon === 'photo')
                                                    <svg class="w-6 h-6 text-primary-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-primary-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                                        {{ $result->type_label }}
                                                    </span>
                                                    @if($result->category)
                                                        <span class="text-xs text-gray-500">•</span>
                                                        <span class="text-xs text-gray-500">{{ $result->category->name }}</span>
                                                    @endif
                                                    <span class="text-xs text-gray-500">•</span>
                                                    <span class="text-xs text-gray-500">{{ $result->created_at->diffForHumans() }}</span>
                                                </div>
                                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors duration-200">
                                                    {{ $result->title }}
                                                </h3>
                                                @if(isset($result->description))
                                                    <p class="text-gray-600 line-clamp-2">
                                                        {{ Str::limit(strip_tags($result->description), 150) }}
                                                    </p>
                                                @elseif(isset($result->preview))
                                                    <p class="text-gray-600 line-clamp-2">
                                                        {{ Str::limit(strip_tags($result->preview), 150) }}
                                                    </p>
                                                @elseif(isset($result->content))
                                                    <p class="text-gray-600 line-clamp-2">
                                                        {{ Str::limit(strip_tags($result->content), 150) }}
                                                    </p>
                                                @endif
                                            </div>

                                            <!-- Arrow -->
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- No Results -->
                    <div class="max-w-2xl mx-auto text-center py-12">
                        <div class="bg-white p-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                Tidak Ada Hasil
                            </h3>
                            <p class="text-gray-600 mb-6">
                                Tidak ditemukan hasil untuk pencarian "<span class="font-bold">{{ $search }}</span>".
                            </p>
                            <p class="text-sm text-gray-500">
                                Coba gunakan kata kunci lain atau ubah filter pencarian.
                            </p>
                        </div>
                    </div>
                @endif
            @elseif(strlen($search) > 0 && strlen($search) < 3)
                <!-- Search Too Short -->
                <div class="max-w-2xl mx-auto text-center py-12">
                    <div class="bg-white rounded-2xl shadow-lg p-12">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            Ketik Minimal 3 Karakter
                        </h3>
                        <p class="text-gray-600">
                            Silakan ketik minimal 3 karakter untuk memulai pencarian.
                        </p>
                    </div>
                </div>
            @else
                <!-- Initial State -->
                <div class="max-w-2xl mx-auto text-center py-12">
                    <div class="bg-white">
                        <svg class="w-24 h-24 text-primary-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            Mulai Pencarian
                        </h3>
                        <p class="text-gray-600">
                            Gunakan kotak pencarian di atas untuk menemukan informasi, berita, galeri, dan halaman.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
