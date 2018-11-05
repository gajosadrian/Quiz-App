<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="author" content="pogstudio.pl">
    <meta name="theme-color" content="#ef5350">

    {{-- Styles --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link href="{{ asset('css/codebase.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/pulse.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @routes

    <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-glass page-header-inverse main-content-boxed">

        <main id="main-container">
            <div id="app" class="content">
                @yield('content')
            </div>
        </main>

        @include('layouts.footer')
    </div>

    <!-- Codebase Core JS -->
    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/core/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/core/jquery.slimscroll.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/core/jquery-scrollLock.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/core/jquery.appear.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/core/jquery.countTo.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/core/js.cookie.min.js') }}"></script> --}}
    <script src="{{ asset('js/codebase.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
</body>
</html>
