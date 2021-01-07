<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/home.css') }}">

    @livewireStyles
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @section('head')
    @show()

</head>

<body class="font-sans antialiased">
    <div class="info-window hidden"></div>
    @if (Session::has('message'))
        <span class="hidden" id='messageHidden'
            data-status={{ Session::get('status') }}>{{ Session::get('message') }}</span>
    @endif

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-dropdown')
        <!-- Page Content -->

        <main class="main">
            @section('main')
            @show()
        </main>
    </div>

    @section('modals')
    @show()
    @stack('modals')
    @livewireScripts

</body>

</html>
