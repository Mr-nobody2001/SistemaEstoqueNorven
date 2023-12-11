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
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    {{-- Link para a biblioteca de animação do projeto --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    {{-- Links para os ícones do projeto --}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>

    {{-- Links de estilo interno --}}
    <link rel="stylesheet" href="{{ asset('css/components/layouts/estilo-geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/menuLateral/menu-lateral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/menuLateral/item-menu-lateral.css') }}">
</head>
<body>
<x-menuLateral.menu-lateral/>
{{ $slot }}
<script src="{{ asset('js/menuLateral/menuLateral.js') }}"></script>
</body>
</html>
