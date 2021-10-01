@if(!empty($menu))
    <ul id="menu" class="list-unstyled ps-0">
        @foreach($menu as $menuKey => $menuItem)
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#menu-{{ $menuKey }}" aria-expanded="true">
                    {{ $menuItem['name'] }}
                </button>
                @if(!empty($menuItem['items']))
                    <div class="collapse show" id="#menu-{{ $menuKey }}">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @foreach($menuItem['items'] as $subMenuItem)
                                <li>
                                    <a href="{{ route(\App\Services\Routes\Providers\Inspector\InspectorRoutes::ROUTE_INSPECTOR_INDEX, ['lang' => $lang, 'id' => $siteID]).'/'.$subMenuItem['name'] }}"
                                       class="rounded @if($currentMenu['name'] === $subMenuItem['name']) active @endif">
                                        <i class="fas fa-{{ $subMenuItem['icon'] }}"></i>
                                        {{ $subMenuItem['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
@endif
