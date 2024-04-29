<content-tag @if ($type == 'image') style="display: inline-block" @endif class="{{ $class }}">
    @if ($editMode)
        <button type="button" wire:click='edit' class="btn btn-sm btn-warning edit-content-btn skip-main">
            <i wire:loading.remove wire:target='edit' class="fa-regular fa-pen-to-square"></i>
            <i wire:loading wire:target='edit' class="fa-solid fa-spinner-third fa-spin"></i>
        </button>
    @endif
    @if ($html && !empty($html))
        {!! $htmlContent !!}
    @elseif ($type == 'text')
        {!! nl2br($value && $value != '' ? $value : $default) !!}
    @endif
</content-tag>
@push('js')
    <script>
        function refreshSliders() {
            try {
                let slides = @js($value ?? $default);
                let count = 2;
                if (Array.isArray(slides) && slides?.length > 0) {
                    if (slides?.length <= 2) {
                        count = slides.length;
                    } else {
                        count = 3;
                    }
                }
                var swiperImages = new Swiper(".swiper-images", {
                    slidesPerView: count,
                    speed: 1500,
                    spaceBetween: 20,
                    loop: true,
                    centeredSlides: true,
                    // gestures: 1,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: true,
                    },
                    navigation: {
                        nextEl: ".swiper-images .swiper-button-next",
                        prevEl: ".swiper-images .swiper-button-prev",
                    },
                });
                var swiperImages2 = new Swiper(".swiper-images-2", {
                    slidesPerView: count,
                    speed: 1500,
                    spaceBetween: 20,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".swiper-action-product .swiper-next",
                        prevEl: ".swiper-action-product .swiper-prev",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1.5,
                            spaceBetween: 20,
                        },
                        767: {
                            slidesPerView: 2.5,
                            spaceBetween: 30,
                        },
                        992: {
                            spaceBetween: 40,
                            slidesPerView: 3.5,
                        },
                    },
                });
                var swiperBrand = new Swiper(".swiper-brand", {
                    slidesPerView: 1,
                    speed: 1500,
                    spaceBetween: 20,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".swiper-action-product .swiper-next",
                        prevEl: ".swiper-action-product .swiper-prev",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        767: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                        992: {
                            spaceBetween: 40,
                            slidesPerView: 4,
                        },
                    },
                });
                swiperImages.wsRestart();
                swiperImages2.wsRestart();
                swiperBrand.wsRestart();
            } catch (error) {}
        }
        document.addEventListener('livewire:initialized', () => {
            @this.on('refresh-sliders', () => {
                setTimeout(() => {
                    refreshSliders();
                    setTimeout(() => {
                        refreshSliders();
                    }, 1000);
                }, 500);
            });
            if (@this.type == 'images') {
                @this.dispatch('refresh-sliders');
            }
        });
    </script>
@endpush
