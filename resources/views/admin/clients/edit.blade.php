@extends('layout.adminLayout')
@php
    $page_name = 'clients';
@endphp
@section('pageTitle')
    {{ ucwords(__('siderbar.' . $page_name)) }}
@endsection
@section('title')
    <a href="{{ route('admin.' . $page_name . '.index') }}">{{ ucwords(__('siderbar.' . $page_name)) }}</a>
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
                        <h3 class="fw-bold m-0">{{ __('common.edit') }}{{ __('siderbar.' . $page_name) }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="portlet-body ">
                    <form autocomplete="off" id="form_category" method="post"
                        action="{{ route('admin.' . $page_name . '.update', [$item->id]) }}" enctype="multipart/form-data"
                        class="form-horizontal" role="form">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="form-body form card-body border-top p-9">

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label required" for="serial">
                                        {{ __('common.serial') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="serial" type="text"
                                            name="serial" required class="form-control"
                                            autocomplete="off" title="Please enter client serial"
                                            placeholder="{{ __('common.serial') }}" value="{{ old("serial", $item->serial) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label required" for="name">
                                        {{ __('common.name') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            name="name" required class="form-control"
                                            autocomplete="off" title="Please enter client name"
                                            placeholder="{{ __('common.name') }}" value="{{ old("name", $item->name) }}">
                                    </div>
                                </div>
                            </fieldset>

                            {{-- <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="year">
                                        {{ __('common.year') }}
                                    </label>
                                    <div class="col-md-6">
                                        <select data-control="select2" id="year" name="year"
                                            class="form-select form-select-solid">
                                            @foreach (range(date("Y", \Carbon\Carbon::now()->addYears(5)->timestamp), 2015) as $one)
                                                <option @if (old('year', $item->year) == $one) selected @endif
                                                    value="{{ $one }}"> {{ $one }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset> --}}

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="email">
                                        {{ __('common.email') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            name="email" class="form-control"
                                            autocomplete="off" title="Please enter client email"
                                            placeholder="{{ __('common.email') }}" value="{{ old("email", $item->email) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="mobile">
                                        {{ __('common.mobile') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="mobile" type="tel"
                                            name="mobile" class="form-control"
                                            autocomplete="off" title="Please enter client mobile"
                                            placeholder="{{ __('common.mobile') }}" value="{{ old("mobile", $item->mobile) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="status">
                                        {{ __('common.status') }}
                                        {{-- <span class="symbol">*</span> --}}
                                    </label>
                                    <div class="col-md-6">
                                        <select data-control="select2" id="status" name="status"
                                            class="form-select form-select-solid">
                                            @foreach ([(object)['id' => 1, 'name' => 'Active'], (object)['id' => 0, 'name' => 'InActive']] as $one)
                                                <option @if (old('status', $item->status) == $one->id) selected @endif
                                                    value="{{ $one->id }}"> {{ $one->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('admin.' . $page_name . '.index') }}" type="reset"
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
