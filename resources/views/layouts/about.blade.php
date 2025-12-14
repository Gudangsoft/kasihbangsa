<section class="about-four">
    <div class="about-four__shape-3 float-bob-x">
        <img src="{{ asset('assets') }}/images/shapes/about-four-shape-3.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-four__left">
                    <div class="about-four__shape-1 float-bob-x">
                        <img src="{{ asset('assets') }}/images/shapes/about-four-shape-1.png" alt="">
                    </div>
                    <div class="about-four__shape-2 float-bob-y">
                        <img src="{{ asset('assets') }}/images/shapes/about-four-shape-2.png" alt="">
                    </div>
                    <div class="about-four__img">
                        <img src="{{ asset('assets') }}/images/resources/about-four-img-1.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-four__right">
                    <div class="section-title text-left">
                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">Tentang Kami</span>
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
                        <h2 class="section-title__title">STP Dian Mandala Gunung Sitoli Nias Keuskupan Sibolga</h2>
                    </div>
                    <ul class="about-four__points list-unstyled">
                        <li>
                            <div class="icon">
                                <span class="fas fa-arrow-right"></span>
                            </div>
                            <div class="text">
                                <p><a href="/page/struktur-organisasi">Struktur
                                    <br> Organisasi</p></a>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="fas fa-arrow-right"></span>
                            </div>
                            <div class="text">
                                <p><a href="/page/visi-dan-misi">Visi
                                    <br> dan Misi</p></a>
                            </div>
                        </li>
                    </ul>
                    <p class="about-four__text">
                        {!! company()->description !!}
                    </p>
                    <div class="about-four__btn-box">
                        <a href="/page/tentang-kami" class="about-four__btn thm-btn">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About Four End-->
