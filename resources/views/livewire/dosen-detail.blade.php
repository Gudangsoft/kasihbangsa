<div>
    <!-- Page Header -->
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-900 text-white py-16 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container relative z-10">
            <a href="{{ route('dosen') }}" class="inline-flex items-center gap-1.5 text-gray-200 hover:text-gold-400 mb-8 text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Dosen
            </a>
            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6">
                <div class="w-32 h-32 sm:w-36 sm:h-36 rounded-full overflow-hidden ring-4 ring-white/30 shadow-2xl flex-shrink-0">
                    <img src="{{ $dosen->photo_url }}" alt="{{ $dosen->name }}" class="w-full h-full object-cover">
                </div>
                <div class="text-center sm:text-left">
                    @if($dosen->jabatan_institusi)
                    <span class="inline-flex items-center px-3 py-1 bg-gold-500 text-primary-900 rounded-full text-xs font-bold mb-3">
                        {{ $dosen->jabatan_institusi }}
                    </span>
                    @endif
                    <h1 class="text-2xl md:text-4xl font-heading font-bold leading-tight">{{ $dosen->name }}</h1>
                    @if($dosen->prodi)
                    <p class="text-gray-200 mt-2 text-base md:text-lg">Program Studi {{ $dosen->prodi }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @php
        $dosenSections = collect([
            ['id' => 'riwayat-pendidikan', 'label' => 'Riwayat Pendidikan', 'show' => (bool) $dosen->riwayat_pendidikan],
            ['id' => 'penelitian', 'label' => 'Penelitian', 'show' => (bool) $dosen->penelitian],
            ['id' => 'pengabdian', 'label' => 'Pengabdian Masyarakat', 'show' => (bool) $dosen->pengabdian_masyarakat],
            ['id' => 'capaian', 'label' => 'Capaian Khusus', 'show' => (bool) $dosen->capaian_khusus],
        ])->filter(fn ($section) => $section['show']);
    @endphp

    @if($dosenSections->count() > 1)
    <div class="sticky top-20 z-20 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm">
        <div class="container">
            <nav class="flex gap-1 overflow-x-auto py-3">
                @foreach($dosenSections as $section)
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
                <div class="bg-white rounded-xl shadow-lg p-6 space-y-1">
                    <h3 class="font-heading font-bold text-gray-900 mb-3">Data Dosen</h3>

                    @php
                        $dosenFields = [
                            ['label' => 'NIDN', 'value' => $dosen->nidn, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                            ['label' => 'Jab. Akademik', 'value' => $dosen->jabatan_akademik, 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                            ['label' => 'Jab. Institusi', 'value' => $dosen->jabatan_institusi, 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m16 0h-2M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 6v-3a1 1 0 011-1h0a1 1 0 011 1v3'],
                            ['label' => 'Status', 'value' => $dosen->status_dosen, 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['label' => 'Sertifikasi', 'value' => $dosen->sertifikasi_dosen, 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                        ];
                        $dosenFields = collect($dosenFields)->filter(fn ($f) => $f['value']);
                    @endphp

                    @foreach($dosenFields as $field)
                    <div class="flex items-start gap-3 py-2.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $field['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs text-gray-500">{{ $field['label'] }}</div>
                            <div class="font-medium text-gray-900 text-sm break-words">{{ $field['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if(!empty($dosen->links))
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="font-heading font-bold text-gray-900 mb-3">Tautan Terkait</h3>
                    <div class="flex flex-col gap-2">
                        @foreach($dosen->links as $link)
                        @if(!empty($link['url']))
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener"
                           class="flex items-center justify-between gap-2 px-3 py-2 rounded-lg bg-gray-50 hover:bg-primary-50 text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors group">
                            <span class="truncate">{{ $link['label'] ?? $link['url'] }}</span>
                            <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
                </div>
            </div>

            <!-- Riwayat -->
            <div class="lg:col-span-2 space-y-6">
                @if($dosen->riwayat_pendidikan)
                <div id="riwayat-pendidikan" class="scroll-mt-36 bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12v5c0 1.657 2.686 3 6 3s6-1.343 6-3v-5"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-bold text-gray-900">Riwayat Pendidikan</h3>
                    </div>
                    <ul class="space-y-3">
                        @foreach($dosen->riwayat_pendidikan as $item)
                        <li class="flex items-start gap-3 text-gray-600 text-sm leading-relaxed">
                            <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{!! \App\Models\Dosen::linkify($item) !!}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($dosen->penelitian)
                <div id="penelitian" class="scroll-mt-36 bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-full bg-gold-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-bold text-gray-900">Penelitian</h3>
                    </div>
                    <ol class="space-y-3">
                        @foreach($dosen->penelitian as $index => $item)
                        <li class="flex items-start gap-3 text-gray-600 text-sm leading-relaxed">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-gold-100 text-gold-700 text-xs font-bold flex items-center justify-center mt-0.5">{{ $index + 1 }}</span>
                            <span>{!! \App\Models\Dosen::linkify($item) !!}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
                @endif

                @if($dosen->pengabdian_masyarakat)
                <div id="pengabdian" class="scroll-mt-36 bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM12 6a9 9 0 00-9 9v0a9 9 0 0018 0v0a9 9 0 00-9-9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 20a4.5 4.5 0 017-3.75M15.5 20a4.5 4.5 0 00-7-3.75"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-bold text-gray-900">Pengabdian Masyarakat</h3>
                    </div>
                    <ol class="space-y-3">
                        @foreach($dosen->pengabdian_masyarakat as $index => $item)
                        <li class="flex items-start gap-3 text-gray-600 text-sm leading-relaxed">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary-100 text-primary-700 text-xs font-bold flex items-center justify-center mt-0.5">{{ $index + 1 }}</span>
                            <span>{!! \App\Models\Dosen::linkify($item) !!}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
                @endif

                @if($dosen->capaian_khusus)
                <div id="capaian" class="scroll-mt-36 bg-gradient-to-br from-primary-600 to-primary-800 text-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-bold">Capaian Khusus</h3>
                    </div>
                    <ul class="space-y-3">
                        @foreach($dosen->capaian_khusus as $item)
                        <li class="flex items-start gap-3 text-gray-100 text-sm leading-relaxed">
                            <svg class="w-4 h-4 text-gold-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(!$dosen->riwayat_pendidikan && !$dosen->penelitian && !$dosen->pengabdian_masyarakat && !$dosen->capaian_khusus)
                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 text-center">
                    <p class="text-gray-500">Data riwayat pendidikan, penelitian, dan pengabdian masyarakat belum tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
