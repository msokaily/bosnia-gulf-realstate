@extends('layout.adminLayout')

@section('pageTitle')
    {{__('common.add')}}{{__('common.Admin')}}
@endsection
@section('title') <a href="{{url('/admin/admins')}}">{{ucwords(__('common.admins'))}}</a>
@endsection


@section('css_file_upload')
    <link href="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('css')
    <style type="text/css">
        .input-controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->

              <div class="card mb-5 mb-xl-10 portlet light bordered">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{__('common.add')}}{{__('common.Admin')}}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="portlet-body ">
                    <form  autocomplete="off" id="form_category" method="post" action="{{url(app()->getLocale().'/admin/admins')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body form card-body border-top p-9">

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{__('common.first_name')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="text" name="first_name" class="form-control"
                                        placeholder="{{__('common.first_name')}}" value="{{ old('first_name') }}" required>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{__('common.last_name')}}
                                        {{-- <span class="symbol">*</span> --}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="text" name="last_name" class="form-control"
                                        placeholder="{{__('common.last_name')}}" value="{{ old('last_name') }}" >
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{__('common.email')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="email" class="form-control" name="email"
                                        placeholder="{{__('common.email')}}" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="phone">
                                        {{__('common.phone')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="phone" class="form-control" name="phone"
                                        placeholder="{{__('common.phone')}}" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{__('common.password')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="password" class="form-control" name="password" value=""
                                               placeholder="{{__('common.password')}}" required>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{__('common.confirm_password')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="password" class="form-control" name="confirm_password" value=""
                                               placeholder="{{__('common.confirm_password')}}" required>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{url(getLocale().'/admin/admins')}}" type="reset" class="btn btn-light btn-active-light-primary me-2">{{__('common.discard')}}</a>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('common.save_changes')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_file_upload')
    <script src="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
            type="text/javascript"></script>

@endsection

@section('js')
@endsection
@section('script')
    <script>
        $('.select-all-perms-btn').click(function() {
            var element =$('select#permissions');
            element.select2("destroy");
            element.find("option").each(function(i,e){
                $(e).prop('selected', true);
            });
            element.select2();
        });
        $('.unselect-all-perms-btn').click(function() {
            var element =$('select#permissions');
            element.select2("destroy");
            element.find("option").each(function(i,e){
                $(e).prop('selected', false);
            });
            element.select2();
        });

        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $('#edit_file').on('change', function (e) {
            readURL(this, $('#edit_file'));
        });
    </script>
@endsection
