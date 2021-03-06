<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{ config('app.seo_meta_title') }}">
        <meta name="keywords" content="{{ config('app.seo_meta_description') }}">
        <meta name="author" content="Jonathan Quishpe">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title') - {{ config('app.name') }}</title>
        @include('site.partials.styles')
    </head>
    <body>
        @include('site.partials.header')
        @yield('content')
        @include('site.partials.footer')
        @include('site.partials.scripts')
        <div id="myDiv"></div>
    </body>
</html>