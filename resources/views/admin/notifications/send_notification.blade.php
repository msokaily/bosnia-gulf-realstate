@extends('layout.adminLayout')
@php
    $page_name = 'send_notify';
@endphp
@section('pageTitle')
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
@section('title')
    <a href="{{route('admin.'.$page_name.'.index')}}">{{ucwords(__('siderbar.'.$page_name))}}</a>
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
                <div class="portlet-body ">
                    <form  autocomplete="off" class="needs-validation" action="{{url(app()->getLocale().'/admin/send_notify')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="title_en">
                                        {{__('common.notification_title')}} (EN)
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" maxlength="50" required="required" name="title_en" value="{{old('title.en')}}" type="text" class="form-control" id="title_en">
                                    </div>
                                </div>
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="title_ar">
                                        {{__('common.notification_title')}} (AR)
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" maxlength="50" required="required" name="title_ar" value="{{old('title.ar')}}" type="text" class="form-control" id="title_ar">
                                    </div>
                                </div>
                                <hr>
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="body_en">
                                        {{__('common.notification_details')}} (EN)
                                    </label>
                                    <div class="col-md-6">
                                        <textarea maxlength="400" type="text" class="form-control" required="required" name="body_en" id="body_en">{{old('body.en')}}</textarea>
                                    </div>
                                </div>
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="body_ar">
                                        {{__('common.notification_details')}} (AR)
                                    </label>
                                    <div class="col-md-6">
                                        <textarea maxlength="400" type="text" class="form-control" required="required" name="body_ar" id="body_ar">{{old('body.ar')}}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                            
                            {{-- <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="image">
                                        {{__('common.image')}}
                                        <span class="symbol"><small><B>250X250</B></small> </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" id="image" type="file" name="image" class="form-control"
                                            placeholder="{{__('common.image')}}">
                                    </div>
                                </div>
                            </fieldset> --}}
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{!! url('/admin')!!}" type="reset" class="btn btn-light btn-active-light-primary me-2">{{__('common.cancel')}}</a>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('common.save_changes')}}</button>
                        </div>
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
<script>
    $(document).ready(function(){
        $('form').submit(function(e){
            $('button').prop("disabled", true);
        });
    });
</script>
@endsection
