<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-20">
        <div class="container">
            <a href="{{ route('prodi') }}" class="inline-flex items-center text-gray-200 hover:text-white mb-6 text-sm font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Program Studi
            </a>
            <div class="flex flex-col lg:flex-row items-center lg:items-end gap-8">
                <div class="w-full lg:w-64 h-40 rounded-xl overflow-hidden ring-4 ring-white/20 flex-shrink-0">
                    <img src="{{ $prodi->image_url }}" alt="{{ $prodi->name }}" class="w-full h-full object-cover">
                </div>
                <div class="text-center lg:text-left">
                    @if($prodi->jenjang)
                    <span class="inline-block px-3 py-1 bg-gold-500 text-navy-900 rounded-full text-xs font-bold mb-3">
                        {{ $prodi->jenjang }}
                    </span>
                    @endif
                    <h1 class="text-2xl md:text-4xl font-heading font-bold">{{ $prodi->name }}</h1>
                    @if($prodi->description)
                    <p class="text-gray-200 mt-3 max-w-2xl">{{ $prodi->description }}</p>
                    @endif
                </div>
            </div>
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
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4">Visi, Misi &amp; Tujuan</h2>
                    @if($prodi->visi)
                    <div class="mb-4">
                        <h3 class="font-semibold text-primary-600 mb-1">Visi</h3>
                        <p class="text-gray-600">{{ $prodi->visi }}</p>
                    </div>
                    @endif
                    @if($prodi->misi)
                    <div class="mb-4">
                        <h3 class="font-semibold text-primary-600 mb-1">Misi</h3>
                        <ol class="list-decimal list-inside space-y-1 text-gray-600">
                            @foreach($prodi->misi as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
                    @if($prodi->tujuan)
                    <div>
                        <h3 class="font-semibold text-primary-600 mb-1">Tujuan</h3>
                        <ol class="list-decimal list-inside space-y-1 text-gray-600">
                            @foreach($prodi->tujuan as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
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
