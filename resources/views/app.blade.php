<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    {{--  style  --}}
    <link rel="stylesheet" href="{{asset('assets/css/lightbox.min.css')}}">

    <!-- Fonts and icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/15d54817f9.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/lightbox-plus-jquery.min.js')}}"></script>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body class="font-sans antialiased h-full bg-[#111827] lg:overflow-hidden md:overflow-hidden">
@inertia
</body>
</html>
