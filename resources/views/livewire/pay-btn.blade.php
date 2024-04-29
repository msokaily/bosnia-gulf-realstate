<button class="btn btn-black w-100" type="button" wire:click='submit(cart)' wire:target='submit' wire:loading.attr='disabled'>
    <span wire:loading wire:target='submit' >Sending..</span>
    <span wire:target='submit' wire:loading.class='d-none'>
        Pay {{ $total }} {{ settings('currency') }}
    </span>
</button>
@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('refresh_total', () => {
                @this.setTotal(total());
            });
            @this.on('clear_cart', () => {
                let extraCartName = '_client';
                localStorage.removeItem('accommodations_cart'+extraCartName);
                localStorage.removeItem('services_cart'+extraCartName);
                localStorage.removeItem('events_cart'+extraCartName);
                refreshCart();
            });
            @this.setTotal(total());
        });
    </script>
@endpush