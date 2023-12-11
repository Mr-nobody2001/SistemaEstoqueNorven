{{-- Verifica se a categoria passada ao componente --}}
{{-- Caso seja verdadeiro inclui a classe aba-atual no componente --}}
@php
    $eAbaAtual = (bool) stripos($link, $categoria);
@endphp

<li @class(['item-menu-lateral', 'animate__animated','aba-atual' => $eAbaAtual])>
    <a href="{{ $link }}">
        <span class="material-symbols-outlined">{{ $textoIcone }}</span>
        <p>{{ $categoria }}</p>
    </a>
</li>

