@extends('layout.adminLayout')
@section('pageTitle')
    {{ucwords(__('common.title_admin'))}}
@endsection
@section('title')
    {{ucwords(__('common.title_admin'))}}
@endsection
@section('filter') 
    <!--begin::Actions-->
    <div class="d-flex align-items-center gap-2 gap-lg-3" style="justify-content: flex-end;">
        <!--begin::{{__('common.filter')}} menu-->
        <div class="m-0">
            <!--begin::Menu toggle-->
            <a href="#" id="filter_btn" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                <form  autocomplete="off" method="get" id="myform" action="{{url(getLocale().'/admin/admins')}}">
                    <div class="px-7 py-5">
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
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <a href="{{url(app()->getLocale().'/admin/admins')}}" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">{{__('common.reset')}}</a>
                            <button type="submit" class="btn btn-sm btn-primary" >{{__('common.search')}}</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Menu 1-->
        </div>
        <!--end::{{__('common.filter')}} menu-->
        <!--begin::Primary button-->
        <a href="{{url(app()->getLocale().'/admin/admins/create')}}" class="btn btn-sm fw-bold btn-primary">{{__('common.add')}}</a>
        <!--end::Primary button-->
    </div>
    <!--end::Actions-->
@endsection
@section('css')
@endsection
@section('content')
    <div class="portlet light bordered">
        <div class="portlet-body">
            <input autocomplete="off" type="hidden" id="url" value="{{url(app()->getLocale()."/admin/admins/changeStatus")}}">
            <table id="kt_datatable_zero_configuration" class="table table-row-bordered table-striped gy-5">
                <thead>
                <tr>
                    <th> {{ucwords(__('common.number'))}}</th>
                    <th> {{ucwords(__('common.full_name'))}}</th>
                    <th> {{ucwords(__('common.email'))}}</th>
                    <th> {{ucwords(__('common.phone'))}}</th>
                    <th> {{ucwords(__('common.role'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @forelse($items as $item)
                    <tr class="odd gradeX" id="tr-{{$item->id}}">
                        <td class="text-center ps-2">{{$x++}}</td>
                        <td>{{$item->full_name}}</td>
                        <td><a href="mailto:{{$item->email}}">{{$item->email}}</a></td>
                        <td><a href="tel:{{$item->phone}}">{{$item->phone}}</a></td>
                        <td>{{$item->user_type}}</td>
                        <td style="min-width: 100px;">
                            @if($item->id != 1 AND Auth::User()->id != $item->id)
                            <!--begin::Menu-->
                            <div class="" style="">
                                @if(Auth::User()->id == 1)
                                    <!--begin::Menu item-->
                                        <a href="{{url(getLocale().'/admin/admins/'.$item->id.'/edit')}}" class="btn btn-sm btn-info menu-link px-3">{{__('common.edit')}}</a>
                                    <!--end::Menu item-->
                                @endif
                                @if($item->id != 1 AND Auth::User()->id != $item->id)
                                    <!--begin::Menu item-->
                                        <a onclick="delete_row('{{$item->id}}','{{$item->id}}',event)" href="#" class="btn btn-sm btn-danger menu-link px-3 delete_row" data-kt-users-table-filter="delete_row">{{__('common.delete')}}</a>                             
                                    <!--end::Menu item-->
                                @endif
                            </div>
                            @endif
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
            var url = '{{route("admin.admins.destroy", [''])}}/' + id;
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
@endsection
