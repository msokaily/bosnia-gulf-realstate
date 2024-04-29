@push('style')
    <style>
        .types-tabs .nav-item>a {
            cursor: pointer;
        }
    </style>
@endpush
<div class="card-body pt-0">
    <!--begin:::Tabs-->
    <div class="flex-lg-row-fluid">
        <div class="d-flex flex-column gap-10">
            <!--begin::Input group-->
            <div>
                <!--begin::Label-->
                <label class="form-label">accommodations in this order</label>
                <!--end::Label-->
                <!--begin::Selected products-->
                <div class="row border border-dashed rounded pt-3 pb-1 px-2 mb-5 mh-300px overflow-scroll"
                    id="kt_ecommerce_edit_order_selected_products">
                    <div class="col-md-12 mb-2">
                        <!--begin::Empty message-->
                        <span class="w-100 text-muted">Select one or more accommodation from the list below by
                            clicking the add button.</span>
                        <!--end::Empty message-->
                    </div>
                    <div class="col-md-12">
                        @foreach ($accommodations_cart as $index => $one)
                            @livewire('admin.accommodation-cart-item', ['cartItem' => $one, 'product_type' => 'accommodations', 'price_field' => $price_field, 'index' => $index, 'cart_booked_days' => $cart_booked_days], key('accommodation_cart_item_' . $one->entity_id . '_' . $index))
                        @endforeach
                    </div>
                </div>
                <!--begin::Selected products-->
                <!--begin::Total price-->
                <div class="fw-bold fs-4">Total Cost: {{ settings('currency') }}
                    <span id="kt_ecommerce_edit_order_total_price">{{ $total }} <span class="spinner-border"
                            wire:loading style="width: 16px; height: 16px;"></span></span>
                </div>
                <!--end::Total price-->
            </div>
            <!--end::Input group-->
            <!--begin::Separator-->
            <div class="separator"></div>
            <!--end::Separator-->
        </div>
        <div class="d-flex flex-column gap-10 mt-5">
            <ul
                class="types-tabs nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 tab-accommodations {{ $selected_tab == 'accommodations' ? 'active' : '' }}"
                        data-type="accommodations">Accommodations</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 tab-services {{ $selected_tab == 'services' ? 'active' : '' }}"
                        data-type="services">Services</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 tab-events {{ $selected_tab == 'events' ? 'active' : '' }}"
                        data-type="events">Events</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
        </div>
        <div class="d-flex flex-column gap-10">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $selected_tab == 'accommodations' ? 'show active' : '' }}"
                    id="kt_ecommerce_products_accommodations" role="tabpanel">
                    @php
                        $product_type = 'accommodations';
                    @endphp
                    <!--begin::Search products-->
                    <div class="d-flex align-items-center position-relative">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text"
                            class="search-accommodations form-control form-control-solid w-100 w-lg-50 ps-14"
                            placeholder="Search {{ $product_type }}" />
                    </div>
                    <!--end::Search products-->
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 products-table"
                        id="kt_table_{{ $product_type }}">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="pe-2"></th>
                                <th class="w-160px max-w-160px">Accommodation</th>
                                <th class="w-200px">Duration & Guests</th>
                                <th class="w-220px">options</th>
                                <th class="w-160px text-end pe-5">Actions</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($accommodations as $index => $one)
                                <!--begin::Table row-->
                                @livewire('admin.accommodation-item', ['one' => $one, 'product_type' => $product_type, 'price_field' => $price_field, 'index' => $index], key($one->id))
                                <!--end::Table row-->
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <div class="tab-pane fade {{ $selected_tab == 'services' ? 'show active' : '' }}"
                    id="kt_ecommerce_products_services" role="tabpanel">
                    @php
                        $product_type = 'services';
                    @endphp
                    <!--begin::Search products-->
                    <div class="d-flex align-items-center position-relative">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text"
                            class="search-{{ $product_type }} form-control form-control-solid w-100 w-lg-50 ps-14"
                            placeholder="Search {{ $product_type }}" />
                    </div>
                    <!--end::Search products-->
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_{{ $product_type }}">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-25px pe-2"></th>
                                <th class="min-w-200px">Service</th>
                                <th class="min-w-100px text-end pe-5">Qty Remaining</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($services as $index => $one)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        {{ $index + 1 }}
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Product=-->
                                    <td>
                                        <div class="d-flex align-items-center"
                                            data-kt-ecommerce-edit-order-filter="{{ $product_type }}"
                                            data-kt-ecommerce-edit-order-id="{{ $one->id }}">
                                            <!--begin::Thumbnail-->
                                            <a href="{{ route("admin.$product_type.edit", $one->id) }}" target="_blank"
                                                class="symbol symbol-50px">
                                                <span class="symbol-label"
                                                    style="background-image:url('{{ $one->image_url->url }}');"></span>
                                            </a>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $one->title }}</a>
                                                <!--end::Title-->
                                                <!--begin::Price-->
                                                <div class="fw-semibold fs-7">Price: {{ settings('currency') }}
                                                    <span
                                                        data-kt-ecommerce-edit-order-filter="price">{{ $one->{$price_field} }}</span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::Product=-->
                                    <!--begin::Qty=-->
                                    <td class="text-end pe-5" data-order="6">
                                        <span class="badge badge-light-warning">Low stock</span>
                                        <span class="fw-bold text-warning ms-3">6</span>
                                    </td>
                                    <!--end::Qty=-->
                                </tr>
                                <!--end::Table row-->
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function priceFunc(item, price_field) {
            if (item[price_field]) {
                return item[price_field];
            } else {
                return item?.price;
            }
        }

        let products = {
            accommodations: @js($accommodations),
            services: @js($services),
            events: @js($events)
        };
        let currentTab = 'accommodations';
        let price_type = 'standard';

        let order = @js($order, null);
        let updateExtra = '';
        if (order) {
            updateExtra = '_' + order?.id;
            let temp_accommodations_cart = [];
            price_type = order?.price_type;
            let price_prefix = '';
            if (price_type == 'local') {
                price_prefix = 'local_';
            } else if (price_type == 'bundle') {
                price_prefix = 'bundle_';
            }
            order?.products.forEach(prod => {
                temp_accommodations_cart.push({
                    id: prod?.id,
                    item: prod?.product,
                    quantity: 1,
                    type: 'accommodations',
                    entity_id: prod?.product?.id,
                    cart_id: parseInt(Math.random() * 10000000000),
                    start_date: prod?.start_date,
                    end_date: prod?.end_date,
                    adults: prod?.adults,
                    kids: prod?.kids,
                    options: prod?.options?.map(v => {
                        return {
                            id: v?.option_id,
                            option: v?.option?.option,
                            duration_id: v?.option_duration_id ?? null,
                            duration: v?.option_duration_id ? v?.duration : null,
                            price: v?.option_duration_id ? priceFunc(v?.duration, price_prefix + 'price') : priceFunc(v?.option?.option, price_prefix + 'price')
                        };
                    })
                });
            });
            localStorage.setItem('accommodations_cart' + updateExtra, JSON.stringify(temp_accommodations_cart));
        }
        let accommodationsStorage = [];
        try {
            accommodationsStorage = JSON.parse(localStorage.getItem('accommodations_cart' + updateExtra)) || [];
        } catch (error) {
            accommodationsStorage = [];
        }
        let servicesStorage = [];
        try {
            servicesStorage = JSON.parse(localStorage.getItem('services_cart' + updateExtra)) || [];
        } catch (error) {
            servicesStorage = [];
        }
        let eventsStorage = [];
        try {
            eventsStorage = JSON.parse(localStorage.getItem('events_cart' + updateExtra)) || [];
        } catch (error) {
            eventsStorage = [];
        }
        let cart = {
            accommodations: accommodationsStorage,
            services: servicesStorage,
            events: eventsStorage
        };
        console.log({
            cart
        });

        document.addEventListener('livewire:initialized', () => {
            @this.on('addCartItem', (cartItem) => {
                console.log('New cartItem: ', cartItem);
                if (Array.isArray(cartItem)) {
                    cartItem = cartItem[0]
                }
                cart_item_index = -1; //inCart(item, type);
                if (cart_item_index >= 0) {
                    cart[cartItem.type][cart_item_index].quantity++;
                } else {
                    cart[cartItem.type].push(cartItem);
                }
                @this.updateCart(cart[cartItem.type], cartItem.type);
                @this.updateTotal(total());
                localStorage.setItem(cartItem.type + '_cart' + updateExtra, JSON.stringify(cart[cartItem
                    .type]));
            });
            @this.on('updateCartItem', (data) => {
                console.log('updateCartItem: ', data);
                let cartItem, index;
                if (Array.isArray(data)) {
                    index = data[0];
                    cartItem = data[1];
                }
                if (cart[cartItem.type][index]) {
                    cart[cartItem.type][index] = cartItem;
                } else {
                    cart[cartItem.type].push(cartItem);
                }
                @this.updateCart(cart[cartItem.type], cartItem.type);
                @this.updateTotal(total());
                localStorage.setItem(cartItem.type + '_cart' + updateExtra, JSON.stringify(cart[cartItem
                    .type]));
            });
        });

        function inCart(item, type) {
            return cart[type].findIndex(v => v?.entity_id == item?.id);
        }

        function total() {
            let price = 0;
            let optionsPrice = 0;
            ['accommodations', 'services', 'events'].forEach(type => {
                let price_prefix = '';
                if (price_type == 'local') {
                    price_prefix = 'local_';
                } else if (price_type == 'bundle') {
                    price_prefix = 'bundle_';
                }
                cart[type].forEach(element => {
                    let days = Math.abs((new Date(new Date(element.end_date) - new Date(element.start_date))
                        .getTime()) / (1000 * 60 * 60 * 24)) + 1;
                    const opts = element?.options;
                    optionsPrice = 0;
                    if (opts) {
                        for (let i = 0; i < opts.length; i++) {
                            const opt = opts[i];
                            if (opt?.duration) {
                                optionsPrice += priceFunc(opt?.duration, price_prefix + 'price');
                            } else {
                                optionsPrice += priceFunc(opt?.option, price_prefix + 'price') * days;
                            }
                        }
                    }
                    price += (priceFunc(element?.item, price_prefix + 'price') * days) + optionsPrice;
                });
            });
            return price;
        }
        $(function() {
            $(".types-tabs .nav-item > a").click((e) => {
                const type = $(e.target).data('type');
                @this.select_tab(type);
            });
            $("body").on('click', ".remove-from-cart-btn", (e) => {
                const type = $(e.target).data('type');
                const id = $(e.target).data('id');
                const index = cart[type].findIndex(v => v?.cart_id == id);
                if (index >= 0) {
                    cart[type].splice(index, 1);
                    @this.updateCart(cart[type], type);
                    @this.updateTotal(total());
                    localStorage.setItem(type + '_cart', JSON.stringify(cart[type]));
                }
            });
            $("body").on('change', ".customer-type-select", (e) => {
                price_type = e.target.value;
                @this.customerTypeChanged(e.target.value);
                @this.updateTotal(total());
            });
            $("body").on('click', ".add-to-cart-btn", (e) => {
                const type = $(e.target).data('type');
                const id = $(e.target).data('id');
                const tr = $(e.target).closest('tr');
                console.log($(tr).find('select, textarea, input').serializeArray());
                return;
                const item = products[type].find(v => v?.id == id);
                if (item) {
                    cart_item_index = -1; //inCart(item, type);
                    if (cart_item_index >= 0) {
                        cart[type][cart_item_index].quantity++;
                    } else {
                        const cart_item = cartItem(item);
                        cart[type].push(cart_item);
                    }
                    @this.updateCart(cart[type], type);
                    @this.updateTotal(total());
                }
            });

            $('body').on('change', '.date-input', function(e) {
                const relatedTo = $(this).data('related-to');
                const relatedRelation = $(this).data('related-relation') || '>=';
                const relatedAction = $(this).data('related-action') || 'limit';
                if (relatedTo) {
                    let minDate = new Date();
                    if (relatedRelation == '<=') {
                        minDate = e?.target?.value ?? new Date();
                        if (relatedAction == 'limit') {
                            $(relatedTo).flatpickr({
                                minDate: minDate
                            });
                        } else {
                            if (new Date(e?.target?.value).getTime() > new Date($(relatedTo).val())
                                .getTime()) {
                                $(relatedTo).val(null);
                            }
                        }
                    } else {
                        minDate = e?.target?.value ?? new Date();
                        if (relatedAction == 'limit') {
                            $(relatedTo).flatpickr({
                                maxDate: minDate
                            });
                        } else {
                            if (new Date(e?.target?.value).getTime() < new Date($(relatedTo).val())
                                .getTime()) {
                                $(relatedTo).val(null);
                            }
                        }
                    }
                }
            });

            $('body').on('change', '.booking-date', function(e) {
                console.log(e);
                let value = $(e.target).val();
                let key = $(e.target).attr('data-comp-key');
                let clickNum = parseInt($(e.target).data('click-num'));
                key = key.replace(`window.Livewire.find('`, '').replace(`')`, '');
                if (clickNum == 1) {
                    $(e.target).data('click-num', 0);
                    setTimeout(() => {
                        window.Livewire.find(key).save();
                    }, 500);
                } else {
                    $(e.target).data('click-num', ++clickNum);
                }
            });

            function prepareDateInput() {
                const elems = $('.date-input');
                for (let i = 0; i < elems.length; i++) {
                    const elem = elems[i];
                    const temp = $(elem).attr('data-disabled-dates');
                    const mode = $(elem).hasClass('date-range') ? 'range' : 'single';
                    const disabledDates = temp ? JSON.parse(temp).map(v => {
                        return {
                            from: v?.start_date,
                            to: v?.end_date
                        }
                    }) : [];
                    const value = $(elem).val();
                    $(elem).flatpickr({
                        minDate: new Date(),
                        disable: disabledDates,
                        mode: mode
                    });
                    if (mode == 'range' && value) {
                        $(elem).val(value);
                    }
                }
            }
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
                $(`.search-${itm}`).keyup((e) => {
                    const value = e.target.value.toLowerCase()
                    let items = products[itm].filter(v => {
                        const number = v?.number?.toLowerCase();
                        const title = v?.title?.toLowerCase();
                        if (number?.includes(value) ||
                            title?.includes(value)) {
                            return true;
                        }
                        return false;
                    });
                    @this.refresh(items, itm);
                });

                @this.updateCart(cart[itm], itm);
                @this.updateTotal(total());
            });
        });
    </script>
@endpush
