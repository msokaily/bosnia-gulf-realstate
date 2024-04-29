<div class="cart-content">
    <div class="cart-header">
        <div class="d-flex align-items-center justify-content-between px-3 py-3">
            <h3 class="font-news-bold">Your Cart</h3>
            <button class="btn p-1 text-muted toggle-cart border-0"><i class="fa-regular fa-xmark fa-lg"></i></button>
        </div>
    </div>
    <div class="card-body">
        @forelse ($all_cart as $index => $one)
            @livewire('accommodation-cart-item', ['cartItem' => $one, 'product_type' => 'accommodations', 'price_field' => $price_field, 'index' => $index, 'cart_booked_days' => $cart_booked_days], key('accommodation_cart_item_' . $one->entity_id . '_' . $index))
        @empty
            <h3 class="text-center v-c">Empty Cart!</h3>
        @endforelse
    </div>
    <div class="cart-footer p-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4>Total</h4>
            <h3 class="font-news-bold">{{ $total }} {{ settings('currency') }}</h3>
        </div>
        <div class="d-flex">
            <div class="col-6 px-1"><a class="btn w-100 px-1 btn-outline-black" href="{{ route('cart') }}">View
                    Cart</a></div>
            @if ($all_cart && count($all_cart) > 0)
                <div class="col-6 px-1"><a class="btn w-100 px-1 btn-black" href="{{ route('checkout') }}">Proceed to
                        Checkout</a></div>
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
                    cartItem = cartItem[0];
                }
                cart_item_index = -1;
                if (cart_item_index >= 0) {
                    cart[cartItem.type][cart_item_index].quantity++;
                } else {
                    cart[cartItem.type].push(cartItem);
                }
                @this.updateCart(cart[cartItem.type], cartItem.type);
                @this.updateTotal(total());
                localStorage.setItem(cartItem.type + '_cart' + updateExtra, JSON.stringify(cart[cartItem.type]));
            });
            @this.on('updateCartItem', (data) => {
                console.log('update CartItem: ', data);
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
                localStorage.setItem(cartItem.type + '_cart' + updateExtra, JSON.stringify(cart[cartItem.type]));
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
                let isValidateOnly = $(e.target).data('validate-only');
                let clickNum = parseInt($(e.target).data('click-num'));
                key = key.replace(`window.Livewire.find('`, '').replace(`')`, '');
                if (clickNum == 1) {
                    $(e.target).data('click-num', 0);
                    setTimeout(() => {
                        if (isValidateOnly) {
                            window.Livewire.find(key).validateInputs();
                        } else {
                            window.Livewire.find(key).save();
                        }
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
