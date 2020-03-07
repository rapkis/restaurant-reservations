<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Restaurants - @yield('title')</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @yield('style')
    </head>
    <body class="bg-gray-100">
        <div class="flex w-full flex-col md:flex-row">
            @include('partials.core.sidebar')
            <div class="container bg-white min-h-screen mx-auto px-4 py-8 w-full md:w-5/6">
                @include('partials.core.components.notifications')
                @yield('content')
            </div>
        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
