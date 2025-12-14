<footer class="site-footer">
    <div class="site-footer__bg" style="background-image: url({{ asset('assets') }}/images/backgrounds/site-footer-bg.png);">
    </div>
    <div class="container">
        <div class="site-footer__top">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="footer-widget__column footer-widget__about">
                        <div class="footer-widget__logo">
                            <a href="/"><img src="{{ company()->image }}" alt="{{ company()->name }}" style="width: 135px;"></a>
                        </div>
                        <p class="footer-widget__about-text">{{ company()->description }}</p>
                        <div class="site-footer__social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                    <div class="footer-widget__column footer-widget__link">
                        <div class="footer-widget__title-box">
                            <h3 class="footer-widget__title">Explore</h3>
                        </div>
                        <ul class="footer-widget__link-list list-unstyled">
                            <li><a href="/berita">Informasi</a></li>
                            <li><a href="/informasi/pengumuman">Pengumuman</a></li>
                            <li><a href="/informasi/akademik">Akademik</a></li>
                            <li><a href="/kerjasama">Kerja Sama</a></li>
                            <li><a href="#contact">Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="500ms">
                    <div class="footer-widget__column footer-widget__Contact">
                        <div class="footer-widget__title-box">
                            <h3 class="footer-widget__title">Contact</h3>
                        </div>
                        <p class="footer-widget__Contact-text">{{ company()->address }}</p>
                        <ul class="footer-widget__Contact-list list-unstyled">
                            <li>
                                <div class="icon">
                                    <span class="fas fa-envelope"></span>
                                </div>
                                <div class="text">
                                    <a href="mailto:{{ company()->email }}">{{ company()->email }}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="fas fa-phone-square"></span>
                                </div>
                                <div class="text">
                                    <a href="tel:+{{ company()->phone }}">+{{ company()->phone }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="500ms">
                    <div class="footer-widget__column footer-widget__newsletter">
                        <div class="footer-widget__title-box">
                            <h3 class="footer-widget__title">Newsletter</h3>
                        </div>
                        <div class="footer-widget__newsletter-form-box">
                            <form class="footer-widget__newsletter-form mc-form" data-url="MC_FORM_URL"
                                novalidate="novalidate">
                                <div class="footer-widget__newsletter-form-input-box">
                                    <input type="email" placeholder="Email Address" name="EMAIL">
                                    <button type="submit" class="footer-widget__newsletter-btn"><span
                                            class="fas fa-paper-plane"></span></button>
                                </div>
                            </form>
                            <div class="mc-form__response"></div>
                            <div class="checked-box">
                                <input type="checkbox" name="skipper1" id="skipper" checked="">
                                <label for="skipper"><span></span>I agree to all your terms and policies</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner">
                        <p class="site-footer__bottom-text">© Copyright 2025 - <a href="#">{{ company()->name }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
