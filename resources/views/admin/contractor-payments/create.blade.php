@extends('layout.adminLayout')
@php
    $page_name = 'contractor-payments';
    $page_title = 'contractor_payments';
@endphp
@section('pageTitle')
    {{ ucwords(__('siderbar.' . $page_title)) }}
@endsection
@section('title')
    <a href="{{ route('admin.' . $page_name . '.index') }}">{{ ucwords(__('siderbar.' . $page_title)) }}</a>
@endsection

@section('css_file_upload')
    <link href="{{ admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet"
        type="text/css" />
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
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('common.add') }}{{ __('siderbar.' . $page_title) }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="portlet-body ">
                    <form autocomplete="off" id="form_category" method="post"
                        action="{{ route('admin.' . $page_name . '.store') }}" enctype="multipart/form-data"
                        class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="realstate_id" value="{{request('realstate')}}">
                        <div class="form-body form card-body border-top p-9">

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label required" for="amount">
                                        {{ __('common.amount') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="amount" type="text"
                                            name="amount" required class="form-control"
                                            autocomplete="off" title="Please enter amount"
                                            placeholder="{{ __('common.amount') }}" value="{{ old("amount") }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="reason">
                                        {{ __('common.reason') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="reason" type="text"
                                            name="reason" class="form-control"
                                            autocomplete="on" title="Please enter payment reason"
                                            placeholder="{{ __('common.reason') }}" value="{{ old("reason") }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="note">
                                        {{ __('common.note') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="note" type="text"
                                            name="note" class="form-control"
                                            autocomplete="off" title="Please enter note"
                                            placeholder="{{ __('common.note') }}" value="{{ old("note") }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="paid_at">
                                        {{ __('common.paid_at') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="paid_at" type="date"
                                            name="paid_at" class="form-control"
                                            autocomplete="off" title="Please enter paid at"
                                            placeholder="{{ __('common.paid_at') }}" value="{{ old("paid_at") }}">
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('admin.' . $page_name . '.index') }}?realstate={{request('realstate')}}" type="reset"
                                class="btn btn-light btn-active-light-primary me-2">{{ __('common.discard') }}</a>
                            <button type="submit" class="btn btn-primary"
                                id="kt_account_profile_details_submit">{{ __('common.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
