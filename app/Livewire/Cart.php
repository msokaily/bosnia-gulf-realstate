<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public array $accommodations_cart;
    public array $services_cart;
    public array $events_cart;

    public array $all_cart;

    public $customer_type = 'standard';
    public $price_field = 'price';
    public $total = 0;
    public $cart_booked_days;

    public $selected_tab = 'accommodations';

    public function mount()
    {
        $this->customerTypeChanged();
        $this->cart_booked_days = [
            'accommodations' => [],
            'services' => [],
            'events' => []
        ];
    }

    #[On('refreshCart')]
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
        $entity = 0;
        foreach ($items as $index => $item) {
            if ($item->entity_id != $entity) {
                $this->cart_booked_days[$type][$item->entity_id] = [];
            }
            $this->cart_booked_days[$type][$item->entity_id][] = [
                'start_date' => $item->start_date,
                'end_date' => $item->end_date,
                'index' => $index,
                'in_cart' => true
            ];
            $entity = $item->entity_id;
        }
        $this->dispatch('CartBookedDays', $this->cart_booked_days);
        $this->dispatch('refreshCartOrderForm');
        $this->dispatch('refreshCartCheckout');
    }

    public function select_tab($tab)
    {
        $this->selected_tab = $tab;
    }

    public function submitRemove()
    {
        $this->dispatch('refreshCart');
        $this->dispatch('refreshCartPage');
    }

    public function customerTypeChanged($customer_type = null)
    {
        if ($customer_type) {
            $this->customer_type = $customer_type;
        }
        if ($this->customer_type == 'local') {
            $this->price_field = 'local_price';
        }else if ($this->customer_type == 'bundle') {
            $this->price_field = 'bundle_price';
        } else {
            $this->price_field = 'price';
        }
        $this->dispatch('CustomerTypeChanged', $this->price_field);
    }
    
    public function remove($index, $type)
    {
        if ($type == 'services') {
            unset($this->services_cart[$index]);
        } elseif ($type == 'events') {
            unset($this->events_cart[$index]);
        } else {
            unset($this->accommodations_cart[$index]);
        }
        $this->updateAllCart();
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
