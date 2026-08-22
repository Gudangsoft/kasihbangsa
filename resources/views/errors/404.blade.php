<x-modern-layout title="Halaman Tidak Ditemukan" description="Halaman yang Anda cari tidak ditemukan.">
    <section class="min-h-[60vh] flex items-center justify-center py-20">
        <div class="container mx-auto px-4 text-center">
            <p class="text-8xl md:text-9xl font-heading font-bold text-navy-900">404</p>
            <h1 class="mt-4 text-2xl md:text-3xl font-heading font-bold text-gray-900">
                Halaman Tidak Ditemukan
            </h1>
            <p class="mt-3 text-gray-600 max-w-md mx-auto">
                Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="/" class="btn bg-navy-900 text-white hover:bg-navy-800">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('search') }}" class="btn border-2 border-navy-900 text-navy-900 hover:bg-navy-900 hover:text-white">
                    Cari di Situs
                </a>
            </div>
        </div>
    </section>
</x-modern-layout>
