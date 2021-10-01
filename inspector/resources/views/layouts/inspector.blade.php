@extends('layouts.main')

@section('content')
    <main>
        <aside id="sidebar" class="position-fixed">
            <div class="d-flex flex-column flex-shrink-0 p-3">
                <div id="menu-header">
                    <i id="menu-bars" class="fas fa-bars"></i>
                    <h1>{{ config('app.name') }}</h1>
                </div>
                <div class="text-center">
                    <h2>{{ $site->host }}</h2>
                    <a href="{{ route(\App\Services\Routes\Providers\Sites\SitesRoutes::ROUTE_SITES_INDEX, ['lang' => $lang]) }}"
                       class="small">
                        {{ __('app.sites_all') }}
                    </a>
                </div>
                @include('blocks.menu')
                <div id="sidebar-footer">
                    @include('blocks.lang')
                    @include('blocks.logout')
                </div>
            </div>
        </aside>
        <section>
            @if(!empty($currentMenu['icon']) || !empty($currentMenu['title']))
                <h2 class="menu-name">
                    @if(!empty($currentMenu['icon']))
                        {!! $currentMenu['icon'] !!}
                    @endif
                    @if(!empty($currentMenu['title']))
                        {{ $currentMenu['title'] }}
                    @endif
                </h2>
            @endif

            @if(!empty($content))
                {!! $content !!}
            @endif

            @if(!empty($currentMenu['next']))
                <p class="mt-3">
                    <a href="{{ route(\App\Services\Routes\Providers\Inspector\InspectorRoutes::ROUTE_INSPECTOR_INDEX, ['lang' => $lang, 'id' => $siteID]).'/'.$currentMenu['next'] }}"
                       class="btn btn-dark">
                        {{ __('app.button_next') }}
                    </a>
                </p>
            @endif
        </section>
    </main>
@endsection

@section('css', mix('css/inspector.css'))

@section('js')
    @parent
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
