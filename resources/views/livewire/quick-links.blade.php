<div>
    @if(count($links) > 0)
        <section class="py-12 lg:py-16 bg-white">
            <div class="container">
                <div class="text-center mb-10">
                    <span class="inline-block px-4 py-2 bg-navy-50 text-navy-900 rounded-full text-sm font-medium mb-4">
                        Akses Cepat
                    </span>
                    <h2 class="section-title !mb-0">
                        Layanan Online
                    </h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach($links as $link)
                        <a href="{{ $link->url }}"
                           @if(str_starts_with($link->url, 'http')) target="_blank" rel="noopener" @endif
                           class="group relative block aspect-[4/3] rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                           data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                            @if($link->image)
                                <img src="{{ asset('storage/' . $link->image) }}"
                                     alt="{{ $link->title }}"
                                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-navy-900/85 via-navy-900/40 to-navy-900/10"></div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-navy-800 to-navy-900"></div>
                            @endif

                            <div class="relative h-full flex flex-col items-center justify-center text-center p-4">
                                @if($link->icon)
                                    <div class="mb-3 text-gold-400">
                                        @svg($link->icon, 'w-8 h-8 md:w-9 md:h-9')
                                    </div>
                                @endif
                                <span class="text-white font-heading font-bold text-base md:text-lg leading-snug">
                                    {{ $link->title }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
