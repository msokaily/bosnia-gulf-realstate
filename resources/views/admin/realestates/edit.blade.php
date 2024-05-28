@extends('layout.adminLayout')
@php
    $page_name = 'realestates';
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
                                    <label class="col-sm-2 form-label" for="opu_ip">
                                        {{ __('common.opu_ip') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="opu_ip" type="text"
                                            name="opu_ip" class="form-control"
                                            autocomplete="off" title="Please enter client opu_ip"
                                            placeholder="{{ __('common.opu_ip') }}" value="{{ old("opu_ip", $item->opu_ip) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="address">
                                        {{ __('common.address') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="address" type="text"
                                            name="address" class="form-control"
                                            autocomplete="off" title="Please enter client address"
                                            placeholder="{{ __('common.address') }}" value="{{ old("address", $item->address) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="meter_price">
                                        {{ __('common.meter_price') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="meter_price" type="text"
                                            name="meter_price" class="form-control"
                                            autocomplete="off" title="Please enter real estate meter price"
                                            placeholder="{{ __('common.meter_price') }}" value="{{ old("meter_price", $item->meter_price) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="area">
                                        {{ __('common.area') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="area" type="text"
                                            name="area" class="form-control"
                                            autocomplete="off" title="Please enter real estate area"
                                            placeholder="{{ __('common.area') }}" value="{{ old("area", $item->area) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="initial_cost_total">
                                        {{ __('common.initial_cost_total') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="initial_cost_total" type="text"
                                            name="initial_cost_total" class="form-control"
                                            autocomplete="off" title="Please enter real estate initial total cost"
                                            placeholder="{{ __('common.initial_cost_total') }}" value="{{ old("initial_cost_total", $item->initial_cost_total) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="construction_total">
                                        {{ __('common.construction_total') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="construction_total" type="text"
                                            name="construction_total" class="form-control"
                                            autocomplete="off" title="Please enter real estate construction total cost"
                                            placeholder="{{ __('common.construction_total') }}" value="{{ old("construction_total", $item->construction_total) }}">
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
                            <a href="{{ route('admin.' . $page_name . '.index') }}?client={{request('client', $client)}}" type="reset"
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
<script>
    $(function(){
        function calcTotal() {
            const meter_price = parseFloat($('input[name="meter_price"]').val());
            const area = parseFloat($('input[name="area"]').val());
            const initial_cost_total = parseFloat($('input[name="initial_cost_total"]').val());
            const construction_total = parseFloat($('input[name="construction_total"]').val());
            if (!construction_total) {
                let total = (meter_price * area) + initial_cost_total;
                $('input[name="construction_total"]').val(total);
            }
        }
        $('input[name="meter_price"], input[name="area"], input[name="initial_cost_total"]').change(function() {
            calcTotal();
        });
    });
</script>
@endsection
