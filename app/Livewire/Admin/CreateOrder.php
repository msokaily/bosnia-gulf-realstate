<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CreateOrder extends Component
{
    public $order = null;
    
    public $accommodations = [];
    public $services = [];
    public $events = [];

    public array $accommodations_cart;
    public array $services_cart;
    public array $events_cart;

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

    public function updateTotal($total)
    {
        $this->total = $total;
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
    }

    public function select_tab($tab)
    {
        $this->selected_tab = $tab;
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
    }

    public function refresh($items, $type)
    {
        $items = json_decode(json_encode($items));
        if ($type == 'services') {
            $this->services = $items;
        } else if ($type == 'events') {
            $this->events = $items;
        } else {
            $this->accommodations = $items;
        }
        $this->dispatch('TabChanged');
    }

    public function render()
    {
        return view('livewire.admin.create-order');
    }
}
