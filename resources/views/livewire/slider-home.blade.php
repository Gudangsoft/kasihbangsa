<!-- Hero Slider Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800">
    @if(count($slides) > 0)
        <div x-data="{
            currentSlide: 0,
            slides: {{ count($slides) }},
            autoplay: null,
            parallaxOffset: 0,
            init() {
                this.startAutoplay();
                this.handleParallax();
                window.addEventListener('scroll', () => this.handleParallax());
            },
            handleParallax() {
                const scrolled = window.pageYOffset;
                const heroHeight = this.$refs.heroSection?.offsetHeight || 0;
                if (scrolled < heroHeight) {
                    this.parallaxOffset = scrolled * 0.5;
                }
            },
            startAutoplay() {
                this.autoplay = setInterval(() => {
                    this.next();
                }, 5000);
            },
            stopAutoplay() {
                clearInterval(this.autoplay);
            },
            next() {
                this.currentSlide = (this.currentSlide + 1) % this.slides;
            },
            prev() {
                this.currentSlide = (this.currentSlide - 1 + this.slides) % this.slides;
            },
            goTo(index) {
                this.currentSlide = index;
                this.stopAutoplay();
                this.startAutoplay();
            }
        }" class="relative" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()" x-ref="heroSection">

            <!-- Slides -->
            <div class="relative w-full aspect-[25/13] max-h-[1000px]">
                @foreach($slides as $index => $slide)
                <div x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0"
                     style="display: {{ $index === 0 ? 'block' : 'none' }}">

                    <!-- Background Image -->
                    <div class="absolute inset-0 overflow-hidden bg-navy-900">
                        <img src="{{ asset('storage/' . $slide['image']) }}"
                             alt="{{ $slide['title'] }}"
                             class="w-full h-full object-cover object-top">
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Arrows -->
            @if(count($slides) > 1)
            <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between pointer-events-none z-10">
                <button @click="prev(); stopAutoplay(); startAutoplay();"
                        class="ml-4 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white flex items-center justify-center transition-all duration-300 hover:scale-110 pointer-events-auto">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button @click="next(); stopAutoplay(); startAutoplay();"
                        class="mr-4 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white flex items-center justify-center transition-all duration-300 hover:scale-110 pointer-events-auto">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Indicators -->
            <div class="absolute bottom-8 left-0 right-0 z-10">
                <div class="container flex justify-center space-x-3">
                    @foreach($slides as $index => $slide)
                    <button @click="goTo({{ $index }})"
                            :class="currentSlide === {{ $index }} ? 'w-12 bg-white' : 'w-3 bg-white/50 hover:bg-white/70'"
                            class="h-3 rounded-full transition-all duration-300">
                    </button>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    @else
        <!-- Default Hero without Slides -->
        <div class="relative h-[250px] md:h-[300px] lg:h-[325px] flex items-center">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-800"></div>
            <div class="relative container mx-auto px-4 text-white text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-6 animate-slide-up">
                    Selamat Datang di {{ company()->name }}
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto animate-fade-in">
                    {{ company()->description ?? 'Membentuk Generasi Beriman, Berilmu, dan Berkarakter' }}
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="#about" class="btn btn-primary bg-white text-primary-600 hover:bg-gray-100">
                        Tentang Kami
                    </a>
                    <a href="/#contact" class="btn btn-outline border-white text-white hover:bg-white hover:text-primary-600">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Decorative Bottom Bar -->
    <div class="absolute bottom-0 left-0 right-0 h-1.5 md:h-2 bg-navy-900"></div>
</section>
