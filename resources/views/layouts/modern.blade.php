<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Beranda' }} | {{ company()->name }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/icon/manifest.json') }}">
    <meta name="theme-color" content="#0284c7">

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $description ?? 'STP Dian Mandala Gunung Sitoli Nias - Sekolah Tinggi Pastoral yang berkomitmen untuk pendidikan berkualitas' }}">
    <meta name="keywords" content="{{ $tags ?? 'STP Dian Mandala, Kampus Nias, Gunung Sitoli, Pendidikan Tinggi, Keuskupan Sibolga' }}">
    <meta name="author" content="{{ $author ?? 'STP Dian Mandala' }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $type ?? 'website' }}">
    <meta property="og:title" content="{{ $title ?? 'Beranda' }} | {{ company()->name }}">
    <meta property="og:description" content="{{ $description ?? 'STP Dian Mandala Gunung Sitoli Nias' }}">
    <meta property="og:image" content="{{ $image ?? asset('assets/images/icon/android-icon-192x192.png') }}">
    <meta property="og:url" content="{{ $url ?? company()->website }}">
    <meta property="og:site_name" content="{{ company()->name }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Beranda' }} | {{ company()->name }}">
    <meta name="twitter:description" content="{{ $description ?? 'STP Dian Mandala Gunung Sitoli Nias' }}">
    <meta name="twitter:image" content="{{ $image ?? asset('assets/images/icon/android-icon-192x192.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        // Mobile menu toggle
        document.addEventListener('alpine:init', () => {
            Alpine.data('mobileMenu', () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                    document.body.style.overflow = this.open ? 'hidden' : '';
                }
            }));
        });
    </script>
</body>
</html>
