@push('style')
    <style>
        .flatpickr-day.flatpickr-disabled:not(.inRange) {
            background: #e4e1dc61 !important;
            color: #da515173 !important;
            border: 1px solid #f2a6a630 !important;
        }

        .dayContainer {
            padding: 7px !important;
        }

        .dayContainer .flatpickr-day {
            margin: 1px !important;
            border-radius: 3px;
        }
    </style>
@endpush
<form>
    {{-- @csrf --}}
    @if (isset($cart_booked_days[$product_type]) && count($cart_booked_days[$product_type]) > 0)
        <div class="alert alert-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-secondary">Currently in the Cart:</div>
                <button type="button" class="btn btn-light btn-sm skip-main toggle-cart">View Cart</button>
            </div>
            <ol>
                @foreach ($cart_booked_days[$product_type] as $day)
                    @if (isset($day['in_cart']) && $day['in_cart'])
                        <li class="text-dark"><strong>{{ $day['start_date'] }} <i
                                    class="fa-solid fa-arrow-right text-primary"></i>
                                {{ $day['end_date'] }}</strong></li>
                    @endif
                @endforeach
            </ol>
        </div>
    @endif
    @if (count($errors) > 0)
        <ol class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $key => $error)
                <li class="ms-3 me-3">{{ $error }}</li>
            @endforeach
        </ol>
    @endif
    <div class="form-group">
        <label>Date ( from - to )</label>
        <div class="input-icon icon-left">
            <input
                class="form-control date-input date-range booking-date {{ $errors->has('start_date') || $errors->has('unavaliable_booking_time') ? 'is-invalid' : '' }}"
                type="text" data-disabled-dates="{{ json_encode($booked_days_and_cart) }}" wire:model='booking_date'
                placeholder="Check In & Out" data-click-num="0" data-comp-key="@this" data-validate-only="true" />
            <div class="icon"> <i class="fa-light fa-calendar"></i></div>
        </div>
    </div>
    {{-- <div class="form-group">
        <div class="input-icon icon-left">
            <input class="form-control datetimepicker_1" wire:model='to_date' name="to_date" type="text"
                placeholder="Check Out" />
            <div class="icon"> <i class="fa-light fa-calendar"></i></div>
        </div>
    </div> --}}
    {{-- <div class="form-group">
      <select class="form-select form-control">
        <option disabled="disabled"></option>
        <option value="1">1 Room  </option>
        <option value="1">2 Room  </option>
        <option value="1">3 Room  </option>
        <option value="1">4 Room </option>
      </select>
    </div> --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input class="form-control {{ $errors->has('adults') ? 'is-invalid' : '' }}" type="number"
                    wire:model='adults' wire:change='validateInputs' placeholder="Adults"
                    max="{{ $one->adult_capacity }}" min="0" value="0"
                    onfocus="window.temp = this.value; this.value='';"
                    onblur="!this.value ? this.value = window.temp : 0" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input class="form-control {{ $errors->has('kids') ? 'is-invalid' : '' }}" type="number"
                    wire:model='kids' wire:change='validateInputs' placeholder="Children" min="0"
                    max="{{ $one->kids_capacity }}" value="0" onfocus="window.temp = this.value; this.value='';"
                    onblur="!this.value ? this.value = window.temp : 0" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <h3 class="font-itc mb-3">Options</h3>
        @foreach ($options as $i => $option)
            @if ($option->option)
                {{-- <div class="d-flex align-items-center justify-content-between">
                    <label class="m-checkbox">
                        <input type="checkbox" /><span class="checkmark"> </span>Room Clean
                    </label>
                    <h6>$12 / Night</h6>
                </div> --}}
                <div class="form-group mb-1 option-div">
                    <div class="row align-items-center justify-content-between">
                        <label class="form-check form-check-custom form-check-solid col-md">
                            <input class="form-check-input option-checkbox" type="checkbox"
                                wire:model='selected_options.{{ $option->option->id }}.checked'
                                wire:change='updateOption({{ $option->option->id }}, $event.target.checked)'>
                            <span class="form-check-label text-gray-600">{{ $option->option->title }}</span>
                        </label>
                        @if (!$option->option->option_durations || count($option->option->option_durations) == 0)
                            <h6 class="col-md-3">{{ $option->option->{$price_field} }} / Night</h6>
                        @endif
                    </div>
                    @if (
                        $option->option->option_durations &&
                            count($option->option->option_durations) > 0 &&
                            ($selected_options && $selected_options[$option->option->id]['checked']))
                        <div class="mt-2 d-flex flex-row align-items-center">
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
    <div class="form-group">
        <button class="btn btn-black w-100" type="button" wire:click='add'>
            Add to Cart ( {{ $total + $options_sum }} {{ settings('currency') }} )
        </button>
    </div>
</form>

@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('addCartItem', (cartItem) => {
                console.log('New cartItem: ', cartItem);
                if (Array.isArray(cartItem)) {
                    cartItem = cartItem[0]
                }
                cart_item_index = -1;
                if (cart_item_index >= 0) {
                    cart[cartItem.type][cart_item_index].quantity++;
                } else {
                    cart[cartItem.type].push(cartItem);
                }
                total();
                @this.updateCart(cart[cartItem.type], cartItem.type);
                localStorage.setItem(cartItem.type + '_cart' + updateExtra, JSON.stringify(cart[cartItem
                    .type]));
            });
            @this.on('refresh_cart', () => {
                refreshCart();
                ['accommodations', 'services', 'events'].forEach(itm => {
                    @this.updateCart(cart[itm], itm);
                });
            });
            @this.on('log', (data) => {
                console.log(data[0]);
            });
        });

        $(function() {
            @this.on('TabChanged', () => {
                setTimeout(() => {
                    prepareDateInput();
                    $('.option-div [data-control="select2"]').select2({
                        minimumResultsForSearch: Infinity
                    });
                }, 1000);
            });
            @this.on('optionChanged', () => {
                setTimeout(() => {
                    $('.option-div [data-control="select2"]').select2({
                        minimumResultsForSearch: Infinity
                    });
                }, 200);
            });
            prepareDateInput();
            ['accommodations', 'services', 'events'].forEach(itm => {
                @this.updateCart(cart[itm], itm);
            });
        });
    </script>
@endpush
