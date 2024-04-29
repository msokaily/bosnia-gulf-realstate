<?php

namespace App\Livewire\Admin;

use App\Models\BookingProducts;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class AccommodationCartItem extends Component
{
    public $id = null;
    public $index = 0;
    public $cart_id;
    public $cartItem;
    public $one;
    public $product_type = 'accommodations';
    public $price_field;
    public $booking_date;
    public $start_date;
    public $end_date;
    public $adults;
    public $kids;
    public $options;
    public $selected_options;
    public $confirm_reset;
    public $itemPriceSum;
    public $options_sum;
    public $booked_days = [];
    public $cart_booked_days = [];

    private function rules()
    {
        return [
            // 'start_date' => 'required|date|before_or_equal:end_date',
            // 'end_date' => 'required|date|after_or_equal:start_date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'adults' => 'required|numeric|gt:0|lte:' . $this->one->adult_capacity,
            'kids' => 'sometimes|numeric|lte:' . $this->one->kids_capacity,
        ];
    }

    public function mount()
    {
        $this->id = $this->cartItem->id ?? null;
        $this->one = $this->cartItem->item;
        $this->cart_id = $this->cartItem->cart_id;
        $this->options = $this->one->options;
        $this->start_date = $this->cartItem->start_date;
        $this->end_date = $this->cartItem->end_date;
        $this->booking_date = $this->start_date . ' to ' . $this->end_date;
        $this->adults = (int)$this->cartItem->adults;
        $this->kids = (int)$this->cartItem->kids;
        $this->confirm_reset = false;
        foreach ($this->options as $v) {
            $optionVar = [
                'checked' => false,
                'duration' => null,
                'duration_item' => null,
                'price' => 0,
                'option' => $v->option
            ];
            foreach ($this->cartItem->options as $opt) {
                if ($v->option->id == $opt->id) {
                    $optionVar['checked'] = true;
                    $optionVar['price'] = price($opt->option, $this->price_field);
                    if ($opt->duration) {
                        $optionVar['duration_item'] = $opt->duration;
                        $optionVar['duration'] = $opt->duration->duration_id;
                        $optionVar['price'] = price($opt->duration, $this->price_field);
                    }
                }
            }
            $selected_options[$v->option->id] = $optionVar;
        }
        $this->selected_options = $selected_options;
        $this->itemPriceSum = 0;
        $this->options_sum = 0;
        $this->booked_days = $this->bookedDays();
        $this->setCartBookedDays($this->cart_booked_days);
        $this->calcItemPrice();
        $this->optionsSum();
        $this->validateInputs();
        $this->dispatch('TabChanged');
    }

    #[On('CustomerTypeChanged')]
    public function setPriceField($price_field)
    {
        $this->price_field = $price_field;
        $this->calcItemPrice();
    }

    #[On('CartBookedDays')]
    public function setCartBookedDays($cartBookedDays)
    {
        $cartBookedDays = isset($cartBookedDays[$this->product_type][$this->one->id]) ? $cartBookedDays[$this->product_type][$this->one->id] : [];
        $found_key = array_search($this->index, array_column($cartBookedDays, 'index'));
        if ($found_key >= 0) {
            unset($cartBookedDays[$found_key]);
        }
        $this->booked_days = array_merge($this->bookedDays(), $cartBookedDays);
        $this->dispatch('TabChanged');
    }

    public function setValue($var, $value)
    {
        $this->{$var} = $value;
    }

    public function calcItemPrice()
    {
        $this->itemPriceSum = price($this->one, $this->price_field) * (Carbon::parse($this->end_date)->diffInDays(Carbon::parse($this->start_date)) + 1);
    }

    public function updateDuration($option_id, $duration_id)
    {
        $this->selected_options[$option_id]['duration'] = $duration_id;
        $durations = $this->selected_options[$option_id]['option']->option_durations;
        if ($durations) {
            $found_key = array_search($duration_id, array_column(is_array($durations) ? $durations : $durations->toArray(), 'duration_id'));
            $this->selected_options[$option_id]['price'] = price($durations[$found_key], $this->price_field);
            $this->selected_options[$option_id]['duration_item'] = $durations[$found_key];
        }
        $this->optionsSum();
        $this->save();
    }
    public function updateOption($id, $checked)
    {
        $durations = $this->selected_options[$id]['option']->option_durations;
        if ($this->selected_options[$id]['option']->is_durations && $durations && count($durations) > 0) {
            if ($checked) {
                $this->selected_options[$id]['duration'] = $durations[0]->duration->id;
                $this->selected_options[$id]['price'] = price($durations[0], $this->price_field);
                $this->selected_options[$id]['duration_item'] = $durations[0];
            } else {
                $this->selected_options[$id]['duration'] = null;
                $this->selected_options[$id]['price'] = 0;
                $this->selected_options[$id]['duration_item'] = null;
            }
        } else {
            $this->selected_options[$id]['price'] = price($this->selected_options[$id]['option'], $this->price_field);
        }
        $this->selected_options[$id]['checked'] = $checked;
        $this->optionsSum();
        $this->save();
        $this->dispatch('optionChanged');
    }

    private function checkedOptions()
    {
        $options = [];
        foreach ($this->selected_options as $id => $one) {
            if ($one['checked']) {
                $options[] = [
                    'id' => $id,
                    'option' => $one['option'],
                    'duration_id' => isset($one['duration']) ? $one['duration'] : null,
                    'duration' => isset($one['duration_item']) ? $one['duration_item'] : null,
                    'price' => $one['price'],
                ];
            }
        }
        return $options;
    }

    private function optionsSum()
    {
        $days = (Carbon::parse($this->end_date)->diffInDays(Carbon::parse($this->start_date)) + 1);
        $sum = 0;
        foreach ($this->selected_options as $id => $one) {
            if ($one['checked']) {
                $sum += isset($one['duration']) && $one['duration'] ? (float)$one['price'] : (float)$one['price'] * $days;
            }
        }
        $this->options_sum = $sum;
        return $sum;
    }

    private function isDateBooked()
    {
        $s = new \DateTime($this->start_date);
        $e = new \DateTime($this->end_date);
        foreach ($this->booked_days as $range) {
            $start = new \DateTime($range['start_date']);
            $end = new \DateTime($range['end_date']);
            if (($s >= $start && $s <= $end) || ($e >= $start && $e <= $end)) {
                return true;
            }
        }
        return false;
    }

    public function validateInputs()
    {
        try {
            $bookingDate = explode(' to ', $this->booking_date);
            $this->start_date = $bookingDate[0];
            $this->end_date = $bookingDate[1];
        } catch (\Throwable $th) {
            if ($this->booking_date) {
                $this->start_date = $this->booking_date;
                $this->end_date = $this->booking_date;
                $this->booking_date = $this->start_date.' to '.$this->end_date;
            }
        }
        $this->validate($this->rules());
        if ($this->isDateBooked()) {
            $this->addError('unavaliable_booking_time', 'The booking date is not avaliable right now.');
            return false;
        }
        $this->calcItemPrice();
        return true;
    }

    private function bookedDays()
    {
        $bookedDays =  BookingProducts::where(['entity_id' => $this->one->id, 'type' => 'accommodation'])->whereHas('booking', function ($q) {
            $q->where('status', 'Confirmed');
        });
        if ($this->id) {
            $bookedDays->where('id', '!=', $this->id);
        }
        return $bookedDays->get(['start_date', 'end_date'])->toArray();
    }

    public function save()
    {
        if (!$this->validateInputs()) {
            return;
        }
        $data = $this->only('start_date', 'end_date', 'adults', 'kids');
        $data['cart_id'] = $this->cart_id;
        $data['entity_id'] = $this->one->id;
        $data['type'] = 'accommodations';
        $data['quantity'] = 1;
        $data['item'] = $this->one;
        $data['options'] = $this->checkedOptions();
        $this->dispatch('updateCartItem', $this->index, $data);
    }

    public function render()
    {
        return view('livewire.admin.accommodation-cart-item');
    }
}
