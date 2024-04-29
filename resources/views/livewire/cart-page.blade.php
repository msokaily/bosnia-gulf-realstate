<div class="cart-content">
    <div class="row mb-4">
        <div class="col-12">
            <div class="border mb-3">
                <div class="p-3 p-lg-4">
                    <div class="list-product">
                        @if ($accommodations_cart && count($accommodations_cart) > 0)
                            <h3 class="mb-3">Accommodations :</h3>
                        @endif
                        @forelse ($accommodations_cart as $index => $one)
                            @livewire('accommodation-cart-item', ['widePage' => true, 'cartItem' => $one, 'product_type' => 'accommodations', 'price_field' => $price_field, 'index' => $index, 'cart_booked_days' => $cart_booked_days], key('accommodation_cart_item_' . $one->entity_id . '_' . $index))
                        @empty
                            <h3 class="text-center">Empty Cart!</h3>
                        @endforelse
                    </div>
                    {{-- <div class="list-services">
                        <h3 class="mb-3">Services :</h3>
                        <div class="d-lg-flex justify-content-between">
                            <div class="col-lg-5 mb-3 mb-lg-0">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <div class="image-cart me-3"><img src="assets/images/product/img-01.png"
                                                alt="" /></div>
                                        <div class="d-flex flex-column">
                                            <h3 class="font-news-bold mb-2">Body Treatments</h3>
                                            <h5 class="font-news-bold mb-4">Price: 100$</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row gx-lg-2">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-icon icon-left">
                                                <input class="form-control datetimepicker_1" type="text"
                                                    placeholder="Check In" />
                                                <div class="icon"> <i class="fa-light fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-icon icon-left">
                                                <input class="form-control datetimeclock" type="text"
                                                    placeholder="Check Out" />
                                                <div class="icon"> <i class="fa-light fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="bg-gray p-3 d-flex justify-content-between align-items-center">
                    <h4 class="font-news-bold">Total</h4>
                    <h3> {{ $total }} {{ settings('currency') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-5 ms-auto">
            <h2 class="section-title font-itc-bold title-small mb-3">Cart Totals</h2>
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <h4 class="text-muted">Subtotal</h4>
                <h3>{{ $total }} {{ settings('currency') }}</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <h4 class="text-muted">Extra Services</h4>
                <h3 class="text-muted">{{ 0 }} {{ settings('currency') }}</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center pb-3 mb-3">
                <h4 class="font-news-bold">Total</h4>
                <h3> {{ $total }} {{ settings('currency') }}</h3>
            </div>
            @if ($all_cart && count($all_cart) > 0)
                <div class="text-end"> <a class="btn btn-black" href="{{ route('checkout') }}">Proceed to Checkout </a>
                </div>
            @endif
        </div>
    </div>
</div>

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

            @this.on('refresh_cart', () => {
                refreshCart();
                ['accommodations', 'services', 'events'].forEach(itm => {
                    @this.updateCart(cart[itm], itm);
                    @this.updateTotal(total());
                });
            });
        });
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
                    @this.submitRemove();
                    localStorage.setItem(type + '_cart' + updateExtra, JSON.stringify(cart[type]));
                }
            });
            $("body").on('change', ".customer-type-select", (e) => {
                @this.customerTypeChanged(e.target.value);
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
                @this.updateTotal(total());
            });
        });
    </script>
@endpush
