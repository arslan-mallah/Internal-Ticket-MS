<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 h-screen flex items-center justify-center">
        <div class="flex flex-col items-center justify-center w-full h-full space-y-3 p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold">YOUR TICKETING SOLUTION IN ONE PLACE</h1>
            <div class="flex flex-row space-x-4">
                <a href="{{ route('login') }}">
                <button class="bg-black text-white font-bold p-4 rounded-lg">
                    LOGIN
                </button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="bg-gray-200 text-black font-bold p-4 rounded-lg border border-black">
                        REGISTER
                    </button>
                </a>
            </div>
        </div>
    </body>
</html>
