<div>
    <!-- Hero Header -->
    <div class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        </div>

        <!-- Decorative Circles -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-700 rounded-full opacity-20 blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-600 rounded-full opacity-20 blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm mb-6 animate-fade-in">
                <a href="/" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda</span>
                </a>
                <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Kerja Sama</span>
            </nav>

            <!-- Page Title -->
            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4 animate-slide-up leading-tight">
                    Data Kerja Sama
                </h1>
                <p class="text-xl text-primary-200 animate-fade-in" style="animation-delay: 0.1s;">
                    Daftar kerja sama dengan berbagai institusi dan lembaga
                </p>
            </div>
        </div>

        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="rgb(249, 250, 251)"/>
            </svg>
        </div>
    </div>

    <!-- Search and Filter -->
    <section class="py-8 bg-white border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search by Code -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Berdasarkan Kode</label>
                        <div class="relative">
                            <input type="text"
                                   wire:model.live="search"
                                   placeholder="Masukkan kode kerja sama..."
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">

                        </div>
                    </div>

                    <!-- Search by Institution -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Berdasarkan Lembaga</label>
                        <div class="relative">
                            <input type="text"
                                   wire:model.live="lembaga"
                                   placeholder="Masukkan nama lembaga mitra..."
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">

                        </div>
                    </div>
                </div>

                <!-- Results Count -->
                @if ($search || $lembaga)
                    <div class="mt-4 flex items-center gap-2 text-sm text-primary-700 bg-primary-50 px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="font-semibold">Ditemukan: {{ $count }} data kerja sama</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Table Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($data->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Lembaga Mitra</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold uppercase tracking-wider">Tingkat</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Judul Kerja Sama</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Manfaat</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Periode</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($data as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-100 text-primary-800">
                                                {{ $item->kode }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900">{{ $item->lembaga_mitra }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col items-center gap-1">
                                                @if($item->internasional)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                        Internasional
                                                    </span>
                                                @endif
                                                @if($item->nasional)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                        Nasional
                                                    </span>
                                                @endif
                                                @if($item->wilayah_lokal)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                        Wilayah/Lokal
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $item->judul_kerja_sama }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ $item->manfaat ?: '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $item->start_date_indo }} - {{ $item->end_date_indo }}</div>
                                            <div class="text-xs text-primary-600 font-semibold mt-1">({{ $item->durasi }})</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="lg:hidden divide-y divide-gray-200">
                        @foreach ($data as $item)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <!-- Kode -->
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-100 text-primary-800">
                                        {{ $item->kode }}
                                    </span>
                                </div>

                                <!-- Lembaga -->
                                <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $item->lembaga_mitra }}</h3>

                                <!-- Tingkat -->
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @if($item->internasional)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Internasional
                                        </span>
                                    @endif
                                    @if($item->nasional)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Nasional
                                        </span>
                                    @endif
                                    @if($item->wilayah_lokal)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Wilayah/Lokal
                                        </span>
                                    @endif
                                </div>

                                <!-- Judul -->
                                <p class="text-sm text-gray-900 font-medium mb-2">{{ $item->judul_kerja_sama }}</p>

                                <!-- Manfaat -->
                                @if($item->manfaat)
                                    <p class="text-sm text-gray-600 mb-3">{{ $item->manfaat }}</p>
                                @endif

                                <!-- Periode -->
                                <div class="text-sm">
                                    <span class="text-gray-700">{{ $item->start_date_indo }} - {{ $item->end_date_indo }}</span>
                                    <span class="text-primary-600 font-semibold ml-2">({{ $item->durasi }})</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $data->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">
                        @if($search || $lembaga)
                            Tidak ada data kerja sama yang sesuai dengan pencarian.
                        @else
                            Belum ada data kerja sama yang tersedia.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>
