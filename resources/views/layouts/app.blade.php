<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ $title ?? 'Page' }} | {{ company()->name }} </title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/icon') }}/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/icon') }}/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/icon') }}/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/icon') }}/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/icon') }}/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/icon') }}/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/icon') }}/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/icon') }}/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icon') }}/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/images/icon') }}/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icon') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/icon') }}/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icon') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('assets/images/icon') }}/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta name="description" content="{{ $description ?? 'STP Dian Mandala' }} " />
    <meta name="keywords" content="{{ $tags ?? 'informasi, page, stipdianmandala, kampus' }}">
    <meta name="author" content="{{ $author ?? 'Admin' }}">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="{{ $type ?? 'Page' }}">
    <meta property="og:title" content="{{ $title ?? 'Page' }} | {{ company()->name }}">
    <meta property="og:description" content="{{ $description ?? 'STP Dian Mandala' }}">
    <meta property="og:image" content="{{ $image ?? asset('assets/images/loader.png') }}">
    <meta property="og:url" content="{{ $url ?? company()->website }}">
    <meta property="og:site_name" content="{{ company()->name }}">
    {{-- <meta property="article:published_time" content="2025-03-07T12:00:00Z"> --}}
    <meta property="article:author" content="{{ $author ?? 'Admin' }}"">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Page' }} | {{ company()->name }}">
    <meta name="twitter:description" content="{{ $description ?? 'STP Dian Mandala' }}">
    <meta name="twitter:image" content="https://example.com/path-ke-gambar.jpg{{ $image ?? asset('assets/images/loader.png') }}">
    <meta name="twitter:site" content="@stpdianmandala">
    <meta name="twitter:creator" content="@stpdianmandala">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @include('layouts.assets.css')
    @stack('css')
    @livewireStyles

</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>


    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->


    <div class="page-wrapper">

        {{ $slot }}

        <!--Site Footer Start-->
        @include('layouts.footer')
        <!--Site Footer End-->


    </div>


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="/" aria-label="logo image"><img src="{{ company()->image }}" width="135"
                        alt="" /></a>
            </div>
            <div class="mobile-nav__container"></div>

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:{{ company()->email }}">{{ company()->name }}</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:{{ company()->phone }}">{{ company()->phone }}</a>
                </li>
            </ul>
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="icon-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="icon-up-arrow"></i></a>

    @include('layouts.assets.js')
    @livewireScripts
    @stack('scripts')

</body>

</html>
