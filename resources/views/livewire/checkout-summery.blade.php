<div class="col-lg-6 p-lg-5 py-3 py-lg-5 content-order-summary">
    <h2 class="font-itc-bold mb-2 mb-lg-4 section-title title-small">Order Summary</h2>
    <div class="mb-5">
        @forelse ($all_cart as $index => $one)
            <div class="widget_item-booking p-4 mb-3 border-bottom">
                <div class="d-flex">
                    <div class="d-flex justify-content-between flex-column">
                        <a href="{{ route($one->item->type, $one->item->slug) }}"
                            class="widget_item-image col-auto me-4 image-small">
                            <img src="{{ $one->item->image }}" alt="{{ $one->item->title }}" />
                        </a>
                        <div>
                            <h4>
                                Total: <b>{{ $one->total }}</b> {{ settings('currency') }}
                            </h4>
                        </div>
                    </div>
                    <div class="widget_item-content col">
                        <div class="mb-2">
                            <h5 class="font-news-bold mb-2">{{ $one->item->title }}</h5>
                            <h4 class="font-news-bold">{{ $one->item->price }} {{ settings('currency') }}</h4>
                        </div>
                        <div class="mb-3">
                            <h5>{{ $one->start_date }} <i class="fa-solid fa-arrow-right text-primary"></i>
                                {{ $one->end_date }}</h5>
                            <h5>{{ $one->adults }} Adults</h5>
                            <h5>{{ $one->kids }} Children</h5>
                        </div>
                        <h5 class="font-news-bold">Options:</h5>
                        @foreach ($one->options as $opt)
                            <div class="d-flex align-items-center justify-content-between option-div">
                                <h6 class="col">{{ $opt->option->title }}</h6>
                                <h6 class="col font-news-bold">{{ $opt->price }} {{ settings('currency') }}
                                    @if (isset($opt->duration) && $opt->duration)
                                        / {{ $opt->duration->duration->value }}
                                        {{ $opt->duration->duration->duration_type }}
                                    @else / night
                                    @endif
                                </h6>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="p-4">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
            <h4 class="text-muted">Subtotal</h4>
            <h3>{{ $total }} {{ settings('currency') }}</h3>
        </div>
        <div class="border-bottom pb-2 mb-2">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="text-muted">Extra Services</h5>
                <h5 class="text-muted">00.00 {{ settings('currency') }}</h5>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center pb-3 mb-3">
            <h4 class="font-news-bold">Total</h4>
            <h3> {{ $total }} {{ settings('currency') }}</h3>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('refresh_cart', () => {
                refreshCart();
                ['accommodations', 'services', 'events'].forEach(itm => {
                    @this.updateCart(cart[itm], itm);
                    @this.updateTotal(total());
                });
            });
        });
        $(function() {
            ['accommodations', 'services', 'events'].forEach(itm => {
                @this.updateCart(cart[itm], itm);
                @this.updateTotal(total());
            });
        });
    </script>
@endpush
