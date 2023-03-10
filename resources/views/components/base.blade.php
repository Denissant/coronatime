<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coronatime</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <link rel="icon" href="{{ url('icon-128.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen h-screen text-brand-black selection:bg-brand-lightgreen selection:text-white">
{{ $slot }}
</body>
</html>
