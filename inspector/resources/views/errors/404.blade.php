@extends('layouts.error')

@section('title', __('app.err_page_not_found'))
@section('code', '404')
@section('message')
    <h2>{{ __('app.err_page_not_found') }}</h2>
@endsection
