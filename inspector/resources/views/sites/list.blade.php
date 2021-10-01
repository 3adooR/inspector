@if(!empty($sites))
    <div class="container">
        <div class="row">
            @foreach($sites as $site)
                <div id="site-{{ $site->id }}" class="col-sm-3">
                    @include('sites.item')
                </div>
            @endforeach
        </div>
    </div>
@endif
