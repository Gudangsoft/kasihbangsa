<!-- About Section -->
<section id="about" class="py-16 lg:py-24 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- Image Column -->
            <div class="relative order-2 lg:order-1" data-aos="fade-right">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('assets/images/resources/about-four-img-1.jpg') }}"
                         alt="STP Dian Mandala"
                         class="w-full h-auto">

                    <!-- Decorative Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-primary-500 rounded-full opacity-20 blur-2xl"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-secondary-500 rounded-full opacity-20 blur-2xl"></div>
                </div>

                <!-- Stats Card -->
                <div class="absolute -bottom-8 -right-8 bg-white rounded-xl shadow-xl p-6 hidden md:block">
                    <div class="text-center">
                        <div class="text-4xl font-heading font-bold text-primary-600 mb-1">20+</div>
                        <div class="text-sm text-gray-600">Tahun Pengalaman</div>
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="order-1 lg:order-2" data-aos="fade-left">
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-sm font-medium mb-4">
                        Tentang Kami
                    </span>
                    <h2 class="section-title">
                        STP Dian Mandala Gunung Sitoli Nias
                    </h2>
                </div>

                <div class="prose prose-lg max-w-none text-gray-600 mb-8">
                    {!! company()->description !!}
                </div>

                <!-- Quick Links -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <a href="/page/visi-dan-misi"
                       class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:border-primary-200 border-2 border-transparent transition-all duration-300 group">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-primary-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Visi & Misi</div>
                            <div class="text-sm text-gray-500">Tujuan kami</div>
                        </div>
                    </a>

                    <a href="/page/struktur-organisasi"
                       class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:border-primary-200 border-2 border-transparent transition-all duration-300 group">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-primary-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Struktur Organisasi</div>
                            <div class="text-sm text-gray-500">Tim kami</div>
                        </div>
                    </a>
                </div>

                <a href="/page/tentang-kami" class="btn btn-primary inline-flex items-center">
                    Selengkapnya
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
