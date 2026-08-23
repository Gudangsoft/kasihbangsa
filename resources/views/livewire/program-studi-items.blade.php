<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                Program Studi
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                Pilihan program studi di {{ company()->name }}
            </p>
        </div>
    </section>

    <!-- Program Studi Grid -->
    <section class="py-16 lg:py-24">
        <div class="container">
            @if(count($items) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($items as $item)
                <a href="{{ $item->detail_url }}"
                   class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col"
                   data-aos="fade-up"
                   data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative overflow-hidden h-48">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @if($item->jenjang)
                        <span class="absolute top-4 left-4 px-3 py-1 bg-primary-600 text-white rounded-full text-xs font-bold">
                            {{ $item->jenjang }}
                        </span>
                        @endif
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-heading font-bold text-gray-900 group-hover:text-primary-600 transition-colors mb-2">
                            {{ $item->name }}
                        </h3>
                        @if($item->description)
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-1">
                            {{ Str::limit($item->description, 120) }}
                        </p>
                        @endif
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            @if($item->akreditasi)
                            <span class="text-xs font-semibold text-gray-500">
                                Akreditasi: <span class="text-primary-600">{{ $item->akreditasi }}</span>
                            </span>
                            @endif
                            <span class="inline-flex items-center text-primary-600 text-sm font-semibold">
                                Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada program studi yang dipublikasikan.</p>
            </div>
            @endif
        </div>
    </section>
</div>
