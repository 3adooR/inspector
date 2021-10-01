@extends('layouts.main')

@section('content')
    <div class="sites">
        <h1>{{ config('app.name') }}</h1>
        @include('sites.list')
        <footer>
            <div class="container">
                @include('sites.create')
                <div id="footer-links">
                    @include('blocks.lang')
                    @include('blocks.logout')
                </div>
            </div>
        </footer>
    </div>
@endsection

@section('css', mix('css/sites.css'))

@section('js')
    @parent
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/sites.js') }}"></script>
@endsection
