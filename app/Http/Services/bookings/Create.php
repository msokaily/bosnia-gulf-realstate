<?php

namespace App\Http\Services\bookings;

use App\Models\Booking;
use Carbon\Carbon;

class Create
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function create()
    {
        if ($this->data) {
            $data = $this->data;
        } else {
            return false;
        }
        $price_field = $data['customer_type'] == 'standard' ? '' : $data['customer_type'] . '_';

        $total = 0;

        foreach ($data['cart_items'] as $cart_type => $cart) {
            foreach ($cart as $item) {
                if ($cart_type == 'accommodations') {
                    $days = (Carbon::parse($item['end_date'])->diffInDays(Carbon::parse($item['start_date'])) + 1);
                    $total += $item['item'][$price_field . 'price'] * $days;
                    if ($item['options']) {
                        foreach ($item['options'] as $opt) {
                            if ($opt['duration']) {
                                $total += $opt['duration'][$price_field . 'price'];
                            } else {
                                $total += $opt['option'][$price_field . 'price'] * $days;
                            }
                        }
                    }
                }
            }
        }

        $data['total_price'] = $total;

        $newOrder = Booking::create($data);

        if ($newOrder) {
            foreach ($data['cart_items'] as $cart_type => $cart) {
                foreach ($cart as $item) {
                    if ($cart_type == 'accommodations') {
                        $newOrderProduct = $newOrder->products()->create([
                            'entity_id' => $item['item']['id'],
                            'start_date' => $item['start_date'],
                            'end_date' => $item['end_date'],
                            'arrival_time' => 0,
                            'price' => $item['item'][$price_field . 'price'],
                            'adults' => $item['adults'],
                            'kids' => $item['kids']
                        ]);
                        if ($newOrderProduct) {
                            $optionsPrice = 0;
                            if ($item['options']) {
                                foreach ($item['options'] as $opt) {
                                    if ($opt['duration']) {
                                        $optionsPrice = $opt['duration'][$price_field . 'price'];
                                    } else {
                                        $optionsPrice = $opt['option'][$price_field . 'price'];
                                    }
                                    $newOrderProduct->options()->create([
                                        'option_id' => $opt['option']['id'],
                                        'option_duration_id' => isset($opt['duration']) ? $opt['duration']['id'] : null,
                                        'price' => $optionsPrice
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            return Booking::find($newOrder->id);
        } else {
            return false;
        }
    }
}
