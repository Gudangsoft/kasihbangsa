<div>
    @include('layouts.header')

    <section class="page-header">
        <div class="container">
            <div class="page-header__inner">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li><span class="fa fa-angle-right"></span></li>
                    <li>{{ $title }}</li>
                    @if ($subtitle)
                        <li><span class="fa fa-angle-right"></span></li>
                        <li>{{ $subtitle }}</li>
                    @endif
                </ul>
                {{-- @php
                    dd($maintitle);
                @endphp --}}
                @if($maintitle)
                    <h2>{{ $subtitle ? $subtitle : $title }}</h2>
                @endif
            </div>
        </div>
    </section>
</div>
