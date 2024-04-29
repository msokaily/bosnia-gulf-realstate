<a class="nav-link text-black px-3 @if ($routeName != 'cart') toggle-cart @endif" @if ($routeName == 'cart') href="#productTitleDiv" @endif style="font-size: 20px;">
    <i class="fa{{ $cartCount > 0 ? '' : '-regular' }} fa-bag-shopping"></i>
    @if ($cartCount > 0)
        <span class="count-notification" style="margin-top: -10px; margin-right: -9px; background: orange;">
            {{$cartCount}}
        </span>
    @endif
</a>

@push('js')
    <script>
        function calcCount() {
            const count = cart.accommodations.length + cart.services.length + cart.events.length;
            @this.setValue('cartCount', count);
        }
        document.addEventListener('livewire:initialized', () => {
            calcCount();
            @this.on('refresh_cart', () => {
                calcCount();
            });
        });
    </script>
@endpush
