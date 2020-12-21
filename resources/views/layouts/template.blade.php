<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        @livewireStyles
        <script src="{{ mix('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @section('head')
        @show();
    </head>

    <body class="font-sans antialiased">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> </h2>
        </x-slot>
        <main class="flex-grow">
            @section('main')
            @show()
        </main>
        @extends('layouts/footer');
    </body>
</x-app-layout>

</html>
