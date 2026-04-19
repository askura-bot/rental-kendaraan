<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $metaDescription ?? __('Trusted car rental service with top-rated reviews. Find your perfect vehicle.') }}">

        <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'DriveEase') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-white text-gray-800 overflow-x-hidden">
        {{-- User Navigation - always shown, independent of auth state --}}
        <x-user-navigation />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-public-footer />

        @stack('scripts')
    </body>
</html>
