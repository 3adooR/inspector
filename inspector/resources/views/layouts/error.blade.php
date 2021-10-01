<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title', 'Ошибка')</title>
    <link href="{{ mix('css/error.css') }}" rel="stylesheet">
</head>

<div class="container">
    <img src="{{ asset('img/404.png') }}" alt="error">
    <h1>@yield('code', __($exception->getCode()))</h1>
    <div>@yield('message', __($exception->getMessage()))</div>
</div>

@include('blocks.footer')
