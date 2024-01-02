{{-- Verifica se a categoria passada ao componente --}}
{{-- Caso seja verdadeiro inclui a classe aba-atual no componente --}}
@php
    use Illuminate\Support\Facades\Route;

    if ($categoria === 'Início' && (Route::currentRouteName() === 'index.inicio'
    || Route::currentRouteName() === 'inicio.pesquisa'
    || Route::currentRouteName() === 'inicio.detalhamento')) {
        $eAbaAtual = true;
    } else {
        $eAbaAtual = (bool) stripos(url()->current(), $categoria);
    }
@endphp

<li @class(['item-menu-lateral', 'animate__animated','aba-atual' => $eAbaAtual])>
    <a href="{{ $link }}">
        <span class="material-symbols-outlined">{{ $textoIcone }}</span>
        <p>{{ $categoria }}</p>
    </a>
</li>

