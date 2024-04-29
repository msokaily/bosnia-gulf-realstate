@extends('layout.adminLayout')
@php
    $page_name = 'locations';
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
                        <h3 class="fw-bold m-0">{{ __('common.add') }}{{ __('siderbar.' . $page_name) }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="portlet-body ">
                    <form autocomplete="off" id="form_category" method="post"
                        action="{{ route('admin.' . $page_name . '.store') }}" enctype="multipart/form-data"
                        class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body form card-body border-top p-9">

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="location">
                                        {{ __('common.location') }} (x, y)
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input id="coordinates" type="text" name="coordinates" required
                                            class="form-control" autocomplete="off" title="Please enter coordinates"
                                            placeholder="{{ __('common.coordinates') }}" value="{{ old('coordinates') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="title">
                                        {{ __('common.title') }}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input id="title" type="text" name="title" required class="form-control"
                                            autocomplete="off" title="Please enter title"
                                            placeholder="{{ __('common.title') }}" value="{{ old('title') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 form-label" for="description">
                                        {{ __('common.description') }}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea id="kt_docs_tinymce_hidden" name="description" class="form-control"
                                            placeholder="{{ __('common.description') }}">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label
                                        class="col-lg-2 col-form-label fw-semibold fs-6">{{ __('common.active') }}</label>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input autocomplete="off"
                                                @if (old('status', 1)) checked value="1" @endif
                                                class="form-check-input w-45px h-30px" type="checkbox" id="status"
                                                name="status">
                                            <label class="form-check-label" for="status"></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{ __('common.icon') }}</label>
                                <div class="col-lg-6 d-flex align-items-center">
                                    @livewire('upload-file', ['fileId' => old('image'), 'input' => 'image', 'multiple' => false])
                                </div>
                            </fieldset>

                            <fieldset class="mt-5 row">
                                <div class="col-md" style="position: relative;">
                                    <a target="_blank" class="location-pointer"
                                        style="left: {{ old('left_shift', 0) + 0.8 }}%; top: {{ old('top_shift', 0) }}%">
                                        <div>
                                            <div>{{ old('message') }}</div>
                                        </div>
                                    </a>
                                    <img src="{{ asset('assets/images/divota_map.png') }}" alt="Divota Map" width="100%">
                                </div>
                                <div class="col-md-3">
                                    <div style="position: sticky; top: 200px;">
                                        <div class="mb-5">
                                            <label class="form-label" for="left_shift">
                                                Left Shift ( on map image ) <span
                                                    class="left_shift_v">{{ old('left_shift', 0) }}</span>%
                                            </label>
                                            <div>
                                                {{-- <input id="left_shift" type="text" name="left_shift" class="form-control"
                                                    autocomplete="off" title="Please enter left shift" placeholder="left shift"
                                                    value="{{ $item->left_shift }}"> --}}
                                                <input type="range" name="left_shift" id="left_shift" max="100"
                                                    min="0" step="0.5" value="{{ old('left_shift', 0) }}">
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label class="form-label" for="top_shift">
                                                Top Shift ( on map image ) <span
                                                    class="top_shift_v">{{ old('top_shift', 0) }}</span>%
                                            </label>
                                            <div>
                                                {{-- <input id="top_shift" type="text" name="top_shift" class="form-control"
                                                    autocomplete="off" title="Please enter top shift" placeholder="top shift"
                                                    value="{{ $item->top_shift }}"> --}}
                                                <input type="range" name="top_shift" id="top_shift" max="100"
                                                    min="0" step="0.5" value="{{ old('top_shift', 0) }}">
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label class="form-label" for="message">
                                                Tooltip Message ( on map image )
                                            </label>
                                            <div>
                                                <input id="message" type="text" name="message" class="form-control"
                                                    autocomplete="off" title="Please enter message"
                                                    placeholder="Ex. View Accommodations" value="{{ old('message') }}">
                                            </div>
                                        </div>
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
    {{-- CKEditor --}}
    <script>
        tinymce.init({
            selector: "#kt_docs_tinymce_hidden",
            height: "480",
            menubar: false,
            toolbar: ["styleselect | fontsizeselect",
                "undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | advlist | autolink | lists charmap | preview"
            ],
            plugins: "advlist  link image lists charmap print preview code"
        });
    </script>
    {{-- CKEditor --}}

    <script>
        $(function() {
            $(document).on('input change', '#left_shift', function(e) {
                $('.location-pointer').css({
                    'left': (parseFloat(e.target.value) + 0.8) + '%'
                });
                $('.left_shift_v').text(e.target.value);
            });
            $(document).on('input change', '#top_shift', function(e) {
                $('.location-pointer').css({
                    'top': (parseFloat(e.target.value) + 0.8) + '%'
                });
                $('.top_shift_v').text(e.target.value);
            });
        });
    </script>
@endsection
