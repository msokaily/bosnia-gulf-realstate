<?php

namespace App\Livewire;

use App\Http\Services\bookings\Create as CreateOrderService;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PayBtn extends Component
{
    public $total = 0;

    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $postal_code;

    #[On('refreshCartCheckout')]
    public function refreshTotal()
    {
        $this->dispatch('refresh_total');
    }
    public function setTotal($total)
    {
        $this->total = $total;
    }
    public function submit($cartItems)
    {
        $data['payment_type'] = 'Online';
        $data['customer_type'] = 'standard';

        $data['currency'] = settings('currency');

        $data['status'] = 'New';
        $data['paid_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = Carbon::now()->format('Y-m-d H:i:s');

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        } else {
            $data['user_id'] = -1;
            $data['guest_info'] = $this->only(['first_name', 'last_name', 'address', 'city', 'postal_code']);
        }

        $data['cart_items'] = $cartItems;

        $newOrder = (new CreateOrderService($data))->create();

        if ($newOrder) {
            $this->dispatch('clear_cart');
            return redirect(route('checkout.success', $newOrder->id))->with([
                'status' => true,
                'message' => __('common.create')
            ]);
        } else {
            return redirect()->back()->with([
                'status' => false,
                'message' => __('common.add_fail')
            ]);
        }
    }
    public function render()
    {
        return view('livewire.pay-btn');
    }
}
