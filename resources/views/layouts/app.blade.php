<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Coffee Tea Water' }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="antialiased w-full h-full">
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <main {{ $attributes }}>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
