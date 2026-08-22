<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-20">
        <div class="container">
            <a href="{{ route('dosen') }}" class="inline-flex items-center text-gray-200 hover:text-white mb-6 text-sm font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Dosen
            </a>
            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6">
                <div class="w-32 h-32 rounded-full overflow-hidden ring-4 ring-white/30 flex-shrink-0">
                    <img src="{{ $dosen->photo_url }}" alt="{{ $dosen->name }}" class="w-full h-full object-cover">
                </div>
                <div class="text-center sm:text-left">
                    <h1 class="text-2xl md:text-3xl font-heading font-bold">{{ $dosen->name }}</h1>
                    @if($dosen->prodi)
                    <p class="text-gray-200 mt-1">Program Studi {{ $dosen->prodi }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 lg:py-16">
        <div class="container grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Info Box -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 space-y-3">
                    <h3 class="font-heading font-bold text-gray-900 mb-3">Data Dosen</h3>
                    @if($dosen->nidn)
                    <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                        <span class="text-gray-500">NIDN</span>
                        <span class="font-medium text-gray-900">{{ $dosen->nidn }}</span>
                    </div>
                    @endif
                    @if($dosen->jabatan_akademik)
                    <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Jab. Akademik</span>
                        <span class="font-medium text-gray-900">{{ $dosen->jabatan_akademik }}</span>
                    </div>
                    @endif
                    @if($dosen->jabatan_institusi)
                    <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Jab. Institusi</span>
                        <span class="font-medium text-gray-900">{{ $dosen->jabatan_institusi }}</span>
                    </div>
                    @endif
                    @if($dosen->status_dosen)
                    <div class="flex justify-between text-sm border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Status</span>
                        <span class="font-medium text-gray-900">{{ $dosen->status_dosen }}</span>
                    </div>
                    @endif
                    @if($dosen->sertifikasi_dosen)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Sertifikasi</span>
                        <span class="font-medium text-gray-900">{{ $dosen->sertifikasi_dosen }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Riwayat -->
            <div class="lg:col-span-2 space-y-8">
                @if($dosen->riwayat_pendidikan)
                <div>
                    <h3 class="text-lg font-heading font-bold text-gray-900 mb-3">Riwayat Pendidikan</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-600">
                        @foreach($dosen->riwayat_pendidikan as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($dosen->penelitian)
                <div>
                    <h3 class="text-lg font-heading font-bold text-gray-900 mb-3">Penelitian</h3>
                    <ol class="list-decimal list-inside space-y-1 text-gray-600">
                        @foreach($dosen->penelitian as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                </div>
                @endif

                @if($dosen->pengabdian_masyarakat)
                <div>
                    <h3 class="text-lg font-heading font-bold text-gray-900 mb-3">Pengabdian Masyarakat</h3>
                    <ol class="list-decimal list-inside space-y-1 text-gray-600">
                        @foreach($dosen->pengabdian_masyarakat as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                </div>
                @endif

                @if($dosen->capaian_khusus)
                <div>
                    <h3 class="text-lg font-heading font-bold text-gray-900 mb-3">Capaian Khusus</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-600">
                        @foreach($dosen->capaian_khusus as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(!$dosen->riwayat_pendidikan && !$dosen->penelitian && !$dosen->pengabdian_masyarakat && !$dosen->capaian_khusus)
                <p class="text-gray-500">Data riwayat pendidikan, penelitian, dan pengabdian masyarakat belum tersedia.</p>
                @endif
            </div>
        </div>
    </section>
</div>
