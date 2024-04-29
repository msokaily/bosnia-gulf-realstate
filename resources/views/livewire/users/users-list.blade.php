<div class="card card-flush" id="kt_contacts_list">
    <!--begin::Card header-->
    <div class="card-header pt-7" id="kt_contacts_list_header">
        <!--begin::Form-->
        <div class="d-flex align-items-center position-relative w-100 m-0" autocomplete="off">
            <!--begin::Icon-->
            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
            <span wire:loading.remove wire:target='searchUsers'
                class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                        transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                    <path
                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            <!--end::Icon-->
            <span wire:loading wire:target="searchUsers" class="spinner-border text-primary position-absolute"
                style="width: 20px; height: 20px; left: 12px;" role="status"></span>
            <!--begin::Input-->
            <input type="text" wire:model.live.debounce.500ms="search"
                class="form-control form-control-solid ps-13" name="search" value=""
                placeholder="Search users" />
            <!--end::Input-->
        </div>
        <!--end::Form-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5" id="kt_contacts_list_body">
        @if (count($bulk_users) > 0)
            <div class="pb-4 border-bottom">
                <div class="fw-bold mb-3">
                    <span class="me-2">{{ count($bulk_users) }}</span>Selected
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" wire:loading.attr='disabled' wire:target='delete_selected'
                        class="btn btn-danger btn-sm delete-btn">
                        <span class="indicator-label" wire:loading.class='d-none' wire:target='delete_selected'>Delete
                            Selected</span>
                        <span class="indicator-progress" wire:loading wire:target='delete_selected'>Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <button type="button" wire:loading.attr='disabled' wire:target='verify_selected'
                        class="btn btn-success btn-sm verify-btn">
                        <span class="indicator-label" wire:loading.class='d-none' wire:target='verify_selected'>Verify
                            Selected</span>
                        <span class="indicator-progress" wire:loading wire:target='verify_selected'>Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        @endif
        @if ($users && count($users) > 0)
            <div class="pb-4 pt-4 border-bottom d-flex justify-content-between">
                <div class="fw-bold">Select</div>
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input form-check-all" wire:model='isChecked'
                        wire:change='select_bulk($event.target.checked)' type="checkbox" data-kt-check="true" />
                </div>
            </div>
        @endif
        <!--begin::List-->
        <div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
            data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header"
            data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body"
            data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
            @foreach ($users as $index => $item)
                <!--begin::User-->
                <div class="d-flex flex-stack py-4 user-item">
                    <!--begin::Details-->
                    <div class="d-flex align-items-center">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-40px symbol-circle">
                            @if ($item->image_url)
                                <img alt="{{ $item->letter }}" src="{{ $item->image_url->url ?? '' }}" />
                            @else
                                <span
                                    class="symbol-label bg-light-primary text-primary fs-6 fw-bolder">{{ $item->letter }}</span>
                            @endif
                            <div data-bs-toggle="tooltip" title="Active User"
                                class="{{ $item->status === 'Active' ? '' : 'd-none' }} symbol-badge bg-success start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2">
                            </div>
                            <div data-bs-toggle="tooltip" title="InActive User"
                                class="{{ $item->status === 'InActive' ? '' : 'd-none' }} symbol-badge bg-danger start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2">
                            </div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Details-->
                        <div class="ms-4">
                            {{-- <a wire:click='openUser({{$item->id}})' class="fs-6 fw-bold text-gray-900 text-hover-primary mb-2 cursor-pointer">{{$item->full_name}}</a> --}}
                            <a href="{{ route('admin.users.edit', $item->id) }}" wire:navigate
                                class="fs-6 fw-bold text-gray-900 text-hover-primary mb-2 cursor-pointer no-loading">
                                {{ $item->full_name }}
                                @if ($item->verified_at)
                                    <i class="fa-solid fa-square-check text-success ms-2" data-bs-toggle="tooltip"
                                        title="Verified User"></i>
                                @endif
                            </a>
                            <div class="fw-semibold fs-7 text-muted">{{ $item->email }}</div>
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Details-->
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" wire:model='bulk_users.{{ $item->id }}'
                            value="{{ $item->id }}"
                            wire:change='select_user($event.target.value, $event.target.checked)' type="checkbox" />
                    </div>
                </div>
                <!--end::User-->
                <!--begin::Separator-->
                <div class="separator separator-dashed d-none"></div>
                <!--end::Separator-->
            @endforeach
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
        <!--end::List-->
    </div>
    <!--end::Card body-->
</div>
@push('js')
    <script>
        $(function() {
            $('body').on('click', '.verify-btn', function() {
                Swal.fire({
                    title: "{{ __('common.approving_msg') }}",
                    text: "This operation is reversable.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, verify",
                    cancelButtonText: "{{ __('common.cancel') }}",
                    confirmButtonColor: '#50cd89'
                }).then(function(result) {
                    if (result.value) {
                        @this.verify_selected();
                    }
                });
            });
            $('body').on('click', '.delete-btn', function() {
                Swal.fire({
                    title: "{{ __('common.approving_msg') }}",
                    text: "{{ __('common.not_reverted_msg') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "{{ __('common.yes_delete') }}",
                    cancelButtonText: "{{ __('common.cancel') }}",
                    confirmButtonColor: '#d9214e'
                }).then(function(result) {
                    if (result.value) {
                        @this.delete_selected();
                    }
                });
            });
        });
    </script>
@endpush
