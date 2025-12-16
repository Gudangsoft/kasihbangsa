<div>
    <!-- Features/Stats Section -->
    <section class="py-16 lg:py-24 bg-gradient-to-br from-primary-600 to-primary-800 text-white relative overflow-hidden"
             x-data="{
                 statsParallax: 0,
                 init() {
                     window.addEventListener('scroll', () => {
                         const section = this.$el;
                         const rect = section.getBoundingClientRect();
                         const scrolled = window.pageYOffset;
                         const sectionTop = rect.top + scrolled;
                         const offset = scrolled - sectionTop + window.innerHeight;
                         if (offset > 0 && rect.top < window.innerHeight) {
                             this.statsParallax = offset * 0.3;
                         }
                     });
                 }
             }">
        <!-- Background Pattern with Parallax -->
        <div class="absolute inset-0 opacity-10"
             :style="`transform: translateY(${statsParallax}px);`">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="text-center" data-aos="fade-up" data-aos-delay="0">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-heading font-bold mb-2">{{ homeSettings()->stat_programs ?? '5+' }}</div>
                    <div class="text-lg font-medium">{{ homeSettings()->stat_programs_label ?? 'Program Studi' }}</div>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-heading font-bold mb-2">{{ homeSettings()->stat_students ?? '500+' }}</div>
                    <div class="text-lg font-medium">{{ homeSettings()->stat_students_label ?? 'Mahasiswa Aktif' }}</div>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-heading font-bold mb-2">{{ homeSettings()->stat_lecturers ?? '50+' }}</div>
                    <div class="text-lg font-medium">{{ homeSettings()->stat_lecturers_label ?? 'Dosen Profesional' }}</div>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-heading font-bold mb-2">{{ homeSettings()->stat_accreditation ?? 'A' }}</div>
                    <div class="text-lg font-medium">{{ homeSettings()->stat_accreditation_label ?? 'Akreditasi' }}</div>
                </div>
            </div>
        </div>
    </section>
</div>
