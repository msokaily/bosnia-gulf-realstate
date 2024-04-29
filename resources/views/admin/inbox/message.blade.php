@extends('layout.adminLayout')
@php
    $page_name = 'inbox';
@endphp
@section('pageTitle')
    {{ ucwords(__('siderbar.' . $page_name)) }}
@endsection
@section('title')
    <a href="{{ url(getLocale() . '/admin/inbox') }}">{{ ucwords(__('siderbar.' . $page_name)) }}</a>
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
                    <div class="form-body form card-body border-top p-9">
                        <fieldset class="mt-5">
                            <div class="input-group input-group-solid mb-5">
                                <label class="col-sm-2 form-label" for="title">
                                    {{ ucwords(__('common.full_name')) }}
                                </label>
                                <div class="col-md-6">
                                    <input autocomplete="off" type="text" value="{{ $item->full_name }}"
                                        class="form-control" disabled>
                                </div>
                                @if ($item->user_id)
                                    <div class="col-md-4">
                                        <h4 class="mt-4 ms-4">
                                            Sign By: <a href="{{ route('admin.users.edit', $item->user_id) }}">{{$item->user->full_name}}</a>
                                        </h4>
                                    </div>
                                @endif
                            </div>
                        </fieldset>

                        <fieldset class="mt-5">
                            <div class="input-group input-group-solid mb-5">
                                <label class="col-sm-2 form-label" for="title">
                                    {{ ucwords(__('common.email')) }}
                                </label>
                                <div class="col-md-6">
                                    <input autocomplete="off" type="text" value="{{ $item->email }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mt-5">
                            <div class="input-group input-group-solid mb-5">
                                <label class="col-sm-2 form-label" for="title">
                                    {{ ucwords(__('common.mobile')) }}
                                </label>
                                <div class="col-md-6">
                                    <input autocomplete="off" type="text" value="{{ $item->mobile }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mt-5">
                            <div class="input-group input-group-solid mb-5">
                                <label class="col-sm-2 form-label" for="title">
                                    {{ ucwords(__('common.title')) }}
                                </label>
                                <div class="col-md-6">
                                    <input autocomplete="off" type="text" value="{{ $item->title }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mt-5">
                            <div class="input-group input-group-solid mb-5">
                                <label class="col-sm-2 form-label" for="title">
                                    {{ ucwords(__('common.msg')) }}
                                </label>
                                <div class="col-sm-10">
                                    <div style="border: 1px solid #d2d6de;padding: 10px;">
                                        <textarea class="form-control" placeholder="{{ __('common.details') }}" cols="30" rows="10">{!! $item->details !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ url('/admin/inbox') }}" type="reset"
                            class="btn btn-light btn-active-light-primary me-2">{{ __('common.back') }}</a>
                        {{-- <a class="btn btn-primary" id="reply">{{__('common.reply')}}</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="portlet light bordered reply_message" style="display: none">
        <form autocomplete="off" class="form-horizontal" method="POST" action="{{ route('admin.send_reply') }}">
            {{ csrf_field() }}
            <div class="form-body form card-body border-top p-9">
                <div class="box-body">
                    <div style="padding-left: 0px;" class="card-header border-0 cursor-pointer" role="button"
                        data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ ucwords(__('common.your_reply')) }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input autocomplete="off" type="hidden" name="msg_id" value="{{ $item->id }}">
                            <textarea name="reply_details" id="reply_details" class="form-control" placeholder="{{ __('common.details') }}"
                                cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a type="reset"
                    class="btn btn-light btn-active-light-primary me-2 cancel">{{ __('common.cancel') }}</a>
                {{-- <button type="submit" id="reply" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('common.send')}}</button> --}}
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        {{--
        CKEDITOR.replace('reply_details', {
            filebrowserUploadUrl: "{{route('admin.ckeditor_upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        --}}

        $('#reply').click(function(e) {
            $('.reply_message').css('display', 'block');
        });

        $('.cancel').click(function(e) {
            $('.reply_message').css('display', 'none');
        });
    </script>
@endsection
