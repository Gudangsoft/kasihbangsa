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
                <a href="{{ route('galleries') }}" class="text-primary-200 hover:text-white transition-colors duration-200">
                    Galeri
                </a>
                <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">{{ $gallery->title }}</span>
            </nav>

            <!-- Page Title -->
            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4 animate-slide-up leading-tight">
                    {{ $gallery->title }}
                </h1>
                @if($gallery->category)
                    <div class="flex items-center gap-2 text-primary-200 animate-fade-in" style="animation-delay: 0.1s;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ $gallery->category->name }}</span>
                        @if(method_exists($images, 'total'))
                            <span class="mx-2">•</span>
                            <span class="text-sm">{{ $images->total() }} Foto</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="rgb(249, 250, 251)"/>
            </svg>
        </div>
    </div>

    <!-- Gallery Grid -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($images->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($images as $item)
                        <a href="{{ $item->image }}"
                           data-fancybox="gallery"
                           data-caption="{{ $gallery->title }} - Foto {{ $loop->iteration }}"
                           class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 block animate-fade-in"
                           style="animation-delay: {{ $loop->index * 0.05 }}s">
                            <!-- Image -->
                            <div class="aspect-square overflow-hidden bg-gray-200">
                                <img src="{{ $item->image }}"
                                     alt="{{ $gallery->title }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        <div class="bg-white text-primary-600 p-4 rounded-full shadow-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $images->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada foto dalam galeri ini.</p>
                </div>
            @endif
        </div>
    </section>
</div>
