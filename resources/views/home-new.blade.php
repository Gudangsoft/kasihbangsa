<x-modern-layout title="Beranda" :description="company()->description ?? (company()->name . ' - berkomitmen untuk pendidikan berkualitas')">

    <!-- Hero Slider -->
    <livewire:slider-home />

    <!-- Quick Links / Tombol Layanan -->
    <livewire:quick-links />

    <!-- Latest News & Information Section -->
    <livewire:latest-news-information />

    <!-- About Section -->
    @include('components.about-section')

    <!-- Features/Stats Section -->
    <livewire:stats-section />

    <!-- Gallery Section -->
    <livewire:gallery-section />

    <!-- Latest Information -->
    <livewire:latest-information />

    <!-- Testimonials -->
    <livewire:testimonial-items />

    <!-- Contact Section -->
    <livewire:contact-section />

</x-modern-layout>
