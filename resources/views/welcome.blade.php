<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coffee Tea Water</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="absolute flex items-center justify-center w-full h-full">
        <img class="top-50 left-50 w-[500px] h-[500px]"
            src="{{ asset('assets/images/coffee_tea_water.png') }}" />
        </div>
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            
                <header class="flex items-center justify-between w-full">
                    <div class="fixed top-0 flex left-10 lg:justify-center lg:items-center lg:col-start-2">
                        <img class="max-sm:w-[120px] max-md:w-[120px] w-[150px] lg:h-[150px] m-3" src="{{ asset('assets/images/icon_coffee_tea_water.png') }}"/>
                    </div>
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>
                    
            
        </div>
    </div>
</body>
</html>
