<div>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                Profil Dosen
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                Tenaga pengajar {{ company()->name }}
            </p>
        </div>
    </section>

    <!-- Dosen Grid -->
    <section class="py-16 lg:py-24">
        <div class="container">
            @if(count($items) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                <a href="{{ $item->detail_url }}"
                   class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden text-center p-6"
                   data-aos="fade-up"
                   data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="w-28 h-28 mx-auto rounded-full overflow-hidden ring-4 ring-primary-100 mb-4">
                        <img src="{{ $item->photo_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-heading font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                        {{ $item->name }}
                    </h3>
                    @if($item->prodi)
                    <p class="text-sm text-gray-500 mt-1">Program Studi {{ $item->prodi }}</p>
                    @endif
                    @if($item->jabatan_institusi)
                    <span class="inline-block mt-3 px-3 py-1 bg-primary-50 text-primary-600 rounded-full text-xs font-medium">
                        {{ $item->jabatan_institusi }}
                    </span>
                    @endif
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada data dosen yang dipublikasikan.</p>
            </div>
            @endif
        </div>
    </section>
</div>
