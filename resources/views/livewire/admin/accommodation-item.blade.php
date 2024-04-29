<tr>
    <!--begin::Checkbox-->
    <td class="pt-10">
        {{ $index + 1 }}
    </td>
    <!--end::Checkbox-->
    <!--begin::Product=-->
    <td class="w-160px max-w-160px">
        <div class="d-flex flex-column">
            <div class="d-flex">
                <!--begin::Thumbnail-->
                <a href="{{ route("admin.$product_type.edit", $one->id) }}" target="_blank" class="symbol symbol-50px">
                    <span class="symbol-label" style="background-image:url('{{ $one->image }}');"></span>
                </a>
                <!--end::Thumbnail-->
                <div class="ms-5">
                    <!--begin::Title-->
                    <a href="{{ route("admin.$product_type.edit", $one->id) }}" target="_blank"
                        class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $one->title }}
                        {{ $one->number }}</a>
                    <!--end::Title-->
                    <!--begin::Price-->
                    <div class="fw-bold fs-7">Price: {{ settings('currency') }}
                        <span data-kt-ecommerce-edit-order-filter="price"
                            class="text-dark">{{ $one->{$price_field} }}</span>
                    </div>
                    <div class="fw-semibold fs-7">Adults Capacity: <span
                            class="text-dark">{{ $one->adult_capacity }}</span></div>
                    <div class="fw-semibold fs-7">Kids Capacity: <span
                            class="text-dark">{{ $one->kids_capacity }}</span></div>
                    <!--end::Price-->
                    <!--begin::SKU-->
                    {{-- <div class="text-muted fs-7">SKU: <span class="text-dark">{{ $one->number }}</span></div> --}}
                    <!--end::SKU-->
                </div>
            </div>
            @if (count($booked_days) > 0)
                <div class="mt-3">
                    <div class="text-warning">Current Bookings</div>
                    <ul>
                        @foreach ($booked_days as $day)
                            <li class="text-dark">{{ $day['start_date'] }} <i
                                    class="fa-solid fa-arrow-right text-primary"></i> {{ $day['end_date'] }}
                                {!! isset($day['in_cart']) && $day['in_cart'] ? '<span class="text-primary">(still in cart)</span>' : '' !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="mt-3">
                    @foreach ($errors->all() as $key => $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </td>
    <!--end::Product=-->
    <!--begin::Duration=-->
    <td>
        <div class="d-flex flex-column accom-info-div">
            <div class="form-group mb-2 row">
                <div class="col-md">
                    <label>Date ( from - to )</label>
                    <input
                        class="form-control date-input date-range {{ $errors->has('start_date') || $errors->has('unavaliable_booking_time') ? 'is-invalid' : '' }}"
                        type="text" data-disabled-dates="{{ json_encode($booked_days) }}" wire:model='booking_date'
                        wire:change='validateInputs' placeholder="Check In & Out" />
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-md-4">
                    Adults
                </div>
                <div class="col-md">
                    <input class="form-control {{ $errors->has('adults') ? 'is-invalid' : '' }}" type="number"
                        wire:model='adults' wire:change='validateInputs' placeholder="Adults"
                        max="{{ $one->adult_capacity }}" min="0" value="0"
                        onfocus="window.temp = this.value; this.value='';"
                        onblur="!this.value ? this.value = window.temp : 0" />
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-md-4">
                    Kids
                </div>
                <div class="col-md">
                    <input class="form-control {{ $errors->has('kids') ? 'is-invalid' : '' }}" type="number"
                        wire:model='kids' wire:change='validateInputs' placeholder="Kids" min="0"
                        max="{{ $one->kids_capacity }}" value="0"
                        onfocus="window.temp = this.value; this.value='';"
                        onblur="!this.value ? this.value = window.temp : 0" />
                </div>
            </div>
        </div>
    </td>
    <!--end::Duration=-->
    <!--begin::Options=-->
    <td>
        <div class="d-flex flex-column">
            @foreach ($options as $i => $option)
                @if ($option->option)
                    <div class="form-group mb-1 option-div">
                        <div class="row align-items-center justify-content-between">
                            <label class="form-check form-check-custom form-check-solid col-md ps-3">
                                <input class="form-check-input option-checkbox" type="checkbox"
                                    wire:model='selected_options.{{ $option->option->id }}.checked'
                                    wire:change='updateOption({{ $option->option->id }}, $event.target.checked)'>
                                <span class="form-check-label text-gray-600">{{ $option->option->title }}</span>
                            </label>
                            @if (!$option->option->option_durations || count($option->option->option_durations) == 0)
                                <h6 class="col-md-3 mb-0">{{ price($option->option, $price_field) }} / night</h6>
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
                                            {{ price($durat, $price_field) }}
                                            {{ settings('currency') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </td>
    <!--end::Options=-->
    <td class="text-end pe-5 d-flex flex-column">
        <button type="button" class="btn btn-primary add-to-cart-btns" data-id="{{ $one->id }}"
            data-type="{{ $product_type }}" wire:click='add'>
            Add {{ $total + $options_sum }} {{ settings('currency') }}
        </button>
        @if ($confirm_reset)
            <button type="button" class="btn btn-warning mt-2" wire:click='resetAll'>
                Are you sure ?
            </button>
            <button type="button" class="btn btn-light mt-2" wire:click='setValue("confirm_reset", false)'>
                No, cancel
            </button>
        @else
            <button type="button" class="btn btn-dark mt-2" wire:click='setValue("confirm_reset", true)'>
                Reset
            </button>
        @endif
    </td>
</tr>
