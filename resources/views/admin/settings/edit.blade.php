@extends('layout.adminLayout')

@section('pageTitle')
    {{ ucwords(__('common.settings')) }}
@endsection

@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        html[lang="ar"] .ui-tabs {
            direction: rtl;
        }

        html[lang="ar"] .ui-tabs .ui-tabs-nav li.ui-tabs-selected,

        html[lang="ar"] .ui-tabs .ui-tabs-nav li.ui-state-default {
            float: right;
        }

        html[lang="ar"] .ui-tabs .ui-tabs-nav li a {
            float: right;
        }
    </style>

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
                        <h3 class="fw-bold m-0">{{ __('common.edit') }} {{ __('common.settings') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="portlet-body ">

                    <form autocomplete="off" method="post" action="{{ route('admin.settings.update', [$item->id]) }}"
                        enctype="multipart/form-data" class="form-horizontal" role="form">
                        @method('PUT')
                        {{ csrf_field() }}

                        <div class="form-body form card-body border-top p-9">
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="address">
                                        {{ __('common.address') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input required autocomplete="off" type="text"
                                            class="form-control form-control-solid" name="address"
                                            value="{{ $item->address }}" id="address"
                                            placeholder="{{ __('common.address') }}">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="location">
                                        {{ __('common.location') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="url"
                                            class="form-control form-control-solid" name="location"
                                            value="{{ $item->location }}" id="location"
                                            placeholder="{{ __('common.location') }}">
                                    </div>
                                </div>
                            </fieldset>

                            {{-- <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{ __('common.email') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="email"
                                            class="form-control form-control-solid" name="email"
                                            value="{{ $item->email }}" id="order"
                                            placeholder="{{ __('common.email') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="phone">
                                        Phone
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" type="text"
                                            class="form-control form-control-solid" name="phone"
                                            value="{{ $item->phone }}" id="order" placeholder="Phone">
                                    </div>
                                </div>
                            </fieldset> --}}


                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="order">
                                        {{ __('common.mobile') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input required autocomplete="off" type="text"
                                            class="form-control form-control-solid" name="mobile"
                                            value="{{ $item->mobile }}" id="order"
                                            placeholder="{{ __('common.mobile') }}" {{ old('mobile') }}>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5 row">
                                    <div class="col-12">
                                        <label class="form-label" for="site_description[bs]">
                                            Description
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <textarea class="form-control form-control-solid" name="site_description[bs]" placeholder="Description (BS)" rows="10">{{ $item->translate('site_description', 'bs') }}</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <textarea class="form-control form-control-solid" name="site_description[en]" placeholder="Description (EN)" rows="10">{{ $item->translate('site_description', 'en') }}</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <textarea class="form-control form-control-solid" name="site_description[ar]" placeholder="Description (AR)" rows="10">{{ $item->translate('site_description', 'ar') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="home-background-image">
                                        Home Background
                                    </label>
                                    <div class="col-md-3">
                                        @livewire('upload-file', ['fileId' => old('home_bg', $item->home_bg), 'input' => 'home_bg', 'thumbnailWidth' => 'auto', 'thumbnailHeight' => 'auto'])
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="home-background-image">
                                        Menu Background
                                    </label>
                                    <div class="col-md-3">
                                        @livewire('upload-file', ['fileId' => old('menu_bg', $item->menu_bg), 'input' => 'menu_bg', 'thumbnailWidth' => 'auto', 'thumbnailHeight' => 'auto'])
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ url(getLocale() . '/admin/settings') }}" type="reset"
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

@section('js')
@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {

            $("#tabs").tabs();

        });
    </script>
@endsection
