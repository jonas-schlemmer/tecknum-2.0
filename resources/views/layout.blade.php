<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'tecknum')</title>
    <link rel="stylesheet" href="{{ asset('css/general.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/movies.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/movies-mobile.css') }}" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>
<body>
    @yield('content')
</body>
</html>
