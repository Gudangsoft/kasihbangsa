<div>
    <!-- Hero Header with Gradient -->
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
                <span class="text-white font-medium">{{ $page->title }}</span>
            </nav>

            <!-- Page Title -->
            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4 animate-slide-up leading-tight">
                    {{ $page->title }}
                </h1>
                @if($page->menu)
                    <div class="flex items-center gap-2 text-primary-200 animate-fade-in" style="animation-delay: 0.1s;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ $page->menu->name ?? 'Halaman' }}</span>
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

    <!-- Main Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">

                <!-- Content Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 animate-fade-in">
                    <div class="p-8 md:p-12">
                        <!-- Content -->
                        <div class="prose prose-lg max-w-none
                                    prose-headings:font-heading prose-headings:font-bold prose-headings:text-gray-900
                                    prose-h1:text-4xl prose-h1:mb-6 prose-h1:border-b prose-h1:border-primary-200 prose-h1:pb-4
                                    prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-4 prose-h2:text-primary-900
                                    prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-3 prose-h3:text-primary-800
                                    prose-h4:text-xl prose-h4:mt-6 prose-h4:mb-2
                                    prose-p:text-gray-700 prose-p:leading-relaxed prose-p:mb-4
                                    prose-a:text-primary-600 prose-a:no-underline hover:prose-a:text-primary-700 hover:prose-a:underline
                                    prose-strong:text-gray-900 prose-strong:font-semibold
                                    prose-ul:my-6 prose-ol:my-6
                                    prose-li:text-gray-700 prose-li:my-2
                                    prose-blockquote:border-l-4 prose-blockquote:border-primary-500 prose-blockquote:bg-primary-50 prose-blockquote:py-4 prose-blockquote:px-6 prose-blockquote:rounded-r-lg
                                    prose-img:rounded-xl prose-img:shadow-lg prose-img:my-8
                                    prose-table:border-collapse prose-table:w-full
                                    prose-th:bg-primary-600 prose-th:text-white prose-th:p-3 prose-th:text-left
                                    prose-td:border prose-td:border-gray-300 prose-td:p-3
                                    prose-code:bg-gray-100 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-primary-700
                                    prose-pre:bg-gray-900 prose-pre:text-gray-100 prose-pre:p-4 prose-pre:rounded-xl">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>

                <!-- Files Section -->
                @if(isset($page->file) && count($page->file) > 0)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
                        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-heading font-bold text-white">{{ $page->filename ?? 'Dokumen & File' }}</h2>
                                    <p class="text-primary-100 text-sm">{{ count($page->file) }} file tersedia untuk diunduh</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                @foreach($page->file as $item)
                                    @php
                                        $ext = strtolower(pathinfo(is_object($item) ? $item->name ?? $item : $item, PATHINFO_EXTENSION));
                                        $icons = [
                                            'pdf' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>', 'color' => 'text-red-500', 'bg' => 'bg-red-50'],
                                            'doc' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                            'docx' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                            'xls' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>', 'color' => 'text-green-500', 'bg' => 'bg-green-50'],
                                            'xlsx' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>', 'color' => 'text-green-500', 'bg' => 'bg-green-50'],
                                            'ppt' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>', 'color' => 'text-orange-500', 'bg' => 'bg-orange-50'],
                                            'pptx' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>', 'color' => 'text-orange-500', 'bg' => 'bg-orange-50'],
                                            'jpg' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                                            'jpeg' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                                            'png' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                                            'gif' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                                            'zip' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>', 'color' => 'text-yellow-600', 'bg' => 'bg-yellow-50'],
                                            'rar' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>', 'color' => 'text-yellow-600', 'bg' => 'bg-yellow-50'],
                                        ];
                                        $iconData = $icons[$ext] ?? ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>', 'color' => 'text-gray-500', 'bg' => 'bg-gray-50'];
                                        $filename = is_object($item) ? ($item->name ?? basename($item)) : basename($item);
                                        $filepath = is_object($item) ? (property_exists($item, 'path') ? $item->path : $item) : $item;
                                    @endphp
                                    <a href="{{ asset('storage/' . $filepath) }}"
                                       target="_blank"
                                       class="group relative bg-white border-2 border-gray-200 rounded-xl p-5 hover:border-primary-400 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">

                                        <!-- Icon -->
                                        <div class="flex flex-col items-center text-center">
                                            <div class="w-16 h-16 {{ $iconData['bg'] }} rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-8 h-8 {{ $iconData['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $iconData['icon'] !!}
                                                </svg>
                                            </div>

                                            <!-- Filename -->
                                            <div class="w-full">
                                                <p class="text-sm font-medium text-gray-900 truncate mb-1" title="{{ $filename }}">
                                                    {{ Str::limit($filename, 20) }}
                                                </p>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $iconData['bg'] }} {{ $iconData['color'] }}">
                                                    {{ strtoupper($ext) }}
                                                </span>
                                            </div>

                                            <!-- Download Icon -->
                                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 right-8 bg-primary-600 text-white p-4 rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 hover:scale-110 z-40"
            x-data="{ show: false }"
            x-show="show"
            @scroll.window="show = window.pageYOffset > 400"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            style="display: none;">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</div>
