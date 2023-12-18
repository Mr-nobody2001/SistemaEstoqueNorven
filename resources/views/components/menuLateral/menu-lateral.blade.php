<nav id="menu-lateral" data-expandido="false">
    <span id="icone-hamburguer" class="material-symbols-outlined">menu</span>
    <ul id="lista-menu-lateral">
        <x-menuLateral.item-menu-lateral :textoIcone="'inventory_2'" :link="'#'" :categoria="'Produto'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'category'" :link="route('categoria.index')" :categoria="'Categoria'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'lists'" :link="'#'" :categoria="'Fornecedores'"/>
        <x-menuLateral.item-menu-lateral :textoIcone="'branding_watermark'" :link="route('marca.index')"
                                         :categoria="'Marca'"/>
    </ul>
</nav>
