@extends('auth.layout_auth.app')
@if(getLocale() == 'ar')
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
	<style>
		body {
		font-family: 'Cairo', sans-serif !important;
			/* font-family: 'DINNextLTArabic'; */
		}
	</style>
@endif
@section('content')
	<body @if(getLocale() == 'ar') dir="rtl" @endif id="kt_body" class="app-blank app-blank">
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
							<form  autocomplete="off" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post" action="{{route('login')}}">
								{{csrf_field()}} 
								<!--begin::Heading-->
								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3"><a href="/"><img style="width: 200px" class="header-logo" src="{{asset('assets/images/logo.svg')}}" alt="Divota"></a></h1>
									<!--end::Title-->
								</div>
								<!--begin::Heading-->
								<!--begin::Separator-->
								<div class="separator separator-content my-14">
									<span class="w-125px text-gray-500 fw-semibold fs-7">{{__('common.sign_in')}}</span>
								</div>
								<!--end::Separator-->
								
								@if (count($errors) > 0)
									<div class="alert alert-danger">
										<strong>{{'Error'}}!</strong>{{' Wrong data entry'}}<br>
										<ul class="list-unstyled">
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
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
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
									<input autocomplete="off" type="text" placeholder="{{__('common.email')}}" name="email" autocomplete="off" class="form-control bg-transparent" />
									<!--end::Email-->
								</div>
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
									<input autocomplete="off" type="password" placeholder="{{__('common.password')}}" name="password" autocomplete="off" class="form-control bg-transparent" />
									<!--end::Password-->
								</div>
								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<!--begin::Link-->
									<a href="{{route('password.reset')}}" class="link-primary">{{__('common.forget_password')}}</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::{{__('common.submit')}} button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">{{__('common.sign_in')}}</span>
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