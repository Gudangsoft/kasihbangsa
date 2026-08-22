<!-- Gallery Section -->
<section class="py-16 lg:py-24">
    <div class="container">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-sm font-medium mb-4">
                Galeri
            </span>
            <h2 class="section-title">
                Momen &amp; Dokumentasi Kampus
            </h2>
            <p class="section-subtitle max-w-2xl mx-auto">
                Kumpulan foto dan video kegiatan {{ company()->name }}
            </p>
        </div>

        @if(count($items) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($items as $item)
            <a href="{{ $item['detail_url'] }}"
               class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300"
               data-aos="fade-up"
               data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative overflow-hidden">
                    @if(($item['type'] ?? 'photo') === 'video')
                        <img src="{{ $item['youtube_thumbnail_url'] }}"
                             alt="{{ $item['title'] }}"
                             class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-red-600 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    @else
                        <img src="/storage/{{ $item['images'][0]['image_path'] ?? '' }}"
                             alt="{{ $item['title'] }}"
                             class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>
                </div>

                <div class="absolute inset-0 flex flex-col justify-end p-5 text-white">
                    <span class="inline-block px-3 py-1 bg-primary-600 rounded-full text-xs font-medium mb-2 w-fit">
                        {{ $item['category']['name'] ?? 'Galeri' }}
                    </span>
                    <h3 class="text-lg font-heading font-bold">
                        {{ $item['title'] }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('galleries') }}" class="btn btn-primary inline-flex items-center">
                Lihat Semua Galeri
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada galeri yang dipublikasikan.</p>
        </div>
        @endif
    </div>
</section>
