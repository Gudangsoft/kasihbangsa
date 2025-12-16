<x-filament-widgets::widget>
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 p-6 shadow-xl">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative">
            <div class="grid gap-6 lg:grid-cols-12 lg:gap-8">
                <!-- Left Section: Welcome Message -->
                <div class="lg:col-span-8">
                    <div class="flex flex-col space-y-4">
                        <!-- Greeting -->
                        <div>
                            <h2 class="text-2xl font-bold text-white sm:text-3xl lg:text-4xl">
                                {{ $this->getGreeting() }}, {{ $this->getUser()->name }}! 👋
                            </h2>
                            <p class="mt-2 text-sm text-white/80 sm:text-base">
                                Selamat bekerja dan semoga hari Anda menyenangkan
                            </p>
                        </div>

                        <!-- User Info Cards -->
                        <div class="flex flex-wrap gap-3">
                            <!-- Role Badge -->
                            <div class="flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2 backdrop-blur-sm">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-white/70">Role</p>
                                    <p class="text-sm font-semibold text-white">
                                        {{ $this->getUser()->roles->first()?->name ?? 'User' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2 backdrop-blur-sm">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-white/70">Tanggal</p>
                                    <p class="text-sm font-semibold text-white">
                                        {{ now()->locale('id')->isoFormat('D MMMM Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Time -->
                            <div class="flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2 backdrop-blur-sm"
                                 x-data="{ time: '{{ now()->format('H:i:s') }}' }"
                                 x-init="setInterval(() => {
                                     const now = new Date();
                                     time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
                                 }, 1000)">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-white/70">Waktu</p>
                                    <p class="text-sm font-semibold text-white tabular-nums" x-text="time"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Avatar & Guide Button -->
                <div class="lg:col-span-4">
                    <div class="flex h-full flex-col items-center justify-center space-y-4">
                        <!-- Avatar -->
                        <div class="relative">
                            <div class="h-24 w-24 overflow-hidden rounded-full ring-4 ring-white/30 lg:h-28 lg:w-28">
                                <img src="{{ $this->getUser()->profile_photo_url }}"
                                     alt="{{ $this->getUser()->name }}"
                                     class="h-full w-full object-cover">
                            </div>
                            <div class="absolute -bottom-1 -right-1 flex h-8 w-8 items-center justify-center rounded-full bg-green-500 ring-4 ring-primary-700">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Guide Button -->
                        <a href="{{ route('filament.admin.pages.guide') }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-primary-700 shadow-lg transition-all hover:bg-white/90 hover:shadow-xl lg:w-auto">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Panduan Penggunaan</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Mini -->
            <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4 lg:gap-4">
                <div class="rounded-lg bg-white/10 p-3 backdrop-blur-sm">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-white/70">Berita</p>
                            <p class="text-lg font-bold text-white">{{ \App\Models\Post::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white/10 p-3 backdrop-blur-sm">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-white/70">Informasi</p>
                            <p class="text-lg font-bold text-white">{{ \App\Models\Information::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white/10 p-3 backdrop-blur-sm">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-white/70">Galeri</p>
                            <p class="text-lg font-bold text-white">{{ \App\Models\Gallery::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white/10 p-3 backdrop-blur-sm">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-white/70">Users</p>
                            <p class="text-lg font-bold text-white">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
