<div class="card card-flush h-lg-100">
    @if ($mode == 'add')
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <a href="{{ route('admin.users.index') }}" wire:navigate class="btn btn-primary-transparent ps-0">
                        <i class="fa-solid fa-arrow-left" style="font-size: 30px;"></i>
                    </a>
                    <h2>Add User</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form id="edit-user-form" class="form" wire:submit='createUser'>
                    <!--begin::Input group-->
                    <div class="mb-7">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $key => $error)
                                <div class="alert alert-danger" role="alert">{{ $error }}</div>
                            @endforeach
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success success-msg-alert" role="alert">{{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="row mb-7">
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mt-3 mb-2">
                                <span>Status</span>
                            </label>
                            <!--end::Label-->
                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                <input autocomplete="off" wire:model='status' class="form-check-input w-45px h-30px"
                                    type="checkbox" id="status">
                                <label class="form-check-label" for="status"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mt-3 mb-2">
                                <span>Verified User</span>
                            </label>
                            <!--end::Label-->
                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                <input autocomplete="off" wire:model='verified_at'
                                    class="form-check-input w-45px h-30px" type="checkbox" id="verified_at">
                                <label class="form-check-label" for="verified_at"></label>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <div class="fv-row mb-7 row">
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">First name</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Enter user first name"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" wire:model='first_name' />
                            <!--end::Input-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">Last name</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Enter user last name"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" wire:model='last_name' />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Email</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's email."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" class="form-control form-control-solid" wire:model="email" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>Password</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's password."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" class="form-control form-control-solid" wire:model="password" />
                                <p>empty => keep the old password</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>Phone Number</span> (Optional)
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's phone number."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" wire:model="oib" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>OIB</span> (Optional)
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's OIB."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" wire:model="oib" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span>Address</span> (Optional)
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter the user's address (optional)."></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" wire:model="address" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" href="{{ route('admin.users.index') }}" wire:navigate
                            class="btn btn-light me-3">Cancel</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary" wire:loading.attr='disabled'>
                            <span class="indicator-label" wire:loading.class='d-none'>Save</span>
                            <span class="indicator-progress" wire:loading wire:target='createUser'>Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Action buttons-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
    @elseif($mode == 'edit')
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <a href="{{ route('admin.users.index') }}" wire:navigate class="btn btn-primary-transparent ps-0">
                        <i class="fa-solid fa-arrow-left" style="font-size: 30px;"></i>
                    </a>
                    <h2>Edit User</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <div wire:loading wire:target='mount' class="text-primary">
                Loading...
            </div>
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form id="edit-user-form" class="form" wire:submit='updateUser'>
                    <!--begin::Input group-->
                    <div class="mb-7">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $key => $error)
                                <div class="alert alert-danger" role="alert">{{ $error }}</div>
                            @endforeach
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success success-msg-alert" role="alert">{{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="row mb-7">
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mt-3 mb-2">
                                <span>Status</span>
                            </label>
                            <!--end::Label-->
                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                <input autocomplete="off" wire:model='status' class="form-check-input w-45px h-30px"
                                    type="checkbox" id="status">
                                <label class="form-check-label" for="status"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mt-3 mb-2">
                                <span>Verified User</span>
                            </label>
                            <!--end::Label-->
                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                <input autocomplete="off" wire:model='verified_at'
                                    class="form-check-input w-45px h-30px" type="checkbox" id="verified_at">
                                <label class="form-check-label" for="verified_at"></label>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <div class="fv-row mb-7 row">
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">First name</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Enter user first name"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" wire:model='first_name' />
                            <!--end::Input-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">Last name</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Enter user last name"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" wire:model='last_name' />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Email</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's email."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" class="form-control form-control-solid" wire:model="email" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>Password</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's password."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" class="form-control form-control-solid"
                                    wire:model="password" />
                                <p>empty => keep the old password</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>Phone Number</span> (Optional)
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's phone number."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" wire:model="oib" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>OIB</span> (Optional)
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Enter the user's OIB."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" wire:model="oib" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span>Address</span> (Optional)
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter the user's address (optional)."></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" wire:model="address" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" href="{{ route('admin.users.index') }}" wire:navigate
                            class="btn btn-light me-3">Cancel</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary" wire:loading.attr='disabled'>
                            <span class="indicator-label" wire:loading.class='d-none'>Save</span>
                            <span class="indicator-progress" wire:loading wire:target='updateUser'>Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Action buttons-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
    @else
        {{ $mode }}
        <!--begin::Card body-->
        <div class="card-body p-0">
            <!--begin::Illustration-->
            <div class="text-center px-4 mt-10">
                <img class="mw-100 mh-200px" alt="" src="{{admin_assets('assets/media/illustrations/sketchy-1/5.png')}}" />
            </div>
            <!--end::Illustration-->
            <!--begin::Wrapper-->
            <div class="card-px text-center py-10 mb-10">
                <!--begin::Title-->
                <h2 class="fs-2x fw-bold mb-10">Users Management</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-semibold mb-10">
                    Please click on a user form the side list to edit.
                </p>
                <!--end::Description-->
                <!--begin::Action-->
                <button href="{{ route('admin.users.create') }}" wire:navigate class="btn btn-primary">Add New
                    User</button>
                <!--end::Action-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Card body-->
    @endif
</div>
@push('js')
    <script>
        $(function() {
            setTimeout(() => {
                $('.success-msg-alert').slideUp();
            }, 2500);
            @this.on('alert_remove', () => {
                setTimeout(() => {
                    $('.success-msg-alert').slideUp();
                }, 2500);
            });
        });
    </script>
@endpush
