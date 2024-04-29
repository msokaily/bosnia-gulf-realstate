@extends('layout.adminLayout')
@php
    $page_name = 'inbox';
@endphp
@section('pageTitle') 
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
@section('title') 
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
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
                <form  autocomplete="off" method="get" id="myform" action="{{url(getLocale().'/admin/inbox')}}">
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">{{__('common.from_date')}}:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <input autocomplete="off" class="pick_date form-control form-control-solid" placeholder="{{__('common.pick_a_date')}}" autocomplete="off" value="{{request('from_date')?request('from_date'):''}}"
                                name="from_date" id="from_date" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">{{__('common.to_date')}}:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <input autocomplete="off" class="pick_date form-control form-control-solid" placeholder="{{__('common.pick_a_date')}}" autocomplete="off" value="{{request('to_date')?request('to_date'):''}}"
                                name="to_date" id="to_date" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">{{__('common.email')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <input autocomplete="off" type="email" class="form-control" name="email"
                                       placeholder="{{__('common.email')}}" value="{{request('email')}}">
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">{{__('common.mobile')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <input autocomplete="off" type="text" class="form-control" name="mobile"
                                    placeholder="{{__('common.mobile')}}" value="{{request('mobile')}}">
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">{{__('common.type')}}:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <select name="type" class="basic-hide-search form-select form-select-solid" data-kt-select2="true" data-placeholder="{{__('common.select_option')}}" data-dropdown-parent="#kt_menu_633f0992a4adf" data-allow-clear="true">
                                    <option value="All">{{__('common.all')}}</option>
                                    <option value="Message" @php $selected = ((request('type') ?? old('type')) == 'Message') ? 'selected' : ''; @endphp> Message</option>
                                    <option value="Suggestion" @php $selected = ((request('type') ?? old('type')) == 'Suggestion') ? 'selected' : ''; @endphp> Suggestion</option>
                                    <option value="Problem" @php $selected = ((request('type') ?? old('type')) == 'Problem') ? 'selected' : ''; @endphp> Problem</option>
                                </select>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <a href="{{url('admin/inbox?reset=true')}}" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">{{__('common.reset')}}</a>
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
    </div>
    <!--end::Actions-->
@endsection
@section('css')
<style>
.search_div{
    padding: 0px !important;
}
</style>
@endsection
@section('content')
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
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-accounts-table-toolbar="selected">
                        <div class="fw-bold me-5">
                        <span class="me-2" data-kt-accounts-table-select="selected_count"></span>{{__("common.selected")}}</div>
                        <button type="button" class="btn btn-danger" data-kt-accounts-table-select="delete_selected">{{__("common.delete_selected")}}</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <table id="kt_table_accounts" class="table table-row-bordered table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th> {{ucwords(__('common.title'))}}</th>
                    <th> {{ucwords(__('common.full_name'))}}</th>
                    <th> {{ucwords(__('common.email'))}}</th>
                    <th> {{ucwords(__('common.mobile'))}}</th>
                    <th> {{ucwords(__('common.type'))}}</th>
                    <th> {{ucwords(__('common.status'))}}</th>
                    <th> {{ucwords(__('common.created'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @forelse($items as $item)
                    <tr class="odd gradeX" id="tr-{{$item->id}}">
                        <td>{{ $loop->iteration}}</td>
                        <td> {{$item->title}}</td>
                        <td> {{$item->full_name}}</td>
                        <td> {{$item->email}}</td>
                        <td> {{$item->mobile}}</td>
                        <td> {{$item->type}}</td>
                        <td><span class="badge @if($item->is_replied == 1) badge-light-success @else <?php echo ($item->is_read == 1)
                                    ? "badge-light-primary" : "badge-light-danger"?> @endif" id="label-{{$item->id}}">
                                            
                                @if($item->is_replied == 1)
                                    {{__('common.replied')}}
                                @else
                                    @if($item->is_read == 1)
                                        {{__('common.read')}}
                                    @else
                                        {{__('common.new')}}
                                    @endif
                                @endif
                                </span></td>
                        <td> {{$item->created_at}}</td>
                        <td>
                            
                            <!--begin::Menu-->
                            <div class="" style="">
                                <!--begin::Menu item-->
                                    <a href="{{url('/admin/viewMessage/'.$item->id)}}"
                                        class="menu-link px-3 btn btn-sm btn-info">{{__('common.show')}}</a>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                    <a onclick="delete_row('{{ $item->id }}','{{ $item->id }}',event)"
                                        href="#" class="menu-link px-3 delete_row btn btn-sm btn-danger"
                                        data-kt-accounts-table-filter="delete_row">{{__('common.delete')}}</a>
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
        function delete_adv(id, iss_id, e) {
            e.preventDefault();
            var url = '{{url(getLocale()."/admin/inbox")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'get',
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
@endsection
