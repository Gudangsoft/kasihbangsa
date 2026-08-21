<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                Berita & Informasi
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                Ikuti perkembangan dan kegiatan terbaru di {{ company()->name }}
            </p>
        </div>
    </section>

    <!-- Posts Grid -->
    <section class="py-16 lg:py-24">
        <div class="container">
            @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $item)
                <article class="card group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-56">
                        <img src="{{ $item->thumbnail }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                        <!-- Date Badge -->
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md p-3 text-center">
                            <div class="text-2xl font-heading font-bold text-primary-600">{{ $item->day }}</div>
                            <div class="text-xs text-gray-600 uppercase">{{ $item->month }}</div>
                        </div>

                        <!-- Category Badge -->
                        <div class="absolute bottom-4 left-4 bg-primary-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                            {{ $item->category->name }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Author Info -->
                        <div class="flex items-center mb-4">
                            <img src="{{ $item->user->profile_photo_url }}"
                                 alt="{{ $item->user->name }}"
                                 class="w-10 h-10 rounded-full mr-3 ring-2 ring-gray-100">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $item->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $item->month }} {{ $item->day }}, {{ $item->year }}</p>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="font-heading font-bold text-xl text-gray-900 mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors duration-200">
                            <a href="{{ $item->read_url }}">{{ $item->title }}</a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($item->description), 150) }}
                        </p>

                        <!-- Read More Link -->
                        <a href="{{ $item->read_url }}"
                           class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium text-sm group-hover:gap-2 transition-all duration-200">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada berita yang dipublikasikan.</p>
            </div>
            @endif
        </div>
    </section>
</div>
