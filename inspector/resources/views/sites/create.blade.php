<form action="{{ route(\App\Services\Routes\Providers\Sites\SitesRoutes::ROUTE_SITES_CREATE, ['lang' => $lang]) }}" method="POST">
    @csrf
    <div class="form-group sites-create">
        <label for="siteUrlInput">URL</label>
        <input type="text" class="form-control" id="siteUrlInput" name="siteUrl" placeholder="URL">
        <button type="submit" class="btn btn-dark">{{ __('app.button_add') }}</button>
    </div>
</form>
