<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component{

    public string $route;

    public function __construct($route){
        $this->route = $route;
    }

    public function render(): View{
        return view('components.delete-button');
    }
}
