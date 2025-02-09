<!DOCTYPE html>
<html class="h-screen w-full scroll-smooth" lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? __('Coffee Tea Water') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>

<body class="antialiased w-full h-full">
    <div class="relative flex flex-col items-center ">
        <main {{ $attributes }}>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>

</html>
