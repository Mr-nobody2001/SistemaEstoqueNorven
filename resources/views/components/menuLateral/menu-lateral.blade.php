@php use Illuminate\Support\Facades\Auth; @endphp
<nav id="menu-lateral" data-expandido="false">
    <span id="icone-hamburguer" class="material-symbols-outlined">menu</span>
    <ul id="lista-menu-lateral">
        <x-menuLateral.item-menu-lateral :textoIcone="'home'" :link="route('inicio')"
                                         :categoria="'Início'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'inventory'" :link="route('registro.index')"
                                         :categoria="'Registro'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'inventory_2'" :link="route('produto.index')"
                                         :categoria="'Produto'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'barcode'" :link="route('lote.index')"
                                         :categoria="'Lote'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'local_shipping'" :link="route('fornecedor.index')"
                                         :categoria="'Fornecedor'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'category'" :link="route('categoria.index')"
                                         :categoria="'Categoria'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'copyright'" :link="route('marca.index')"
                                         :categoria="'Marca'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'person'" :link="route('usuario.edit', ['usuario' => Auth::user()])"
                                         :categoria="'Usuário'"/>
    </ul>
</nav>
