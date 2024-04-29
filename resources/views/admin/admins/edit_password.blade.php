@extends('layout.adminLayout')

@section('pageTitle')
@if(isAdmin()){{ucwords(__('common.admins'))}}@else{{__('siderbar.profile')}}@endif
@endsection
@section('title')
@if(isAdmin())
    <a href="{{url('/admin/admins')}}">{{ucwords(__('common.admins'))}}</a>
@else
    <a href="{{url('/admin/profile')}}">{{ucwords(__('siderbar.profile'))}}</a>
@endif

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{__('common.edit')}}{{__('common.password')}}</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="portlet-body ">
                    <form  autocomplete="off" method="post" action="{{url(app()->getLocale().'/admin/admins/'.$item->id.'/edit_password')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body form card-body border-top p-9">
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{__('common.password')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="password"  class="form-control" name="password" value=""
                                               placeholder=" {{__('common.password')}}" required>
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
                                        <input autocomplete="off" type="password"  class="form-control" name="confirm_password" value=""
                                               placeholder=" {{__('common.confirm_password')}}" required>
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