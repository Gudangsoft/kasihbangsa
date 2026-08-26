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

    <section class="py-12 lg:py-16">
        <div class="container grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Info Box -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 space-y-3 sticky top-24">
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
            </div>

            <!-- Content -->
            <div class="lg:col-span-2 space-y-10">
                @if($prodi->visi || $prodi->misi || $prodi->tujuan)
                <div>
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

                @if($prodi->kurikulum)
                <div>
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Kurikulum</h2>
                    <div class="prose max-w-none tinymce-content">
                        {!! $prodi->kurikulum !!}
                    </div>
                </div>
                @endif

                @if($prodi->profil_lulusan)
                <div>
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Profil Lulusan &amp; Prospek Karir</h2>
                    <div class="prose max-w-none tinymce-content">
                        {!! $prodi->profil_lulusan !!}
                    </div>
                </div>
                @endif

                @if($prodi->fasilitas)
                <div>
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Fasilitas</h2>
                    <div class="prose max-w-none tinymce-content">
                        {!! $prodi->fasilitas !!}
                    </div>
                </div>
                @endif

                @if($dosens->count() > 0)
                <div>
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
