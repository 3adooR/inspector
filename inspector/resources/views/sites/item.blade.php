<div class="card sites-item">
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ 'http'.(($site->https) ? 's' : '').'://'.$site->host }}" target="_blank" rel="_nofollow">
                {{ $site->host }}
            </a>
            <a href="{{ route(\App\Services\Routes\Providers\Sites\SitesRoutes::ROUTE_SITES_DELETE, ['lang' => $lang, 'id' => $site->id]) }}"
               class="rounded sites-item-delete">
                <i class="fas fa-times-circle"></i>
            </a>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">
            {{ date('d/m/Y', strtotime($site->created_at)) }}
        </h6>
        <div class="sites-item-links">
            <a href="/" target="_blank" rel="_nofollow" class="card-link rounded">
                <i class="fas fa-globe"></i>
            </a>
            <a href="/" target="_blank" rel="_nofollow" class="card-link rounded">
                <i class="far fa-file-pdf"></i>
            </a>
            @if($site->https)
                <span class="card-link rounded">
                    <i class="fab fa-expeditedssl"></i>
                </span>
            @endif
        </div>
        <a href="{{ route(\App\Services\Routes\Providers\Inspector\InspectorRoutes::ROUTE_INSPECTOR_INDEX, ['lang' => $lang, 'id' => $site->id]) }}"
           class="btn btn-dark sites-item-inspect">
            {{ __('app.inspect') }}
        </a>
    </div>
</div>
