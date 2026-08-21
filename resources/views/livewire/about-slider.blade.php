<div>
    @if(count($slides) > 0)
        <div x-data="{
            currentSlide: 0,
            slides: {{ count($slides) }},
            autoplay: null,
            init() {
                this.startAutoplay();
            },
            startAutoplay() {
                this.autoplay = setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.slides;
                }, 4000);
            },
            stopAutoplay() {
                clearInterval(this.autoplay);
            }
        }" class="relative aspect-[4/5]" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()">
            @foreach($slides as $index => $slide)
                <div x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0"
                     style="display: {{ $index === 0 ? 'block' : 'none' }}">
                    <a href="{{ $slide['url'] ?: '#' }}"
                       @if(str_starts_with($slide['url'] ?? '', 'http')) target="_blank" rel="noopener" @endif
                       class="block w-full h-full">
                        <img src="{{ asset('storage/' . $slide['image']) }}"
                             alt="{{ $slide['title'] }}"
                             class="w-full h-full object-cover">
                    </a>
                </div>
            @endforeach

            @if(count($slides) > 1)
                <div class="absolute bottom-4 left-0 right-0 z-10 flex justify-center space-x-2">
                    @foreach($slides as $index => $slide)
                        <button @click="currentSlide = {{ $index }}; stopAutoplay(); startAutoplay();"
                                :class="currentSlide === {{ $index }} ? 'w-6 bg-white' : 'w-2 bg-white/50 hover:bg-white/70'"
                                class="h-2 rounded-full transition-all duration-300">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        @if(homeSettings()->about_image)
            <img src="{{ Storage::url(homeSettings()->about_image) }}"
                 alt="{{ homeSettings()->about_title ?? company()->name }}"
                 class="w-full h-auto">
        @else
            <img src="{{ asset('assets/images/resources/about-four-img-1.jpg') }}"
                 alt="{{ company()->name }}"
                 class="w-full h-auto">
        @endif
    @endif
</div>
