<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCE - @yield('titulo')</title>

    {{-- Link para as fontes do projeto --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans&display=swap" rel="stylesheet">

    {{-- Link para a biblioteca de animação do projeto --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Links para os ícones do projeto --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    {{-- Links de estilo interno --}}
    <link rel="stylesheet" href="{{ asset('css/components/layouts/estrutura-basica.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/menuLateral/menu-lateral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/menuLateral/item-menu-lateral.css') }}">
    @yield('estilo')
</head>

<body>
    <x-menuLateral.menu-lateral />
    {{ $slot }}
    <script src="{{ asset('js/menuLateral/menuLateral.js') }}"></script>
</body>

</html>
