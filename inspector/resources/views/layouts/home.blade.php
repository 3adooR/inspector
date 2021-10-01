@extends('layouts.main')

@section('content')
    <div id="home">
        <h1>{{ config('app.name') }}</h1>
        <footer>
            @include('blocks.auth')
        </footer>
    </div>
@endsection

@section('css', mix('css/home.css'))

@section('js')
    @parent
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/home.js') }}"></script>
@endsection
