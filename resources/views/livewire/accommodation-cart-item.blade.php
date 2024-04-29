<div @if ($widePage) class="row" @endif>
    <div class="px-4 @if ($widePage) col-md-12 @endif" style="position: relative;">
        <div class="cart-item-counter">{{ $index + 1 }}</div>
        @if ($widePage)
            <div class="row">
        @endif
        <div class="d-flex align-items-center mb-3 @if($widePage) col-md-6 @endif">
            <button type="button" class="btn p-1 text-danger border-0 remove-from-cart-btn" data-id="{{ $cart_id }}"
                data-type="{{ $product_type }}">
                <i class="fa-regular fa-xmark" data-id="{{ $cart_id }}" data-type="{{ $product_type }}"></i>
            </button>
            <div class="image-cart mx-2">
                <a href="{{ route($one->type, $one->slug) }}" target="_self">
                    <img src="{{ $one->image }}" alt="{{ $one->title }}" />
                </a>
            </div>
            <div>
                <a href="{{ route($one->type, $one->slug) }}" target="_self">
                    <h5 class="font-news-bold">{{ $one->title }} {{ $one->number }}</h5>
                </a>
                <div>{{ $one->{$price_field} }} {{ settings('currency') }}</div>
            </div>
        </div>
        @if ($widePage)
            <div class="mt-3 col-md">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $key => $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif
</div>
@if(!$widePage)
    <div class="px-4 mt-3">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $key => $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
    </div>
@endif
<div class="px-4 mb-3 @if ($widePage) col-md @endif">
    <h3 class="font-itc mb-2">Details</h3>
    <div class="row mb-2 ms-1">
        <div class="col-md">
            <label>Date ( from - to )</label>
            <input
                class="form-control date-input date-range booking-date {{ $errors->has('start_date') || $errors->has('end_date') || $errors->has('unavaliable_booking_time') ? 'is-invalid' : '' }}"
                type="text" data-disabled-dates="{{ json_encode($booked_days) }}" wire:model='booking_date'
                data-comp-key="@this" data-click-num="0" placeholder="Check In & Out" />
        </div>
    </div>
    <div class="row ms-1">
        <div class="col-lg-6">
            <label>Adults</label>
            <input class="form-control {{ $errors->has('adults') ? 'is-invalid' : '' }}" type="number"
                wire:model='adults' wire:change='save' placeholder="Adults" max="{{ $one->adult_capacity }}"
                min="0" value="0" onfocus="window.temp = this.value; this.value='';"
                onblur="!this.value ? this.value = window.temp : 0" />
        </div>
        <div class="col-lg-6">
            <label>Children</label>
            <input class="form-control {{ $errors->has('kids') ? 'is-invalid' : '' }}" type="number" wire:model='kids'
                wire:change='save' placeholder="Kids" min="0" max="{{ $one->kids_capacity }}" value="0"
                onfocus="window.temp = this.value; this.value='';"
                onblur="!this.value ? this.value = window.temp : 0" />
        </div>
    </div>
</div>
<div class="px-4 @if ($widePage) col-md @endif">
    <h3 class="font-itc mb-2">Options</h3>
    <div class="d-flex flex-column ms-4">
        @foreach ($options as $i => $option)
            @if ($option->option)
                <div class="form-group mb-1 option-div">
                    <div class="row align-items-center justify-content-between">
                        <label class="form-check form-check-custom form-check-solid col-md">
                            <input class="form-check-input option-checkbox" type="checkbox"
                                wire:model='selected_options.{{ $option->option->id }}.checked'
                                wire:change='updateOption({{ $option->option->id }}, $event.target.checked)'>
                            <span class="form-check-label text-gray-600">{{ $option->option->title }}</span>
                        </label>
                        @if (!$option->option->option_durations || count($option->option->option_durations) == 0)
                            <h6 class="col-md-3">{{ $option->option->{$price_field} }} / night</h6>
                        @endif
                    </div>
                    @if (
                        $option->option->option_durations &&
                            count($option->option->option_durations) > 0 &&
                            ($selected_options && $selected_options[$option->option->id]['checked']))
                        <div class="mt-2 mb-2 d-flex flex-row align-items-center">
                            <label class="me-2"><b>Duration</b></label>
                            <select wire:model='selected_options.{{ $option->option->id }}.duration'
                                wire:change='updateDuration({{ $option->option->id }}, $event.target.value)'
                                class="form-control">
                                @foreach ($option->option->option_durations as $durat)
                                    <option value="{{ $durat->duration->id }}">
                                        {{ $durat->duration->value }}
                                        {{ $durat->duration->duration_type }} -
                                        {{ $durat->{$price_field} }}
                                        {{ settings('currency') }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
<div class="px-4 mb-3 @if ($widePage) col-md-2 @endif">
    <h3 class="font-itc">Total <b style="float: right;">{{ $itemPriceSum + $options_sum }}
            {{ settings('currency') }}</b></h3>
</div>
<hr />
</div>
