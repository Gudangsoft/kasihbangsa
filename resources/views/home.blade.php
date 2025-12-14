<x-app-layout>
    <x-slot:title>
        Home
    </x-slot>

    @include('layouts.header')

    <div class="stricky-header stricked-menu main-menu">
        <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->

    <livewire:slider-home/>

    @include('layouts.about')


    <livewire:testimonial-items/>



    <section class="contact mt-4 pt-3" id="contact">
        <div class="contact__shape-1">
            <img src="{{ asset('assets') }}/images/shapes/contact-shape-1.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="contact-page__left">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">Kontak Kami</span>
                                <div class="section-title__icon-box-1">
                                    <i class="fa fa-angle-left"></i>
                                    <i class="fa fa-angle-left"></i>
                                    <i class="fa fa-angle-left"></i>
                                </div>
                                <div class="section-title__icon-box-2">
                                    <i class="fa fa-angle-right"></i>
                                    <i class="fa fa-angle-right"></i>
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                            <h2 class="section-title__title">KOTAK LAYANAN STP DIAN MANDALA</h2>
                        </div>
                        <p class="contact-page__text">Kirimkan pesan kepada kami, kami akan membalas Anda melalui email
                            dalam waktu 24 jam, terima kasih telah mempercayai kami.</p>
                        <ul class="contact-page__points list-unstyled">
                            <li>
                                <div class="icon">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="content">
                                    <p>Have any question?</p>
                                    <h4><a href="tel:{{ company()->phone }}">{{ company()->phone }}</a></h4>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="fas fa-envelope"></span>
                                </div>
                                <div class="content">
                                    <p>Have any question?</p>
                                    <h4><a href="mailto:{{ company()->email }}">{{ company()->email }}</a></h4>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="content">
                                    <p>Visit office</p>
                                    <h4>{{ company()->address }}</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="contact-page__right">
                        <div class="contact-page__form-box">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8153753694455!2d97.61914237496565!3d1.2847206987030688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3025fb508ed31b47%3A0x12f231911163e77!2sSTP%20Dian%20Mandala!5e0!3m2!1sid!2sid!4v1740067739649!5m2!1sid!2sid"
                                class="google-map__one" allowfullscreen></iframe>
                            <div class="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <livewire:post-list limit=3/>

</x-app-layout>
