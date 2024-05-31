@extends('layout.adminLayout')
@php
    $page_name = 'realestates';
    $all = request()->has('all') ? '&all' : '';
    $allQ = request()->has('all') ? '?all' : '';
@endphp
@section('pageTitle')
    {{ $client->name ?? '' }} {{ ucwords(__('siderbar.' . $page_name)) }}
@endsection
@section('title')
    {{ ucwords(__('siderbar.' . $page_name)) }}
@endsection
@section('prevTitle')
    <a href="{{route('admin.clients.index').$allQ}}" class="text-muted text-hover-primary">{{ ucwords(__('siderbar.clients')) }}</a>
@endsection
@section('filter')
    <!--begin::Actions-->
    <div class="d-flex align-items-center gap-2 gap-lg-3" style="justify-content: flex-end;">
        <!--begin::Top Buttons-->
            <div class="m-0">
                <!--begin::Add user-->
                <a href="{{ route('admin.' . $page_name . '.create') }}?client={{request('client').$all}}"
                    class="btn btn-sm btn-primary">{{ __('common.create_new') }}</a>
                <!--end::Add user-->
            </div>
        <!--end::Top Buttons-->
    </div>
    <!--end::Actions-->
@endsection
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
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
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
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
            </div>
            {{-- <table id="" class="table table-row-bordered table-striped"> --}}
            @csrf
            <table id="kt_table_accounts" class="table table-row-bordered table-striped">
                <thead>
                    <tr>
                        <th> {{ ucwords(__('common.number')) }}</th>
                        <th> {{ ucwords(__('common.opu_ip')) }}</th>
                        <th> {{ ucwords(__('common.address')) }}</th>
                        <th> {{ ucwords(__('common.meter_price')) }}</th>
                        <th> {{ ucwords(__('common.area')) }}</th>
                        @if (isSuperAdmin())
                            <th> {{ ucwords(__('common.initial_cost_total')) }}</th>
                            <th> {{ ucwords(__('common.construction_total')) }}</th>
                        @else
                            <th> {{ ucwords(__('common.contractor_total')) }}</th>
                        @endif
                        <th> {{ ucwords(__('common.status')) }}</th>
                        <th> {{ ucwords(__('common.created')) }}</th>
                        <th> {{ ucwords(__('common.action')) }}</th>
                    </tr>
                </thead>
                <tbody class="sortable-row">
                    <?php $x = 1; ?>
                    @forelse($items as $item)
                        <tr class="odd gradeX" id="tr-{{ $item->id }}">
                            <td>
                                {{ $x++ }}
                            </td>
                            <td>
                                <a href="{{ route('admin.' . $page_name . '.edit', [$item->id]).$allQ}}">{{ $item->opu_ip }}</a>
                            </td>
                            <td>{{ $item->address ?? '-' }}</td>
                            <td>{{ $item->meter_price }}</td>
                            <td>{{ $item->area }}</td>
                            @if (isSuperAdmin())
                                <td>{{ $item->initial_cost_total }}</td>
                                <td>{{ $item->construction_total }}</td>
                            @else
                                <td>{{ $item->contractor_total }}</td>
                            @endif
                            <td class="center">{!! $item->status == 1
                                ? '<span style="color: green;">Active</span>'
                                : '<span style="color: red;">InActive</span>' !!}</td>
                            <td class="center">{{ $item->created_at }}</td>
                            <td>

                                <!--begin::Menu-->
                                <div class="" style="">
                                    <!--begin::Menu item-->
                                    <a href="{{ route('admin.' . $page_name . '.edit', [$item->id]).$allQ}}"
                                        class="menu-link px-3 btn btn-sm btn-info mt-1">{{ __('common.edit') }}</a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <a onclick="delete_row('{{ $item->id }}','{{ $item->id }}',event)"
                                        href="#" class="menu-link px-3 delete_row btn btn-sm btn-danger mt-1"
                                        data-kt-accounts-table-filter="delete_row">{{ __('common.delete') }}</a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <a href="{{ route('admin.products.index') }}?realstate={{ $item->id.$all }}"
                                        class="menu-link px-3 btn btn-sm btn-dark mt-1">{{ __('common.products') }}</a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <a href="{{ route('admin.realestate-products.index') }}?realstate={{ $item->id.$all }}"
                                        class="menu-link px-3 btn btn-sm btn-info mt-1">{{ __('common.payments') }}</a>
                                    <!--end::Menu item-->
                                    <br>
                                    <!--begin::Menu item-->
                                    <a href="{{ route('admin.contractor-payments.index') }}?realstate={{ $item->id.$all }}"
                                        class="menu-link px-3 btn btn-sm btn-warning mt-1">{{ __('common.contractor_payments') }}</a>
                                    <!--end::Menu item-->
                                    @if (isSuperAdmin())
                                        <!--begin::Menu item-->
                                        <a href="{{ route('admin.initial-payments.index') }}?realstate={{ $item->id.$all }}"
                                            class="menu-link px-3 btn btn-sm btn-secondary mt-1">{{ __('common.initial_payments') }}</a>
                                        <!--end::Menu item-->
                                        <br>
                                        <!--begin::Menu item-->
                                        <a href="{{ route('admin.construction-payments.index') }}?realstate={{ $item->id.$all }}"
                                            class="menu-link px-3 btn btn-sm btn-primary mt-1">{{ __('common.construction_payments') }}</a>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <a href="{{ route('admin.extra-payments.index') }}?realstate={{ $item->id.$all }}"
                                            class="menu-link px-3 btn btn-sm btn-dark mt-1">{{ __('common.extra_payments') }}</a>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <a href="{{ route('admin.'.$page_name.'.finished', $item->id) }}?realstate={{ $item->id.$all }}" title="{{ $item->finished_at ? 'it will disappear from bills manager account' : 'it will appear to bills manager account'}}"
                                            class="menu-link px-3 btn btn-sm btn-{{$item->finished_at ? 'danger' : 'success'}} mt-1">{{__($item->finished_at ? 'common.unfinished_construction' : 'common.finished_construction') }}</a>
                                        <!--end::Menu item-->
                                    @endif
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{-- <div style="margin-bottom:20px">
                {{ $items->links('pagination::bootstrap-5', ['locale' => getLocale()]) }}
            </div> --}}
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
    <script>
        $(function() {
            $(".sortable-row").sortable({
                connectWith: ".sortable-row",
                handle: ".row-header",
                placeholder: "row-placeholder"
            });
            $('.submit-sort').click(function() {
                $('form.save-sort-form').submit();
            });
        });
    </script>
@endsection
