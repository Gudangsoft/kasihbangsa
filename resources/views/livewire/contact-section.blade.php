<div>
    <!-- Contact Section -->
    <section class="py-16 lg:py-24 bg-gray-50" id="contact">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Contact Info -->
                <div>
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-sm font-medium mb-4">
                            Hubungi Kami
                        </span>
                        <h2 class="section-title">
                            {{ homeSettings()->contact_title ?? 'Kotak Layanan STP Dian Mandala' }}
                        </h2>
                        <p class="text-gray-600 mt-4">
                            {{ homeSettings()->contact_description ?? 'Kirimkan pesan kepada kami, kami akan membalas Anda melalui email dalam waktu 24 jam.' }}
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-1">Telepon</div>
                                <a href="tel:{{ company()->phone }}" class="text-lg font-semibold text-gray-900 hover:text-primary-600 transition-colors duration-200">
                                    {{ company()->phone }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-1">Email</div>
                                <a href="mailto:{{ company()->email }}" class="text-lg font-semibold text-gray-900 hover:text-primary-600 transition-colors duration-200 break-all">
                                    {{ company()->email }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-1">Alamat</div>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ company()->address }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-lg h-full min-h-[400px]">
                        <iframe
                            src="{{ homeSettings()->contact_map_embed_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8153753694455!2d97.61914237496565!3d1.2847206987030688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3025fb508ed31b47%3A0x12f231911163e77!2sSTP%20Dian%20Mandala!5e0!3m2!1sid!2sid!4v1740067739649!5m2!1sid!2sid' }}"
                            class="w-full h-full"
                            style="border:0; min-height: 400px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
