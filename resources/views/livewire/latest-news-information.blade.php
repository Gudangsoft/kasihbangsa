<div>
    <!-- Latest News & Information Section -->
    <section class="py-16 lg:py-20 bg-white">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Berita Terkini -->
                <div class="lg:col-span-8">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-200">
                        <h2 class="text-3xl font-heading font-bold text-gray-900">
                            Berita Terkini
                        </h2>
                        <a href="/berita" class="text-gray-600 hover:text-primary-600 font-medium text-sm transition-colors">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($latestPosts as $post)
                            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-200">
                                <!-- Image -->
                                <div class="relative h-52 overflow-hidden">
                                    <img src="{{ $post->thumbnail }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy">
                                    <!-- Category Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-block px-3 py-1.5 text-xs font-bold rounded-lg bg-primary-600 text-white shadow-lg">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <!-- Title -->
                                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors leading-tight">
                                        <a href="{{ route('detail-berita', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h3>

                                    <!-- Date -->
                                    <div class="flex items-center text-sm text-gray-500 mb-4">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($post->publish_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</span>
                                    </div>

                                    <!-- Excerpt -->
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                        {!! Str::limit(strip_tags($post->content ?? ''), 100) !!}
                                    </p>

                                    <!-- Read More Button -->
                                    <a href="{{ route('detail-berita', ['slug' => $post->slug]) }}"
                                       class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-semibold text-sm group-hover:gap-3 transition-all">
                                        <span>Read More</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        @if($latestPosts->count() === 0)
                            <div class="col-span-2 text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <p class="text-gray-500">Belum ada berita terbaru</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Terbaru -->
                <div class="lg:col-span-4">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-200">
                        <h2 class="text-3xl font-heading font-bold text-gray-900">
                            Informasi Terbaru
                        </h2>
                        <a href="/informasi" class="text-gray-600 hover:text-primary-600 font-medium text-sm transition-colors">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach($latestInformations as $info)
                            <a href="{{ route('information-download', $info->id) }}"
                               class="block group bg-white rounded-xl p-4 border border-gray-200 hover:border-primary-300 hover:shadow-md transition-all duration-300">
                                <div class="flex gap-4">
                                    <!-- Content -->
                                    <div class="flex-1">
                                        <!-- Category Badge -->
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded bg-primary-600 text-white mb-3">
                                            {{ $info->category->name }}
                                        </span>

                                        <!-- Title -->
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                            {{ $info->title }}
                                        </h3>

                                        <!-- Date & Time -->
                                        <p class="text-sm text-gray-500">
                                            {{ $info->created_at->locale('id')->isoFormat('dddd, DD MMMM YYYY') }} | {{ $info->created_at->format('H:i') }} WIB
                                        </p>
                                    </div>

                                    <!-- Image/Icon -->
                                    <div class="w-24 h-24 flex-shrink-0 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-primary-50 transition-colors">
                                        @php
                                            $extension = pathinfo($info->file ?? '', PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array(strtolower($extension), ['pdf']))
                                            <svg class="w-12 h-12 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        @elseif(in_array(strtolower($extension), ['doc', 'docx']))
                                            <svg class="w-12 h-12 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        @else
                                            <svg class="w-12 h-12 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        @if($latestInformations->count() === 0)
                            <div class="text-center py-8">
                                <p class="text-gray-500">Belum ada informasi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
