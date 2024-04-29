<div class="row mb-3 pb-3 border-bottom">
    <!--begin::Product=-->
    <div class="col-md-4">
        <div class="d-flex flex-column">
            <div class="d-flex">
                <div class="mt-4 me-4">{{ $index + 1 }}</div>
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
            <div class="mt-3">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $key => $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!--end::Product=-->
    <!--begin::Duration=-->
    <div class="col-md-3">
        <div class="d-flex flex-column accom-info-div">
            <div class="form-group mb-2 row">
                <div class="col-md">
                    <label>Date ( from - to )</label>
                    <input
                        class="form-control date-input date-range booking-date {{ $errors->has('start_date') || $errors->has('end_date') || $errors->has('unavaliable_booking_time') ? 'is-invalid' : '' }}"
                        type="text" data-disabled-dates="{{ json_encode($booked_days) }}" wire:model='booking_date'
                        data-comp-key="@this" data-click-num="0" placeholder="Check In & Out" />
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-md-4">
                    Adults
                </div>
                <div class="col-md">
                    <input class="form-control {{ $errors->has('adults') ? 'is-invalid' : '' }}" type="number"
                        wire:model='adults' wire:change='save' placeholder="Adults" max="{{ $one->adult_capacity }}"
                        min="0" value="0" onfocus="window.temp = this.value; this.value='';"
                        onblur="!this.value ? this.value = window.temp : 0" />
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-md-4">
                    Kids
                </div>
                <div class="col-md">
                    <input class="form-control {{ $errors->has('kids') ? 'is-invalid' : '' }}" type="number"
                        wire:model='kids' wire:change='save' placeholder="Kids" min="0"
                        max="{{ $one->kids_capacity }}" value="0"
                        onfocus="window.temp = this.value; this.value='';"
                        onblur="!this.value ? this.value = window.temp : 0" />
                </div>
            </div>
        </div>
    </div>
    <!--end::Duration=-->
    <!--begin::Options=-->
    <div class="col-md-4">
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
    </div>
    <!--end::Options=-->
    <div class="col-md-1 text-end pe-5 d-flex flex-column">
        <div class="text-center mb-3">
            <b>{{ $itemPriceSum + $options_sum }} {{ settings('currency') }}</b>
        </div>
        <button type="button" class="btn btn-danger remove-from-cart-btn" data-id="{{ $cart_id }}"
            data-type="{{ $product_type }}">
            <span class="fa-solid fa-trash" data-id="{{ $cart_id }}" data-type="{{ $product_type }}"></span>
        </button>
    </div>
</div>
