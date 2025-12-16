<div>
    <style>
        /* TinyMCE Content Styling */
        .tinymce-content img {
            max-width: 100%;
            height: auto;
            display: inline-block;
        }

        /* Support for floated images */
        .tinymce-content img[style*="float: left"],
        .tinymce-content img[style*="float:left"] {
            float: left !important;
            margin-right: 1rem;
            margin-bottom: 1rem;
        }

        .tinymce-content img[style*="float: right"],
        .tinymce-content img[style*="float:right"] {
            float: right !important;
            margin-left: 1rem;
            margin-bottom: 1rem;
        }

        /* Support for inline images */
        .tinymce-content p img {
            display: inline-block;
            vertical-align: middle;
        }

        /* Support for image alignment */
        .tinymce-content img[style*="display: inline"],
        .tinymce-content img[style*="display:inline"] {
            display: inline !important;
        }

        /* Preserve TinyMCE table styling */
        .tinymce-content table {
            width: auto !important;
            margin: 1rem 0;
        }

        .tinymce-content table td,
        .tinymce-content table th {
            padding: 0.5rem;
        }

        /* Clear floats after content */
        .tinymce-content::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Support for figures with images */
        .tinymce-content figure {
            display: inline-block;
            margin: 0;
        }

        .tinymce-content figure img {
            display: block;
        }
    </style>

    <!-- Article Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-24">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li><a href="/" class="hover:text-gray-200">Beranda</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li><a href="/berita" class="hover:text-gray-200">Berita</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li class="text-gray-300">{{ Str::limit($title, 50) }}</li>
                    </ol>
                </nav>

                <!-- Category & Date -->
                <div class="flex items-center space-x-4 mb-6">
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                        {{ $post->category->name }}
                    </span>
                    <span class="text-gray-200">{{ $post->date('d F Y') }}</span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-6">
                    {{ $title }}
                </h1>

                <!-- Author Info -->
                <div class="flex items-center">
                    <img src="{{ $post->user->profile_photo_url }}"
                         alt="{{ $post->user->name }}"
                         class="w-12 h-12 rounded-full mr-4 ring-2 ring-white/50">
                    <div>
                        <p class="font-medium">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-200">Penulis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-12 lg:py-16">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <!-- Featured Image -->
                <div class="rounded-2xl overflow-hidden shadow-xl mb-12">
                    <img src="{{ $post->thumbnail }}"
                         alt="{{ $post->title }}"
                         class="w-full h-auto">
                </div>

                <!-- Content -->
                <article class="prose prose-lg max-w-none mb-12 tinymce-content">
                    {!! $post->content !!}
                </article>

                <!-- Tags & Share -->
                <div class="border-t border-b border-gray-200 py-6 mb-12">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <!-- Tags -->
                        <div class="flex items-center flex-wrap gap-2">
                            <span class="text-gray-600 font-medium">Tags:</span>
                            {!! $post->tag !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 font-medium">Bagikan:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                               target="_blank"
                               class="w-10 h-10 flex items-center justify-center bg-sky-500 text-white rounded-full hover:bg-sky-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}"
                               target="_blank"
                               class="w-10 h-10 flex items-center justify-center bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mb-16">
                    <a href="/berita" class="btn btn-outline inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                        </svg>
                        Kembali ke Berita
                    </a>
                </div>

                <!-- Related Posts Section -->
                @if($relatedPosts->count() > 0)
                <div class="border-t border-gray-200 pt-12">
                    <h2 class="text-2xl md:text-3xl font-heading font-bold mb-8 text-gray-900">
                        Berita Terkait
                    </h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedPosts as $related)
                        <article class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                            <a href="{{ route('detail-berita', $related->slug) }}" class="block">
                                <div class="aspect-video overflow-hidden bg-gray-100">
                                    <img src="{{ $related->thumbnail }}"
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-medium rounded-full">
                                            {{ $related->category->name }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $related->publish_at ? \Carbon\Carbon::parse($related->publish_at)->locale('id')->isoFormat('D MMM Y') : '' }}
                                        </span>
                                    </div>
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                        {{ $related->title }}
                                    </h3>
                                    @if($related->preview)
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $related->preview }}
                                    </p>
                                    @endif
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
