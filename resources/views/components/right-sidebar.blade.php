<div>
    <div class="sidebar">
        <div class="sidebar__single sidebar__post">
            <h3 class="sidebar__title">Artikel Terbaru</h3>
            <ul class="sidebar__post-list list-unstyled">
                @foreach ($latest_posts as $item)
                    <li>
                        <div class="sidebar__post-image">
                            <img src="{{ $item->thumbnail }}" alt="">
                        </div>
                        <div class="sidebar__post-content">
                            <h3>
                                <span class="sidebar__post-content-meta"><i
                                        class="fa fa-clock"></i>{{ $item->datetime }}</span>
                                <a href="{{ $item->read_url }}">{{ $item->title }}</a>
                            </h3>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar__single sidebar__tags">
            <h3 class="sidebar__title">Kategori</h3>
            <div class="sidebar__tags-list">
                @foreach ($categories as $category)
                    <a href="/berita?c={{ $category->slug }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="sidebar__single sidebar__project">
            <h3 class="sidebar__title">Gallery Photo</h3>
            <div class="sidebar__project-box">
                <div class="sidebar__project-carousel owl-carousel owl-theme thm-owl__carousel"
                    data-owl-options='{
                                "loop": true,
                                "autoplay": true,
                                "margin": 30,
                                "nav": false,
                                "dots": true,
                                "smartSpeed": 500,
                                "autoplayTimeout": 10000,
                                "navText": ["<span class=\"icon-right-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"],
                                "responsive": {
                                    "0": {
                                        "items": 1
                                    },
                                    "768": {
                                        "items": 1
                                    },
                                    "992": {
                                        "items": 1
                                    },
                                    "1200": {
                                        "items": 1
                                    }
                                }
                            }'>
                    @foreach ($galleries as $gallery)
                        <div class="item">
                            <div class="sidebar__project-single">
                                <div class="sidebar__project-bg"
                                    style="background-image: url({{ $gallery->thumbnail }});">
                                </div>
                                <p>{{ $gallery->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
