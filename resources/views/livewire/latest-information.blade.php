<div>
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-sm font-medium mb-4">
                    Informasi Terbaru
                </span>
                <h2 class="section-title">
                    Dokumen & Informasi Penting
                </h2>
                <p class="section-subtitle max-w-2xl mx-auto">
                    Akses dokumen dan informasi penting yang Anda butuhkan
                </p>
            </div>

            @if($information->count() > 0)
                <!-- Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($information as $item)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Document Icon Header -->
                            <div class="bg-gradient-to-r from-primary-600 to-primary-700 p-6">
                                <div class="flex items-center justify-between">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                        @php
                                            $extension = pathinfo($item->file, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($extension, ['pdf']))
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 18h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/>
                                                <text x="6" y="14" font-size="6" fill="white" font-weight="bold">PDF</text>
                                            </svg>
                                        @elseif(in_array($extension, ['doc', 'docx']))
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 2h8l4 4v12H4V2zm8 0v4h4l-4-4z"/>
                                                <text x="5" y="14" font-size="5" fill="white" font-weight="bold">DOC</text>
                                            </svg>
                                        @elseif(in_array($extension, ['xls', 'xlsx']))
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 2h8l4 4v12H4V2zm8 0v4h4l-4-4z"/>
                                                <text x="5" y="14" font-size="5" fill="white" font-weight="bold">XLS</text>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    @if($item->category)
                                        <span class="text-xs font-medium text-white/90 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                            {{ $item->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-heading font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors duration-200">
                                    {{ $item->title }}
                                </h3>

                                @if($item->description)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                        {{ $item->short_description }}
                                    </p>
                                @endif

                                <!-- Meta Info -->
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4 pb-4 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center uppercase font-medium text-primary-600">
                                        {{ strtoupper($extension ?? 'FILE') }}
                                    </div>
                                </div>

                                <!-- Download Button -->
                                <a href="{{ $item->file_download }}"
                                   download
                                   class="flex items-center justify-center w-full px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200 group/btn">
                                    <svg class="w-5 h-5 mr-2 group-hover/btn:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Unduh Dokumen
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center mt-12">
                    <a href="/informasi" class="btn btn-outline inline-flex items-center">
                        Lihat Semua Informasi
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500">Belum ada informasi tersedia</p>
                </div>
            @endif
        </div>
    </section>
</div>
