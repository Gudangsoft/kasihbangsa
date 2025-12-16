<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-24">
        <div class="container">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                    {{ $categoryName ? 'Informasi ' . $categoryName : 'Semua Informasi' }}
                </h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                    Informasi dan pengumuman penting dari STP Dian Mandala
                </p>
            </div>

            <!-- Category Filter -->
            @if($categories->count() > 0)
            <div class="flex flex-wrap justify-center gap-3">
                <a href="/informasi"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ !$categorySlug ? 'bg-white text-primary-600' : 'bg-white/20 hover:bg-white/30 text-white' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="/informasi?c={{ $cat->slug }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $categorySlug === $cat->slug ? 'bg-white text-primary-600' : 'bg-white/20 hover:bg-white/30 text-white' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Information Grid -->
    <section class="py-16 lg:py-24">
        <div class="container">
            @if($informations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($informations as $item)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 100 }}">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 p-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-medium text-white">
                                    {{ $item->category->name }}
                                </span>
                                <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-white line-clamp-2">
                                {{ $item->title }}
                            </h3>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {!! Str::limit(strip_tags($item->description), 150) !!}
                        </p>

                        <!-- Meta Info -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </div>
                            @if($item->file_path)
                            <div class="flex items-center text-primary-600">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                File tersedia
                            </div>
                            @endif
                        </div>

                        <!-- Download Button -->
                        @if($item->file_path)
                        <a href="/storage/{{ $item->file_path }}"
                           target="_blank"
                           class="btn btn-primary w-full text-center inline-flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh Dokumen
                        </a>
                        @else
                        <div class="text-center text-sm text-gray-500 py-3">
                            Tidak ada file lampiran
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $informations->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada informasi yang dipublikasikan{{ $categoryName ? ' untuk kategori ini' : '' }}.</p>
                @if($categoryName)
                <a href="/informasi" class="btn btn-outline mt-4">Lihat Semua Informasi</a>
                @endif
            </div>
            @endif
        </div>
    </section>
</div>
