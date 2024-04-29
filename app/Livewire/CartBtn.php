<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CartBtn extends Component
{

    public $cartCount = 0;
    public $routeName = '';

    public function setValue($name, $value)
    {
        $this->{$name} = $value;
    }

    #[On('refreshCart')]
    public function refreshCart()
    {
        $this->dispatch('refresh_cart');
    }

    public function render()
    {
        return view('livewire.cart-btn');
    }
}
