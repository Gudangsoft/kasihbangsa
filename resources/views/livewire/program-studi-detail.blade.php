<div>
    <!-- Page Header -->
    <section class="relative text-white overflow-hidden">
        <div class="absolute inset-0">
            @if($prodi->image)
            <img src="{{ $prodi->image_url }}" alt="{{ $prodi->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900 via-primary-900/85 to-primary-900/50"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-900/95 via-primary-900/40 to-transparent"></div>
            @else
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-900"></div>
            @endif
        </div>

        <div class="container relative z-10 py-14 lg:py-28">
            <a href="{{ route('prodi') }}" class="inline-flex items-center gap-1.5 text-gray-200 hover:text-gold-400 mb-6 text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Program Studi
            </a>

            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if($prodi->jenjang)
                <span class="inline-flex items-center px-3 py-1 bg-gold-500 text-primary-900 rounded-full text-xs font-bold">
                    {{ $prodi->jenjang }}
                </span>
                @endif
                @if($prodi->akreditasi)
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-white/15 backdrop-blur-sm ring-1 ring-white/30 rounded-full text-xs font-semibold">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Akreditasi {{ $prodi->akreditasi }}
                </span>
                @endif
            </div>

            <h1 class="text-3xl md:text-5xl font-heading font-bold max-w-3xl leading-tight">{{ $prodi->name }}</h1>
            @if($prodi->description)
            <p class="text-gray-200 mt-4 max-w-2xl text-base md:text-lg leading-relaxed text-justify">{{ $prodi->description }}</p>
            @endif
        </div>
    </section>

    @php
        $jumpSections = collect([
            ['id' => 'visi-misi', 'label' => 'Visi & Misi', 'show' => (bool) ($prodi->visi || $prodi->misi || $prodi->tujuan)],
            ['id' => 'profil-lulusan', 'label' => 'Profil Lulusan', 'show' => (bool) $prodi->profil_lulusan],
            ['id' => 'kurikulum', 'label' => 'Kurikulum', 'show' => (bool) $prodi->kurikulum],
            ['id' => 'fasilitas', 'label' => 'Fasilitas', 'show' => (bool) $prodi->fasilitas],
            ['id' => 'dosen', 'label' => 'Dosen Pengampu', 'show' => $dosens->count() > 0],
        ])->filter(fn ($section) => $section['show']);
    @endphp

    @if($jumpSections->count() > 1)
    <div class="sticky top-20 z-20 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm">
        <div class="container">
            <nav class="flex gap-1 overflow-x-auto py-3">
                @foreach($jumpSections as $section)
                <a href="#{{ $section['id'] }}" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-50 whitespace-nowrap transition-colors">
                    {{ $section['label'] }}
                </a>
                @endforeach
            </nav>
        </div>
    </div>
    @endif

    <section class="py-12 lg:py-16">
        <div class="container grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Info Box -->
            <div class="lg:col-span-1">
                <div class="space-y-6 sticky top-24">
                    <div class="bg-white rounded-xl shadow-lg p-6 space-y-3">
                        <h3 class="font-heading font-bold text-gray-900 mb-3">Informasi Program</h3>
                        @if($prodi->jenjang)
                        <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                            <span class="text-gray-500">Jenjang</span>
                            <span class="font-medium text-gray-900">{{ $prodi->jenjang }}</span>
                        </div>
                        @endif
                        @if($prodi->gelar)
                        <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                            <span class="text-gray-500">Gelar Lulusan</span>
                            <span class="font-medium text-gray-900">{{ $prodi->gelar }}</span>
                        </div>
                        @endif
                        @if($prodi->akreditasi)
                        <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                            <span class="text-gray-500">Akreditasi</span>
                            <span class="font-medium text-gray-900">{{ $prodi->akreditasi }}</span>
                        </div>
                        @endif
                        @if($prodi->akreditasi_sk)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">No. SK Akreditasi</span>
                            <span class="font-medium text-gray-900 text-right">{{ $prodi->akreditasi_sk }}</span>
                        </div>
                        @endif

                        <a href="{{ route('search') }}" class="btn btn-primary w-full text-center inline-flex items-center justify-center mt-4">
                            Info Pendaftaran
                        </a>
                    </div>

                    @if(count($prodi->image_urls) > 0)
                    <div class="rounded-xl shadow-lg overflow-hidden">
                        <div x-data="{
                            currentSlide: 0,
                            slides: {{ count($prodi->image_urls) }},
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
                        }" class="relative aspect-[3/4]" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()">
                            @foreach($prodi->image_urls as $index => $url)
                            <div x-show="currentSlide === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-500"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="absolute inset-0"
                                 style="display: {{ $index === 0 ? 'block' : 'none' }}">
                                <img src="{{ $url }}" alt="{{ $prodi->name }}" class="w-full h-full object-cover">
                            </div>
                            @endforeach

                            @if(count($prodi->image_urls) > 1)
                            <div class="absolute bottom-3 left-0 right-0 z-10 flex justify-center gap-1.5">
                                @foreach($prodi->image_urls as $index => $url)
                                <button @click="currentSlide = {{ $index }}; stopAutoplay(); startAutoplay();"
                                        :class="currentSlide === {{ $index }} ? 'w-5 bg-white' : 'w-1.5 bg-white/50 hover:bg-white/70'"
                                        class="h-1.5 rounded-full transition-all duration-300">
                                </button>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @php
                        $prodiSocials = collect([
                            ['url' => $prodi->instagram, 'label' => 'Instagram', 'color' => 'hover:bg-pink-600', 'path' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'],
                            ['url' => $prodi->facebook, 'label' => 'Facebook', 'color' => 'hover:bg-blue-600', 'path' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'],
                            ['url' => $prodi->youtube, 'label' => 'YouTube', 'color' => 'hover:bg-red-600', 'path' => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z'],
                            ['url' => $prodi->tiktok, 'label' => 'TikTok', 'color' => 'hover:bg-black', 'path' => 'M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z'],
                        ])->filter(fn ($s) => $s['url']);
                    @endphp

                    @if($prodiSocials->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="font-heading font-bold text-gray-900 mb-3">Ikuti Kami</h3>
                        <div class="flex gap-2">
                            @foreach($prodiSocials as $social)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                               class="w-10 h-10 bg-primary-700 {{ $social['color'] }} rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
                               aria-label="{{ $social['label'] }}">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $social['path'] }}"/>
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="lg:col-span-2 space-y-10">
                @if($prodi->visi || $prodi->misi || $prodi->tujuan)
                <div id="visi-misi" class="scroll-mt-36">
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-5">Visi, Misi &amp; Tujuan</h2>

                    @if($prodi->visi)
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 text-white rounded-xl shadow-lg p-6 mb-5">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="font-heading font-bold">Visi</h3>
                        </div>
                        <p class="text-gray-100 leading-relaxed">{{ $prodi->visi }}</p>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @if($prodi->misi)
                        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-9 h-9 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </div>
                                <h3 class="font-heading font-bold text-gray-900">Misi</h3>
                            </div>
                            <ul class="space-y-2.5">
                                @foreach($prodi->misi as $item)
                                <li class="flex items-start gap-2 text-gray-600 text-sm leading-relaxed">
                                    <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($prodi->tujuan)
                        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-9 h-9 rounded-full bg-gold-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/>
                                    </svg>
                                </div>
                                <h3 class="font-heading font-bold text-gray-900">Tujuan</h3>
                            </div>
                            <ol class="space-y-2.5">
                                @foreach($prodi->tujuan as $index => $item)
                                <li class="flex items-start gap-2.5 text-gray-600 text-sm leading-relaxed">
                                    <span class="flex-shrink-0 w-5 h-5 rounded-full bg-gold-100 text-gold-700 text-xs font-bold flex items-center justify-center mt-0.5">{{ $index + 1 }}</span>
                                    <span>{{ $item }}</span>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($prodi->profil_lulusan)
                <div id="profil-lulusan" class="scroll-mt-36">
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Profil Lulusan &amp; Prospek Karir</h2>
                    <div class="prose max-w-none tinymce-content">
                        {!! $prodi->profil_lulusan !!}
                    </div>
                </div>
                @endif

                @if($prodi->kurikulum)
                <div id="kurikulum" class="scroll-mt-36">
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Kurikulum</h2>
                    <div class="prose max-w-none tinymce-content">
                        {!! $prodi->kurikulum !!}
                    </div>
                </div>
                @endif

                @if($prodi->fasilitas)
                <div id="fasilitas" class="scroll-mt-36">
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-5">Fasilitas</h2>
                    @if(count($prodi->fasilitas_list) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($prodi->fasilitas_list as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col items-center text-center gap-2 hover:shadow-md hover:-translate-y-0.5 transition-all">
                            <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="prose max-w-none tinymce-content">
                        {!! $prodi->fasilitas !!}
                    </div>
                    @endif
                </div>
                @endif

                @if($dosens->count() > 0)
                <div id="dosen" class="scroll-mt-36">
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Dosen Pengampu</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($dosens as $dosen)
                        <a href="{{ $dosen->detail_url }}" class="text-center group">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden ring-2 ring-primary-100 mb-2">
                                <img src="{{ $dosen->photo_url }}" alt="{{ $dosen->name }}" class="w-full h-full object-cover">
                            </div>
                            <p class="text-sm font-medium text-gray-900 group-hover:text-primary-600 transition-colors">{{ $dosen->name }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
