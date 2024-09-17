<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased min-h-screen flex flex-col">
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="mb-auto p-4">
        {{ $slot }}
    </main>
    <footer class="flex h-24 flex-col justify-center items-center bg-gray-300 p-4 text-black gap-4 mt-4">
        <p>
            This work is based on Songs and Sagas, product of <a href="https://farirpgs.com" class="underline">Fari
                RPGs</a>, developed
            and authored
            by René-Pier Deshaies-Gélinas, and licensed for our use under the <a
                href="https://creativecommons.org/licenses/by/4.0/" class="underline">Creative Commons Attribution 4.0
                License</a>.
        </p>
        <p>Made with ❤️ by <a href="https://github.com/custompro98" class="underline">custompro98</a></p>
    </footer>
</body>

</html>
