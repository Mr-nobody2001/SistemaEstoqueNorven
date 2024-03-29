<?php

namespace App\View\Components\menuLateral;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemMenuLateral extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $textoIcone, public string $link, public string $categoria)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public
    function render(): View|Closure|string
    {
        return view('components.menuLateral.item-menu-lateral');
    }
}
