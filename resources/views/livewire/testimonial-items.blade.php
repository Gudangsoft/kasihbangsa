<!-- Testimonials Section -->
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="container">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-sm font-medium mb-4">
                Testimonial Alumni
            </span>
            <h2 class="section-title">
                Pendapat Mereka Tentang Kami
            </h2>
            <p class="section-subtitle max-w-2xl mx-auto">
                Testimoni dari alumni yang telah merasakan pendidikan di STP Dian Mandala
            </p>
        </div>

        @if(count($items) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($items as $item)
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Quote Icon -->
                <div class="mb-6">
                    <svg class="w-12 h-12 text-primary-200" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <p class="text-gray-600 leading-relaxed">
                        {!! Str::limit(strip_tags($item['description']), 200) !!}
                    </p>
                </div>

                <!-- Rating -->
                <div class="flex items-center mb-6">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                    @endfor
                </div>

                <!-- Author -->
                <div class="flex items-center">
                    <div class="w-14 h-14 rounded-full overflow-hidden mr-4 ring-2 ring-primary-100">
                        <img src="{{ $item['avatar'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-heading font-semibold text-gray-900">{{ $item['name'] }}</h4>
                        <p class="text-sm text-gray-500">Alumni</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        @if(count($items) >= 4)
        <div class="text-center mt-12">
            <a href="/testimoni" class="btn btn-primary inline-flex items-center">
                Lihat Semua Testimoni
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <p class="text-gray-500">Belum ada testimonial.</p>
        </div>
        @endif
    </div>
</section>
