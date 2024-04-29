@extends('layout.adminLayout')
@php
    $page_name = 'realstate-products';
    $page_title = 'payments';
@endphp
@section('pageTitle')
    {{ $realstate->opu_ip ?? '' }} {{ ucwords(__('siderbar.' . $page_title)) }}
@endsection
@section('title')
    {{ ucwords(__('siderbar.' . $page_title)) }} ({{ $realstate->opu_ip ?? '' }}) - {{ $realstate->client->name }}
@endsection
@section('prevTitle')
    <a href="{{ route('admin.realstates.index') }}?client={{ $realstate->client_id }}"
        class="text-muted text-hover-primary">{{ ucwords(__('common.realstate')) }} {{ $realstate->opu_ip ?? '' }}</a>
@endsection
@if (isAdmin())
    @section('filter')
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3" style="justify-content: flex-end;">
            <!--begin::Top Buttons-->
            <div class="m-0">
                <!--begin::Add user-->
                <a href="{{ route('admin.' . $page_name . '.payments-print', $realstate->id) }}?realstate={{ request('realstate') }}{{ request()->has('from_date') ? '&from_date='.request('from_date') : '' }}{{ request()->has('to_date') ? '&to_date='.request('to_date') : '' }}"
                    class="btn btn-sm btn-success" target="_blank">{{ __('common.print-report') }}</a>
                <!--end::Add user-->
            </div>
            <div class="m-0">
                <!--begin::Add user-->
                <a href="{{ route('admin.' . $page_name . '.create') }}?realstate={{ request('realstate') }}"
                    class="btn btn-sm btn-primary">{{ __('common.create_new') }}</a>
                <!--end::Add user-->
            </div>
            <!--end::Top Buttons-->
        </div>
        <!--end::Actions-->
    @endsection
@endif
@push('style')
    <style>
        .search_div {
            padding: 0px !important;
        }

        tr.ui-sortable-helper {
            display: inline-block !important;
            min-width: 1100px !important;
            max-width: calc(100vw - 290px);
            background: var(--kt-border-color) !important;
        }

        .row-placeholder {
            background: #c3b823 !important;
        }
    </style>
@endpush
@section('content')
    <div style="display: block" id="loading"><img src="{{ asset('images/loading.gif') }}" alt="Loading" /></div>
    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="card-header border-0 pt-6 search_div">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">{{ __('common.search') }}:</label>
                        <!--end::Label-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input autocomplete="off" type="text" data-kt-accounts-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14"
                                placeholder="{{ __('common.search') }}" />
                        </div>
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Form-->
                    <form autocomplete="off" method="get" id="filter-form"
                        action="{{ route("admin.$page_name.index") }}">
                        <input type="hidden" name="realstate" value="{{request('realstate')}}">
                        <div class="d-flex align-items-center position-relative">
                            <!--begin::Input group-->
                            <div class="me-5">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">{{ __('common.from_date') }}:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <input autocomplete="off" class="form-control form-control-solid"
                                        placeholder="{{ __('common.pick_a_date') }}" autocomplete="off"
                                        type="date"
                                        value="{{ $from_date }}" name="from_date"
                                        id="from_date" />
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="me-5">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">{{ __('common.to_date') }}:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <input autocomplete="off" class="pick_date- form-control form-control-solid"
                                        placeholder="{{ __('common.pick_a_date') }}" autocomplete="off"
                                        type="date"
                                        value="{{ $to_date }}" name="to_date"
                                        id="to_date" />
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div>
                                <label class="form-label fw-semibold">{{ __('common.actions') }}:</label>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route("admin.$page_name.index") }}?realstate={{request('realstate')}}&reset=true" type="reset"
                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true">{{ __('common.reset') }}</a>
                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('common.apply') }}</button>
                                </div>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
        <table id="kt_table_accounts" class="table table-row-bordered table-striped">
            <thead>
                <tr>
                    <th> {{ ucwords(__('common.number')) }}</th>
                    <th> {{ ucwords(__('common.product')) }}</th>
                    <th> {{ ucwords(__('common.amount')) }}</th>
                    <th> {{ ucwords(__('common.paid_at')) }}</th>
                    <th> {{ ucwords(__('common.created')) }}</th>
                    <th> {{ ucwords(__('common.action')) }}</th>
                </tr>
            </thead>
            <tbody>
                <?php $x = 1; ?>
                @forelse($items as $item)
                    <tr class="odd gradeX" id="tr-{{ $item->id }}">
                        <td>
                            {{ $x++ }}
                        </td>
                        <td>
                            {{ $item->product->name }}
                        </td>
                        <td>
                            {{ decorate_numbers($item->amount) }}
                        </td>
                        <td>
                            {{ $item->paid_at ? $item->paid_at->format('Y-m-d') : '-' }}
                        </td>
                        <td>
                            {{ $item->created_at ? $item->created_at->format('Y-m-d H:m:s') : '-' }}
                        </td>
                        <td>

                            <!--begin::Menu-->
                            <div class="" style="">
                                <!--begin::Menu item-->
                                <a href="{{ route('admin.' . $page_name . '.edit', [$item->id]) }}"
                                    class="menu-link px-3 btn btn-sm btn-info">{{ __('common.edit') }}</a>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <a onclick="delete_row('{{ $item->id }}','{{ $item->id }}',event)" href="#"
                                    class="menu-link px-3 delete_row btn btn-sm btn-danger"
                                    data-kt-accounts-table-filter="delete_row">{{ __('common.delete') }}</a>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $("#myformImport").submit(function(e) {
            $('#loading').show();
        });

        $(window).on('load', function() {
            $('#loading').hide();
        });

        function delete_adv(id, iss_id, e) {
            e.preventDefault();
            var url = '{{ route('admin.' . $page_name . '.destroy', ['']) }}/' + id;
            var csrf_token = '{{ csrf_token() }}';
            $.ajax({
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                url: url,
                data: {
                    _method: 'get'
                },
                success: function(response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                        //swal("حذفت!", {icon: "success"});
                    } else {
                        // swal('Error', {icon: "error"});
                    }
                },
                error: function(e) {
                    // swal('exception', {icon: "error"});
                }
            });
        }

        function delete_row(id, iss_id, e) {
            Swal.fire({
                title: "{{ __('common.approving_msg') }}",
                text: "{{ __('common.not_reverted_msg') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{ __('common.yes_delete') }}",
                cancelButtonText: "{{ __('common.cancel') }}",
                cancelButtonText: "{{ __('common.cancel') }}",
                confirmButtonColor: '#d9214e'
            }).then(function(result) {
                if (result.value) {
                    delete_adv(id, iss_id, e);
                    Swal.fire(
                        "{{ __('common.deleted') }}",
                        "{{ __('common.deleted_msg') }}",
                        "success"
                    )
                }
            });
        }
    </script>
    <script>
        function showConfirmationDialog(e) {
            e.preventDefault();
            Swal.fire({
                title: "{{ __('common.approving_msg') }}",
                text: "{{ __('common.not_reverted_msg') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{ __('common.yes_delete') }}",
                cancelButtonText: "{{ __('common.cancel') }}",
                cancelButtonText: "{{ __('common.cancel') }}",
                confirmButtonColor: '#d9214e'
            }).then(function(result) {
                if (result.value) {
                    // If the user confirms, submit the form
                    e.target.submit();
                }
            });
        }

        // Attach the showConfirmationDialog function to the form's submit event
        document.getElementById('delete_form').addEventListener('submit', showConfirmationDialog);
    </script>
@endsection
