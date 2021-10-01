<div id="access">
    @if($isLogin)
        <a href="{{ route(\App\Services\Routes\Providers\Sites\SitesRoutes::ROUTE_SITES_INDEX, ['lang' => $lang]) }}"
           class="btn btn-dark d-block"
           role="button">
            {{ __('app.sites_button') }}
        </a>
        @include('blocks.logout')
    @else
        <input type="password"
               name="accessKey"
               class="form-control"
               placeholder="{{ __('app.access_key_placeholder') }}"
               data-auth-route="{{ route(\App\Services\Routes\Providers\BaseRoutes::ROUTE_LOGIN) }}">
    @endif
</div>
