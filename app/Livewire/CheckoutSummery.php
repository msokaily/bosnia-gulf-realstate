<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutSummery extends Component
{
    public array $accommodations_cart;
    public array $services_cart;
    public array $events_cart;

    public array $all_cart;

    public $customer_type = 'standard';
    public $price_field = 'price';
    public $total = 0;

    #[On('refreshCartCheckout')]
    public function refreshCart()
    {
        $this->dispatch('refresh_cart');
    }

    public function updateTotal($total)
    {
        $this->total = $total;
    }
    
    private function updateAllCart()
    {
        $this->all_cart = array_merge($this->accommodations_cart, $this->services_cart, $this->events_cart);
    }

    public function updateCart($items, $type)
    {
        $items = json_decode(json_encode($items));
        if ($type == 'services') {
            $this->services_cart = $items;
        } else if ($type == 'events') {
            $this->events_cart = $items;
        } else {
            $this->accommodations_cart = $items;
        }
        $this->updateAllCart();
    }
    
    public function render()
    {
        return view('livewire.checkout-summery');
    }
}
