@extends('admin.auth.layout_auth.app')
@if(getLocale() == 'ar')
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
	<style>
		body {
		font-family: 'Cairo', sans-serif !important;
        direction: rtl;
			/* font-family: 'DINNextLTArabic'; */
		}
	</style>
@endif
@section('content')
<!-- Main Content -->
<body id="kt_body" class="app-blank app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form  autocomplete="off" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post" action="{{ url(app()->getLocale().'/password/reset') }}">
                            {{csrf_field()}} 

                            <input autocomplete="off" type="hidden" name="token" value="{{ $token }}">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3"><a href="/"><img style="width: 200px" class="header-logo" src="{{asset('images/favicon.png')}}" alt="WATCARD"></a></h1>
                                <!--end::Title-->
                                <div class="text-gray-500 fw-semibold fs-6">{{__('website.reset_password')}}</div>
                            </div>
                            <!--begin::Heading-->
                            
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                                
                                
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 form-label">{{__('common.email')}}</label>

                            <div class="fv-row mb-8">
                                <input autocomplete="off" id="email" type="email" class="form-control  bg-transparent" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="email" class="col-md-4 form-label">{{__('website.new_password')}}</label>
                            <div class="fv-row mb-8">
                                <input autocomplete="off" placeholder="{{__('website.new_password')}}" id="password" type="password" class="form-control  bg-transparent" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="email" class="col-md-4 form-label">{{__('website.confirm_password')}}</label>
                            <div class="fv-row mb-8">
                                <input autocomplete="off"  placeholder="{{__('website.confirm_password')}}" id="confirm_password" type="password" class="form-control  bg-transparent" name="password_confirmation" value="{{ old('confirm_password') }}">

                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--begin::{{__('common.submit')}} button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">{{__('website.reset_password')}}</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>
                            <!--end::{{__('common.submit')}} button-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
                
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
</body>
@endsection
