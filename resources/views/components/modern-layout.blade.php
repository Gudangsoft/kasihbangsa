<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }} | {{ company()->name }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ company()->image }}">
    <link rel="apple-touch-icon" href="{{ company()->image }}">
    <meta name="theme-color" content="#002147">

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $tags }}">
    <meta name="author" content="{{ $author }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $type }}">
    <meta property="og:title" content="{{ $title }} | {{ company()->name }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image ?: asset('assets/images/icon/android-icon-192x192.png') }}">
    <meta property="og:url" content="{{ $url ?: company()->website }}">
    <meta property="og:site_name" content="{{ company()->name }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }} | {{ company()->name }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $image ?: asset('assets/images/icon/android-icon-192x192.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    @include('components.navigation')

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Floating WhatsApp Button -->
    @php
        $floatingContacts = \Illuminate\Support\Facades\Cache::rememberForever('floating_contacts', function () {
            return \App\Models\Contact::where('status', true)->orderBy('number')->get();
        });
    @endphp
    @if($floatingContacts->count() === 1)
        <a href="https://wa.me/{{ $floatingContacts->first()->whatsapp_number }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Chat via WhatsApp"
           class="fixed bottom-8 left-8 z-50 group">
            <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-75 blur-xl scale-150 animate-pulse"></span>
            <span class="relative flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:bg-[#20BD5A]">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.04 2c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.2h.01c5.46 0 9.9-4.44 9.9-9.9 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm0 18.12h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.22 8.22 0 0 1-1.26-4.36c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.83 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.55-3.7 8.21-8.24 8.21zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.13-.17.25-.64.81-.78.97-.14.17-.29.19-.53.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01a.92.92 0 0 0-.67.31c-.23.25-.87.85-.87 2.08 0 1.22.89 2.4 1.01 2.57.12.17 1.75 2.67 4.25 3.74.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.14-1.18-.06-.11-.23-.17-.48-.29z"/>
                </svg>
            </span>
        </a>
    @elseif($floatingContacts->count() > 1)
        <div x-data="{ open: false }" @click.away="open = false" class="fixed bottom-8 left-8 z-50">
            <!-- Contact List Popup -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="absolute bottom-16 left-0 w-64 bg-white rounded-xl shadow-2xl overflow-hidden mb-2"
                 style="display: none;">
                <div class="bg-[#25D366] px-4 py-3">
                    <p class="text-white font-semibold text-sm">Pilih Kontak WhatsApp</p>
                </div>
                <ul class="py-2">
                    @foreach($floatingContacts as $contact)
                    <li>
                        <a href="https://wa.me/{{ $contact->whatsapp_number }}"
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors duration-150">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-[#25D366]/10 text-[#25D366] flex-shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.04 2c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.2h.01c5.46 0 9.9-4.44 9.9-9.9 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm0 18.12h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.22 8.22 0 0 1-1.26-4.36c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.83 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.55-3.7 8.21-8.24 8.21z"/>
                                </svg>
                            </span>
                            <span class="min-w-0">
                                <span class="block text-sm font-medium text-gray-900 truncate">{{ $contact->label }}</span>
                                <span class="block text-xs text-gray-500">{{ $contact->phone }}</span>
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Toggle Button -->
            <button @click="open = !open" aria-label="Chat via WhatsApp" class="relative block group">
                <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-75 blur-xl scale-150 animate-pulse" :class="open ? 'opacity-0' : ''"></span>
                <span class="relative flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:bg-[#20BD5A]">
                    <svg x-show="!open" class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.04 2c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.2h.01c5.46 0 9.9-4.44 9.9-9.9 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm0 18.12h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.22 8.22 0 0 1-1.26-4.36c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.83 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.55-3.7 8.21-8.24 8.21zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.13-.17.25-.64.81-.78.97-.14.17-.29.19-.53.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01a.92.92 0 0 0-.67.31c-.23.25-.87.85-.87 2.08 0 1.22.89 2.4 1.01 2.57.12.17 1.75 2.67 4.25 3.74.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.14-1.18-.06-.11-.23-.17-.48-.29z"/>
                    </svg>
                    <svg x-show="open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </span>
            </button>
        </div>
    @endif

    <!-- Back to Top Button -->
    <button id="back-to-top"
            class="fixed bottom-8 right-8 bg-primary-600 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-primary-700 hover:scale-110 z-50"
            aria-label="Kembali ke atas">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    @livewireScripts
    @stack('scripts')

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script>
        // Back to top button functionality
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Initialize Fancybox
        if (typeof Fancybox !== 'undefined') {
            Fancybox.bind("[data-fancybox='gallery']", {
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: [],
                        right: ["slideshow", "thumbs", "close"],
                    },
                },
                Thumbs: {
                    autoStart: false,
                },
                Hash: false,
            });
        }
    </script>
</body>
</html>
