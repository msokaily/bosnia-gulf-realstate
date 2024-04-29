@extends('layout.adminLayout')
@php
    $page_name = 'users';
@endphp
@section('pageTitle') 
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
@section('title') 
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
@if(isAdmin())
    @section('filter') 
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3" style="justify-content: flex-end;">
            <!--begin::{{__('common.filter')}} menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#" id="filter_btn" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->{{__('common.filter')}}</a>
                <!--end::Menu toggle-->
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_633f0992a4adf">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bold">{{__('common.filter_options')}}</option></div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->
                    <!--begin::Form-->
                    <form  autocomplete="off" method="get" id="myform" action="{{url(getLocale().'/admin/users')}}">
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">{{__('common.company')}}:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select name="company_id" class="basic-hide-search form-select form-select-solid" data-kt-select2="true" data-placeholder="{{__('common.select_option')}}" data-dropdown-parent="#kt_menu_633f0992a4adf" data-allow-clear="true">
                                        <option value="All">{{__('common.all')}}</option>
                                        @foreach([] as $one)
                                            @php $selected = ''; @endphp
                                            @if ($one->id == request('company_id'))
                                                @php $selected = 'selected'; @endphp
                                            @endif
                                            <option value="{{$one->id}}" {{$selected}}> {{$one->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="{{url(getLocale().'/admin/users')}}" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">{{__('common.reset')}}</a>
                                <button type="submit" class="btn btn-sm btn-primary" >{{__('common.apply')}}</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::{{__('common.filter')}} menu-->
            <!--begin::Import menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                        <a href="#" id="import_btn" class="btn btn-sm btn-warning" data-kt-menu-trigger="click" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">{{__('common.import_users')}}</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_633f0992a4adff">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">{{__('common.import_users')}}</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <form  autocomplete="off" enctype="multipart/form-data" method="post" id="myformImport" action="{{url(getLocale().'/admin/users_import')}}">
                                @csrf
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">{{__('common.company')}}:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <select required name="company_id" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="{{__('common.select_option')}}" data-dropdown-parent="#kt_menu_633f0992a4adff" data-allow-clear="true">
                                                <option value="">{{__('common.select_option')}}</option>
                                                @foreach([] as $one)
                                                    <option value="{{$one->id}}"> {{$one->first_name}}</option>
                                                    {{-- <option value="{{$one->id}}"> {{$one->first_name}} - {{$one->focal_points_listed[0]->phone}}</option> --}}
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">{{__('common.select_file')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <input autocomplete="off" required type="file" class="form-control" accept=".xls,.csv,.xlsx" name="file">
                                            <a href="{{asset('public/Users.xlsx')}}?nocache={{ time() }}">{{__('common.download_template')}}</a>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">{{__('common.ignore_duplicates')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                <input autocomplete="off" class="form-check-input w-45px h-30px" type="checkbox" id="ignore_duplicates" name="ignore_duplicates">
                                                <label class="form-check-label" for="ignore_duplicates"></label>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary" >{{__('common.submit')}}</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    <!--end::Menu 1-->
                    <!--begin::Add user-->
                    <a href="{{ route('admin.' . $page_name . '.create') }}" class="btn btn-sm btn-primary">{{__("common.create_new")}}</a>
                    <!--end::Add user-->
                </div>
            <!--end::Import menu-->
            <!--begin::{{__('common.export')}} menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                    <a href="#" id="export_btn" class="btn btn-sm btn-info" data-kt-menu-trigger="click" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">{{__("common.export_users")}}</a>
                    <!--end::Menu toggle-->
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_633f0992a4adff555">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">{{__("common.export_users")}}</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <form  autocomplete="off" enctype="multipart/form-data" method="get" id="myform" action="{{url(getLocale().'/admin/users_export')}}">
                            @csrf
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">{{__('common.company')}}:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select required name="company_id" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="{{__('common.select_option')}}" data-dropdown-parent="#kt_menu_633f0992a4adff555" data-allow-clear="true">
                                            <option value="">{{__('common.select_option')}}</option>
                                            @foreach([] as $one)
                                                @if(count($one->users) > 0 AND $one->can_activity == 1)
                                                    <option value="{{$one->id}}"> {{$one->first_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm btn-primary" >{{__('common.submit')}}</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                <!--end::Menu 1-->
            </div>
            <!--end::{{__('common.export')}} menu-->
        </div>
        <!--end::Actions-->
    @endsection
@endif
@if(isCompany())
    @section('filter') 
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3" style="justify-content: flex-end;">
            <!--begin::Import menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                        <a href="#" id="import_btn" class="btn btn-sm btn-warning" data-kt-menu-trigger="click" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">{{__('common.import_users')}}</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_633f0992a4adf">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">{{__('common.import_users')}}</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <form  autocomplete="off" enctype="multipart/form-data" method="post" id="myformImport" action="{{url(getLocale().'/admin/users_import')}}">
                                @csrf
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">{{__('common.select_file')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <input autocomplete="off" required type="file" class="form-control" accept=".xls,.csv,.xlsx" name="file">
                                            <a href="{{asset('public/Users.xlsx')}}?nocache={{ time() }}">{{__('common.download_template')}}</a>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">{{__('common.ignore_duplicates')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                <input autocomplete="off" class="form-check-input w-45px h-30px" type="checkbox" id="ignore_duplicates" name="ignore_duplicates">
                                                <label class="form-check-label" for="ignore_duplicates"></label>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary" >{{__('common.submit')}}</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    <!--end::Menu 1-->
                    <!--begin::Add user-->
                    <a href="{{ route('admin.' . $page_name . '.create') }}" class="btn btn-sm btn-primary">{{__("common.create_new")}}</a>
                    @if(count(Auth::user()->users) > 0 AND Auth::user()->can_activity == 1)
                        <a href="{{url(getLocale().'/admin/users_export')}}" class="btn btn-sm btn-info">{{__("common.export_users")}}</a>
                    @endif
                    <a href="{{url(getLocale().'/admin/users_export_cards')}}" class="btn btn-sm btn-dark">{{__("common.export_users_cards")}}</a>
                    <!--end::Add user-->
                </div>
            <!--end::Import menu-->
            <!--begin::Import menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#" id="delete_btn" class="btn btn-sm btn-danger" data-kt-menu-trigger="click" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">{{__('common.delete_users')}}</a>
                <!--end::Menu toggle-->
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_633f0992a4adf234sdf">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bold">{{__('common.delete_users')}}</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->
                    <!--begin::Form-->
                    <form  autocomplete="off" enctype="multipart/form-data" method="post" id="delete_form" action="{{url(getLocale().'/admin/delete_users')}}">
                        @csrf
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">{{__('common.category')}}:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select required name="category" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="{{__('common.select_option')}}" data-dropdown-parent="#kt_menu_633f0992a4adf234sdf" data-allow-clear="true">
                                        <option value="">{{__('common.select_option')}}</option>
                                        @foreach([] as $one)
                                            <option value="{{$one}}"> {{$one}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-danger" >{{__('common.delete')}}</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Menu 1-->
        </div>
        <!--end::Actions-->
    @endsection
@endif
@section('css')
<style>
.search_div{
    padding: 0px !important;
}
</style>
@endsection
@section('content')
    <div style="display: block" id="loading"><img src="{{asset('images/loading.gif')}}" alt="Loading" /></div>
    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="card-header border-0 pt-6 search_div">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input autocomplete="off" type="text" data-kt-accounts-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__("common.search")}}" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                {{-- <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-accounts-table-toolbar="base">
                        <!--begin::Add user-->
                        <a href="{{ route('admin.' . $page_name . '.create') }}" class="btn btn-primary">{{__("common.create_new")}}</a>
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-accounts-table-toolbar="selected">
                        <div class="fw-bold me-5">
                        <span class="me-2" data-kt-accounts-table-select="selected_count"></span>{{__("common.selected")}}</div>
                        <button type="button" class="btn btn-danger" data-kt-accounts-table-select="delete_selected">{{__("common.delete_selected")}}</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar--> --}}
            </div>
            {{-- <table id="" class="table table-row-bordered table-striped"> --}}
            <table id="kt_table_accounts" class="table table-row-bordered table-striped">
                    <thead>
                    <tr>
                        <th> {{ucwords(__('common.number'))}}</th>
                        <th> {{ucwords(__('common.name'))}}</th>
                        <th> {{ucwords(__('common.image'))}}</th>
                        <th> {{ucwords(__('common.email'))}}</th>
                        <th> {{ucwords(__('common.id_number'))}}</th>
                        <th> {{ucwords(__('common.active'))}}</th>
                        <th> {{ucwords(__('common.created'))}}</th>
                        <th> {{ucwords(__('common.action'))}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $x = 1; ?>
                    @forelse($items as $item)
                        <tr class="odd gradeX" id="tr-{{$item->id}}">
                            <td>{{$x++}}</td>
                            <td> {{$item->full_name}}</td>
                            <td class="center tac"><img src="{{$item->image_url}}" width="30" height="30" /></td>
                            <td> {{$item->email}}</td>
                            <td> {{$item->id_number}}</td>
                            <td> @if($item->status == 1) {{__('common.yes')}} @else  {{__('common.no_')}}  @endif</td>
                            <td class="center">{{$item->created_at}}</td>
                            <td>
                                
                                <!--begin::Menu-->
                                <div class="" style="">
                                    <!--begin::Menu item-->
                                        <a href="{{ route('admin.' . $page_name . '.edit', ['user' => $item->id, 'company_id' => request('company_id')]) }}"
                                            class="menu-link px-3 btn btn-sm btn-info">{{__('common.edit')}}</a>
                                    <!--end::Menu item-->
                                    @if(count($item->activities) == 0)
                                    <!--begin::Menu item-->
                                        <a onclick="delete_row('{{ $item->id }}','{{ $item->id }}',event)"
                                            href="#" class="menu-link px-3 delete_row btn btn-sm btn-danger"
                                            data-kt-accounts-table-filter="delete_row">{{__('common.delete')}}</a>
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
            var url = '{{route("admin.".$page_name.".destroy", [''])}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'get'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                        //swal("حذفت!", {icon: "success"});
                    } else {
                        // swal('Error', {icon: "error"});
                    }
                },
                error: function (e) {
                    // swal('exception', {icon: "error"});
                }
            });
        }
        function delete_row(id, iss_id, e) {
            Swal.fire({
                title: "{{__('common.approving_msg')}}",
                text: "{{__('common.not_reverted_msg')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('common.yes_delete')}}",
                cancelButtonText: "{{__('common.cancel')}}",
                cancelButtonText: "{{__('common.cancel')}}",
                confirmButtonColor: '#d9214e'
            }).then(function(result) {
                if (result.value) {
                    delete_adv(id, iss_id, e);
                    Swal.fire(
                        "{{__('common.deleted')}}",
                        "{{__('common.deleted_msg')}}",
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
                title: "{{__('common.approving_msg')}}",
                text: "{{__('common.not_reverted_msg')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('common.yes_delete')}}",
                cancelButtonText: "{{__('common.cancel')}}",
                cancelButtonText: "{{__('common.cancel')}}",
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
