<div>
    <div class="main-menu__main-menu-box">
        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
        <ul class="main-menu__list one-page-scroll-menu">
            @php
                $maxVisibleMenus = 25; // Batas menu utama yang terlihat
                $extraMenus = array_slice($menuItems, $maxVisibleMenus);
            @endphp

            @foreach (array_slice($menuItems, 0, $maxVisibleMenus) as $item)
                @if (count($item['submenus']) > 0)
                    <li class="dropdown scrollToLink">
                        <a href="{{ $item['url'] }}">{{ $item['name'] }} </a>
                        <ul class="sub-menu">
                            @foreach ($item['submenus'] as $submenu)
                                @if ($submenu['status'] == true)
                                    <li><a href="{{ $submenu['url'] }}">{{ $submenu['name'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    @if ($item['parent_id'] == 0)
                        <li class="scrollToLink">
                            <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endif
                @endif
            @endforeach

            @if (count($menuItems) > $maxVisibleMenus)
                <li class="dropdown scrollToLink">
                    <a href="#" class="text-uppercase">Lainnya</a>
                    <ul class="sub-menu">
                        @foreach ($extraMenus as $item)
                            @if (count($item['submenus']) > 0)
                                <li class="dropdown">
                                    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                                    <ul class="sub-menu">
                                        @foreach ($item['submenus'] as $submenu)
                                            @if ($submenu['status'] == true)
                                                <li><a href="{{ $submenu['url'] }}">{{ $submenu['name'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                @if ($item['parent_id'] == 0)
                                    <li><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>

    </div>
</div>
