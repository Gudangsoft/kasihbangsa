<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                Testimoni Alumni
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                Pendapat mereka yang telah merasakan pendidikan di STP Dian Mandala
            </p>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="py-16 lg:py-24">
        <div class="container">
            @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                @foreach($testimonials as $item)
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 100 }}">
                    <!-- Quote Icon -->
                    <div class="mb-6">
                        <svg class="w-12 h-12 text-primary-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="mb-6">
                        <p class="text-gray-600 leading-relaxed">
                            {!! nl2br(strip_tags($item->description)) !!}
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
                            <img src="{{ $item->avatar }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-heading font-semibold text-gray-900">{{ $item->name }}</h4>
                            <p class="text-sm text-gray-500">Alumni {{ $item->year ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada testimoni yang dipublikasikan.</p>
            </div>
            @endif
        </div>
    </section>
</div>
