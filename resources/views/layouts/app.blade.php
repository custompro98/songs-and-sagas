<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Fraunces:ital,wght@0,500;0,600;0,700;0,900;1,500;1,600;1,700;1,900&amp;family=Cardo:ital,wght@0,700;1,700&amp;family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700"
        rel="stylesheet" type="text/css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-serif antialiased min-h-screen flex flex-col">
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="mb-auto p-4">
        {{ $slot }}
    </main>
    <footer class="flex min-h-24 flex-col justify-center items-center bg-gray-300 p-4 text-black gap-4 mt-4">
        <p class="text-center max-w-screen-md">
            This work is based on Songs and Sagas, product of <a href="https://farirpgs.com" class="underline">Fari
                RPGs</a>, developed
            and authored
            by René-Pier Deshaies-Gélinas, and licensed for our use under the <a
                href="https://creativecommons.org/licenses/by/4.0/" class="underline">Creative Commons Attribution 4.0
                License</a>.
        </p>
        <x-application-logo class="block h-24 xl:h-28" />
        <p>Made with ❤️ by <a href="https://github.com/custompro98" class="underline">custompro98</a></p>
    </footer>
</body>

</html>
