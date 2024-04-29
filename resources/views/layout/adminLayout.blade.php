<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="{{app()->getLocale()}}" class="{{getLocale() == 'ar' ? 'rtl' : 'ltr'}}" dir="{{getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
	<!--begin::Head-->
	<head>
		<base href=""/>
		<title>
            @yield('pageTitle') | 
            {{__('common.control_panel')}}
        </title>
		<meta charset="utf-8" />
		<meta name="description"
        content="{{env('APP_NAME')}}: Empowering companies, service providers, and employees with seamless synergy. Unlock growth, collaboration, and success in one innovative platform for the future of business management." />
		<meta name="keywords" content="{{env('APP_NAME')}},manage,business,service,provider,hotel,apartment,room,villa,spa,shop,restaurant" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="{{ getLocale() }}" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{env('APP_NAME')}}" />
		<meta property="og:url" content="{{ url()->current() }}" />
		<meta property="og:site_name" content="{{env('APP_NAME')}}" />
		<link rel="canonical" href="{{ url()->current() }}" />
		<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{ admin_assets('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
			type="text/css" />
		<link href="{{ admin_assets('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
			type="text/css" />
		<link rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		@if (app()->getLocale() == 'ar')
			<link href="{{ admin_assets('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
			<link href="{{ admin_assets('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
				type="text/css" />
			<link href="{{ admin_assets('assets/css/custom-rtl.css?ver='.rand(1111,9999)) }}" rel="stylesheet" type="text/css" />
			
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
	
		@else
			<link href="{{ admin_assets('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
			<link href="{{ admin_assets('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
			<link href="{{ admin_assets('assets/css/custom.css?ver='.rand(1111,9999)) }}" rel="stylesheet" type="text/css" />
		@endif
		<link href="{{ admin_assets('assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
		<link href="{{ admin_assets('assets/css/livewire-components.css?ver='.rand(1111,9999)) }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
        @yield('css_file_upload')
        @yield('css')
        @stack('style')
		<style>
			.form-check-input:hover{
				cursor: pointer !important;
			}
		</style>
		@livewireStyles
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	@php
		$uri1 = explode("/", request()->url())[4] ?? '';
		$uri2 = explode("/", request()->url())[5] ?? '';
	@endphp
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header">
					<!--begin::Header container-->
					<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<!--begin::sidebar mobile toggle-->
						<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
							<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
								<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
								<span class="svg-icon svg-icon-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
										<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
						</div>
						<!--end::sidebar mobile toggle-->
						<!--begin::Mobile logo-->
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
							<a href="{{ route('admin.home') }}" class="d-lg-none">
								<img alt="{{env('APP_NAME')}}" src="{{asset('images/favicon.png')}}" class="h-30px" />
							</a>
						</div>
						<!--end::Mobile logo-->
						<!--begin::Header wrapper-->
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
							
							<!--begin::Menu wrapper-->
							<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
								<!--begin::Menu-->
								{{-- <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="{{dropdown_direction('bottom-start')}}" class="menu-item @if(in_array($uri1,['reports'])) show here @endif  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span style="width: 80px" class="menu-title">{{__('siderbar.dashboards')}}</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
											<!--begin:Dashboards menu-->
											<div class="menu-state-bg menu-extended overflow-hidden" data-kt-menu-dismiss="true">
												<!--begin:Row-->
												<div class="row">
													<!--begin:Col-->
													<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
														<!--begin:Row-->
														<div class="row">
															<!--begin:Col-->
															<div class="col-lg-6 mb-3">
																<!--begin:Menu item-->
																<div class="menu-item p-0 m-0">
																	<!--begin:Menu link-->
																	<a href="{{route('admin.reports.index')}}" class="menu-link @if(in_array($uri1,['reports'])) active @endif">
																		<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																			<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																			<span class="svg-icon svg-icon-primary svg-icon-1">
																				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																					<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
																					<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
																					<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
																					<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
																				</svg>
																			</span>
																			<!--end::Svg Icon-->
																		</span>
																		<span class="d-flex flex-column">
																			<span class="fs-6 fw-bold text-gray-800">{{__('siderbar.reports')}}</span>
																			<span class="fs-7 fw-semibold text-muted">{{__('siderbar.reports_statistics')}}</span>
																		</span>
																	</a>
																	<!--end:Menu link-->
																</div>
																<!--end:Menu item-->
															</div>
															<!--end:Col-->
														</div>
														<!--end:Row-->
													</div>
													<!--end:Col-->
												</div>
												<!--end:Row-->
											</div>
											<!--end:Dashboards menu-->
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									@if(isCompany())
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="{{dropdown_direction('bottom-start')}}" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-title">{{__('siderbar.help')}}</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" style="">
											<!--begin:Menu item-->
											<div class="menu-item">
												<!--begin:Menu link-->
												<a class="menu-link" href="mailto:{{$settings->email}}" target="blank" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Check out over 200 in-house components, plugins and ready for use solutions" data-kt-initialized="1">
													<span class="menu-icon">
														<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
														<span class="svg-icon svg-icon-3">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path opacity="0.3" d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z" fill="currentColor"></path>
																<path d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z" fill="currentColor"></path>
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<span class="menu-title">{{__('siderbar.send_email')}}</span>
												</a>
												<!--end:Menu link-->
											</div>
											<!--end:Menu item-->
											<!--begin:Menu item-->
											<div class="menu-item">
												<!--begin:Menu link-->
												<a class="menu-link" href="tel:{{$settings->mobile}}" target="blank" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Check out the complete documentation" data-kt-initialized="1">
													<span class="menu-icon">
														<span class="fa fa-phone"></span>
														<!--end::Svg Icon-->
													</span>
													<span class="menu-title">{{__('siderbar.call')}} {{$settings->mobile}}</span>
												</a>
												<!--end:Menu link-->
											</div>
											<!--end:Menu item-->
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									@endif
								</div> --}}
								<!--end::Menu-->
								<!--begin::Menu-->
								{{-- <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
									<!--begin:Menu item-->
									<span class="menu-link" style="display: flex; align-items: center; min-width: 130px; width: auto; margin-inline-end: 20px;">
										<a href="{{ env('APP_URL') }}" target="_blank">Visit Website</a>
									</span>
									<!--end:Menu item-->
								</div> --}}
								<!--end::Menu-->

							</div>
							<!--end::Menu wrapper-->
							<!--begin::Navbar-->
							<div class="app-navbar flex-shrink-0">
								<!--begin::Theme mode-->
								<div class="app-navbar-item ms-1 ms-lg-3">
									<!--begin::Menu toggle-->
									<a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">
										<!--begin::Svg Icon | path: icons/duotune/general/gen060.svg-->
										<span class="svg-icon theme-light-show svg-icon-2">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M11.9905 5.62598C10.7293 5.62574 9.49646 5.9995 8.44775 6.69997C7.39903 7.40045 6.58159 8.39619 6.09881 9.56126C5.61603 10.7263 5.48958 12.0084 5.73547 13.2453C5.98135 14.4823 6.58852 15.6185 7.48019 16.5104C8.37186 17.4022 9.50798 18.0096 10.7449 18.2557C11.9818 18.5019 13.2639 18.3757 14.429 17.8931C15.5942 17.4106 16.5901 16.5933 17.2908 15.5448C17.9915 14.4962 18.3655 13.2634 18.3655 12.0023C18.3637 10.3119 17.6916 8.69129 16.4964 7.49593C15.3013 6.30056 13.6808 5.62806 11.9905 5.62598Z" fill="currentColor" />
												<path d="M22.1258 10.8771H20.627C20.3286 10.8771 20.0424 10.9956 19.8314 11.2066C19.6204 11.4176 19.5018 11.7038 19.5018 12.0023C19.5018 12.3007 19.6204 12.5869 19.8314 12.7979C20.0424 13.0089 20.3286 13.1274 20.627 13.1274H22.1258C22.4242 13.1274 22.7104 13.0089 22.9214 12.7979C23.1324 12.5869 23.2509 12.3007 23.2509 12.0023C23.2509 11.7038 23.1324 11.4176 22.9214 11.2066C22.7104 10.9956 22.4242 10.8771 22.1258 10.8771Z" fill="currentColor" />
												<path d="M11.9905 19.4995C11.6923 19.5 11.4064 19.6187 11.1956 19.8296C10.9848 20.0405 10.8663 20.3265 10.866 20.6247V22.1249C10.866 22.4231 10.9845 22.7091 11.1953 22.9199C11.4062 23.1308 11.6922 23.2492 11.9904 23.2492C12.2886 23.2492 12.5746 23.1308 12.7854 22.9199C12.9963 22.7091 13.1147 22.4231 13.1147 22.1249V20.6247C13.1145 20.3265 12.996 20.0406 12.7853 19.8296C12.5745 19.6187 12.2887 19.5 11.9905 19.4995Z" fill="currentColor" />
												<path d="M4.49743 12.0023C4.49718 11.704 4.37865 11.4181 4.16785 11.2072C3.95705 10.9962 3.67119 10.8775 3.37298 10.8771H1.87445C1.57603 10.8771 1.28984 10.9956 1.07883 11.2066C0.867812 11.4176 0.749266 11.7038 0.749266 12.0023C0.749266 12.3007 0.867812 12.5869 1.07883 12.7979C1.28984 13.0089 1.57603 13.1274 1.87445 13.1274H3.37299C3.6712 13.127 3.95706 13.0083 4.16785 12.7973C4.37865 12.5864 4.49718 12.3005 4.49743 12.0023Z" fill="currentColor" />
												<path d="M11.9905 4.50058C12.2887 4.50012 12.5745 4.38141 12.7853 4.17048C12.9961 3.95954 13.1147 3.67361 13.1149 3.3754V1.87521C13.1149 1.57701 12.9965 1.29103 12.7856 1.08017C12.5748 0.869313 12.2888 0.750854 11.9906 0.750854C11.6924 0.750854 11.4064 0.869313 11.1955 1.08017C10.9847 1.29103 10.8662 1.57701 10.8662 1.87521V3.3754C10.8664 3.67359 10.9849 3.95952 11.1957 4.17046C11.4065 4.3814 11.6923 4.50012 11.9905 4.50058Z" fill="currentColor" />
												<path d="M18.8857 6.6972L19.9465 5.63642C20.0512 5.53209 20.1343 5.40813 20.1911 5.27163C20.2479 5.13513 20.2772 4.98877 20.2774 4.84093C20.2775 4.69309 20.2485 4.54667 20.192 4.41006C20.1355 4.27344 20.0526 4.14932 19.948 4.04478C19.8435 3.94024 19.7194 3.85734 19.5828 3.80083C19.4462 3.74432 19.2997 3.71531 19.1519 3.71545C19.0041 3.7156 18.8577 3.7449 18.7212 3.80167C18.5847 3.85845 18.4607 3.94159 18.3564 4.04633L17.2956 5.10714C17.1909 5.21147 17.1077 5.33543 17.0509 5.47194C16.9942 5.60844 16.9649 5.7548 16.9647 5.90264C16.9646 6.05048 16.9936 6.19689 17.0501 6.33351C17.1066 6.47012 17.1895 6.59425 17.294 6.69878C17.3986 6.80332 17.5227 6.88621 17.6593 6.94272C17.7959 6.99923 17.9424 7.02824 18.0902 7.02809C18.238 7.02795 18.3844 6.99865 18.5209 6.94187C18.6574 6.88509 18.7814 6.80195 18.8857 6.6972Z" fill="currentColor" />
												<path d="M18.8855 17.3073C18.7812 17.2026 18.6572 17.1195 18.5207 17.0627C18.3843 17.006 18.2379 16.9767 18.0901 16.9766C17.9423 16.9764 17.7959 17.0055 17.6593 17.062C17.5227 17.1185 17.3986 17.2014 17.2941 17.3059C17.1895 17.4104 17.1067 17.5345 17.0501 17.6711C16.9936 17.8077 16.9646 17.9541 16.9648 18.1019C16.9649 18.2497 16.9942 18.3961 17.0509 18.5326C17.1077 18.6691 17.1908 18.793 17.2955 18.8974L18.3563 19.9582C18.4606 20.0629 18.5846 20.146 18.721 20.2027C18.8575 20.2595 19.0039 20.2887 19.1517 20.2889C19.2995 20.289 19.4459 20.26 19.5825 20.2035C19.7191 20.147 19.8432 20.0641 19.9477 19.9595C20.0523 19.855 20.1351 19.7309 20.1916 19.5943C20.2482 19.4577 20.2772 19.3113 20.277 19.1635C20.2769 19.0157 20.2476 18.8694 20.1909 18.7329C20.1341 18.5964 20.051 18.4724 19.9463 18.3681L18.8855 17.3073Z" fill="currentColor" />
												<path d="M5.09528 17.3072L4.0345 18.368C3.92972 18.4723 3.84655 18.5963 3.78974 18.7328C3.73294 18.8693 3.70362 19.0156 3.70346 19.1635C3.7033 19.3114 3.7323 19.4578 3.78881 19.5944C3.84532 19.7311 3.92822 19.8552 4.03277 19.9598C4.13732 20.0643 4.26147 20.1472 4.3981 20.2037C4.53473 20.2602 4.68117 20.2892 4.82902 20.2891C4.97688 20.2889 5.12325 20.2596 5.25976 20.2028C5.39627 20.146 5.52024 20.0628 5.62456 19.958L6.68536 18.8973C6.79007 18.7929 6.87318 18.6689 6.92993 18.5325C6.98667 18.396 7.01595 18.2496 7.01608 18.1018C7.01621 17.954 6.98719 17.8076 6.93068 17.671C6.87417 17.5344 6.79129 17.4103 6.68676 17.3058C6.58224 17.2012 6.45813 17.1183 6.32153 17.0618C6.18494 17.0053 6.03855 16.9763 5.89073 16.9764C5.74291 16.9766 5.59657 17.0058 5.46007 17.0626C5.32358 17.1193 5.19962 17.2024 5.09528 17.3072Z" fill="currentColor" />
												<path d="M5.09541 6.69715C5.19979 6.8017 5.32374 6.88466 5.4602 6.94128C5.59665 6.9979 5.74292 7.02708 5.89065 7.02714C6.03839 7.0272 6.18469 6.99815 6.32119 6.94164C6.45769 6.88514 6.58171 6.80228 6.68618 6.69782C6.79064 6.59336 6.87349 6.46933 6.93 6.33283C6.9865 6.19633 7.01556 6.05003 7.01549 5.9023C7.01543 5.75457 6.98625 5.60829 6.92963 5.47184C6.87301 5.33539 6.79005 5.21143 6.6855 5.10706L5.6247 4.04626C5.5204 3.94137 5.39643 3.8581 5.25989 3.80121C5.12335 3.74432 4.97692 3.71493 4.82901 3.71472C4.68109 3.71452 4.53458 3.7435 4.39789 3.80001C4.26119 3.85652 4.13699 3.93945 4.03239 4.04404C3.9278 4.14864 3.84487 4.27284 3.78836 4.40954C3.73185 4.54624 3.70287 4.69274 3.70308 4.84066C3.70329 4.98858 3.73268 5.135 3.78957 5.27154C3.84646 5.40808 3.92974 5.53205 4.03462 5.63635L5.09541 6.69715Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<!--begin::Svg Icon | path: icons/duotune/general/gen061.svg-->
										<span class="svg-icon theme-dark-show svg-icon-2">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M19.0647 5.43757C19.3421 5.43757 19.567 5.21271 19.567 4.93534C19.567 4.65796 19.3421 4.43311 19.0647 4.43311C18.7874 4.43311 18.5625 4.65796 18.5625 4.93534C18.5625 5.21271 18.7874 5.43757 19.0647 5.43757Z" fill="currentColor" />
												<path d="M20.0692 9.48884C20.3466 9.48884 20.5714 9.26398 20.5714 8.98661C20.5714 8.70923 20.3466 8.48438 20.0692 8.48438C19.7918 8.48438 19.567 8.70923 19.567 8.98661C19.567 9.26398 19.7918 9.48884 20.0692 9.48884Z" fill="currentColor" />
												<path d="M12.0335 20.5714C15.6943 20.5714 18.9426 18.2053 20.1168 14.7338C20.1884 14.5225 20.1114 14.289 19.9284 14.161C19.746 14.034 19.5003 14.0418 19.3257 14.1821C18.2432 15.0546 16.9371 15.5156 15.5491 15.5156C12.2257 15.5156 9.48884 12.8122 9.48884 9.48886C9.48884 7.41079 10.5773 5.47137 12.3449 4.35752C12.5342 4.23832 12.6 4.00733 12.5377 3.79251C12.4759 3.57768 12.2571 3.42859 12.0335 3.42859C7.32556 3.42859 3.42857 7.29209 3.42857 12C3.42857 16.7079 7.32556 20.5714 12.0335 20.5714Z" fill="currentColor" />
												<path d="M13.0379 7.47998C13.8688 7.47998 14.5446 8.15585 14.5446 8.98668C14.5446 9.26428 14.7693 9.48891 15.0469 9.48891C15.3245 9.48891 15.5491 9.26428 15.5491 8.98668C15.5491 8.15585 16.225 7.47998 17.0558 7.47998C17.3334 7.47998 17.558 7.25535 17.558 6.97775C17.558 6.70015 17.3334 6.47552 17.0558 6.47552C16.225 6.47552 15.5491 5.76616 15.5491 4.93534C15.5491 4.65774 15.3245 4.43311 15.0469 4.43311C14.7693 4.43311 14.5446 4.65774 14.5446 4.93534C14.5446 5.76616 13.8688 6.47552 13.0379 6.47552C12.7603 6.47552 12.5357 6.70015 12.5357 6.97775C12.5357 7.25535 12.7603 7.47998 13.0379 7.47998Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</a>
									<!--begin::Menu toggle-->
									<!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-175px" data-kt-menu="true" data-kt-element="theme-mode-menu">
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen060.svg-->
													<span class="svg-icon svg-icon-3">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M11.9905 5.62598C10.7293 5.62574 9.49646 5.9995 8.44775 6.69997C7.39903 7.40045 6.58159 8.39619 6.09881 9.56126C5.61603 10.7263 5.48958 12.0084 5.73547 13.2453C5.98135 14.4823 6.58852 15.6185 7.48019 16.5104C8.37186 17.4022 9.50798 18.0096 10.7449 18.2557C11.9818 18.5019 13.2639 18.3757 14.429 17.8931C15.5942 17.4106 16.5901 16.5933 17.2908 15.5448C17.9915 14.4962 18.3655 13.2634 18.3655 12.0023C18.3637 10.3119 17.6916 8.69129 16.4964 7.49593C15.3013 6.30056 13.6808 5.62806 11.9905 5.62598Z" fill="currentColor" />
															<path d="M22.1258 10.8771H20.627C20.3286 10.8771 20.0424 10.9956 19.8314 11.2066C19.6204 11.4176 19.5018 11.7038 19.5018 12.0023C19.5018 12.3007 19.6204 12.5869 19.8314 12.7979C20.0424 13.0089 20.3286 13.1274 20.627 13.1274H22.1258C22.4242 13.1274 22.7104 13.0089 22.9214 12.7979C23.1324 12.5869 23.2509 12.3007 23.2509 12.0023C23.2509 11.7038 23.1324 11.4176 22.9214 11.2066C22.7104 10.9956 22.4242 10.8771 22.1258 10.8771Z" fill="currentColor" />
															<path d="M11.9905 19.4995C11.6923 19.5 11.4064 19.6187 11.1956 19.8296C10.9848 20.0405 10.8663 20.3265 10.866 20.6247V22.1249C10.866 22.4231 10.9845 22.7091 11.1953 22.9199C11.4062 23.1308 11.6922 23.2492 11.9904 23.2492C12.2886 23.2492 12.5746 23.1308 12.7854 22.9199C12.9963 22.7091 13.1147 22.4231 13.1147 22.1249V20.6247C13.1145 20.3265 12.996 20.0406 12.7853 19.8296C12.5745 19.6187 12.2887 19.5 11.9905 19.4995Z" fill="currentColor" />
															<path d="M4.49743 12.0023C4.49718 11.704 4.37865 11.4181 4.16785 11.2072C3.95705 10.9962 3.67119 10.8775 3.37298 10.8771H1.87445C1.57603 10.8771 1.28984 10.9956 1.07883 11.2066C0.867812 11.4176 0.749266 11.7038 0.749266 12.0023C0.749266 12.3007 0.867812 12.5869 1.07883 12.7979C1.28984 13.0089 1.57603 13.1274 1.87445 13.1274H3.37299C3.6712 13.127 3.95706 13.0083 4.16785 12.7973C4.37865 12.5864 4.49718 12.3005 4.49743 12.0023Z" fill="currentColor" />
															<path d="M11.9905 4.50058C12.2887 4.50012 12.5745 4.38141 12.7853 4.17048C12.9961 3.95954 13.1147 3.67361 13.1149 3.3754V1.87521C13.1149 1.57701 12.9965 1.29103 12.7856 1.08017C12.5748 0.869313 12.2888 0.750854 11.9906 0.750854C11.6924 0.750854 11.4064 0.869313 11.1955 1.08017C10.9847 1.29103 10.8662 1.57701 10.8662 1.87521V3.3754C10.8664 3.67359 10.9849 3.95952 11.1957 4.17046C11.4065 4.3814 11.6923 4.50012 11.9905 4.50058Z" fill="currentColor" />
															<path d="M18.8857 6.6972L19.9465 5.63642C20.0512 5.53209 20.1343 5.40813 20.1911 5.27163C20.2479 5.13513 20.2772 4.98877 20.2774 4.84093C20.2775 4.69309 20.2485 4.54667 20.192 4.41006C20.1355 4.27344 20.0526 4.14932 19.948 4.04478C19.8435 3.94024 19.7194 3.85734 19.5828 3.80083C19.4462 3.74432 19.2997 3.71531 19.1519 3.71545C19.0041 3.7156 18.8577 3.7449 18.7212 3.80167C18.5847 3.85845 18.4607 3.94159 18.3564 4.04633L17.2956 5.10714C17.1909 5.21147 17.1077 5.33543 17.0509 5.47194C16.9942 5.60844 16.9649 5.7548 16.9647 5.90264C16.9646 6.05048 16.9936 6.19689 17.0501 6.33351C17.1066 6.47012 17.1895 6.59425 17.294 6.69878C17.3986 6.80332 17.5227 6.88621 17.6593 6.94272C17.7959 6.99923 17.9424 7.02824 18.0902 7.02809C18.238 7.02795 18.3844 6.99865 18.5209 6.94187C18.6574 6.88509 18.7814 6.80195 18.8857 6.6972Z" fill="currentColor" />
															<path d="M18.8855 17.3073C18.7812 17.2026 18.6572 17.1195 18.5207 17.0627C18.3843 17.006 18.2379 16.9767 18.0901 16.9766C17.9423 16.9764 17.7959 17.0055 17.6593 17.062C17.5227 17.1185 17.3986 17.2014 17.2941 17.3059C17.1895 17.4104 17.1067 17.5345 17.0501 17.6711C16.9936 17.8077 16.9646 17.9541 16.9648 18.1019C16.9649 18.2497 16.9942 18.3961 17.0509 18.5326C17.1077 18.6691 17.1908 18.793 17.2955 18.8974L18.3563 19.9582C18.4606 20.0629 18.5846 20.146 18.721 20.2027C18.8575 20.2595 19.0039 20.2887 19.1517 20.2889C19.2995 20.289 19.4459 20.26 19.5825 20.2035C19.7191 20.147 19.8432 20.0641 19.9477 19.9595C20.0523 19.855 20.1351 19.7309 20.1916 19.5943C20.2482 19.4577 20.2772 19.3113 20.277 19.1635C20.2769 19.0157 20.2476 18.8694 20.1909 18.7329C20.1341 18.5964 20.051 18.4724 19.9463 18.3681L18.8855 17.3073Z" fill="currentColor" />
															<path d="M5.09528 17.3072L4.0345 18.368C3.92972 18.4723 3.84655 18.5963 3.78974 18.7328C3.73294 18.8693 3.70362 19.0156 3.70346 19.1635C3.7033 19.3114 3.7323 19.4578 3.78881 19.5944C3.84532 19.7311 3.92822 19.8552 4.03277 19.9598C4.13732 20.0643 4.26147 20.1472 4.3981 20.2037C4.53473 20.2602 4.68117 20.2892 4.82902 20.2891C4.97688 20.2889 5.12325 20.2596 5.25976 20.2028C5.39627 20.146 5.52024 20.0628 5.62456 19.958L6.68536 18.8973C6.79007 18.7929 6.87318 18.6689 6.92993 18.5325C6.98667 18.396 7.01595 18.2496 7.01608 18.1018C7.01621 17.954 6.98719 17.8076 6.93068 17.671C6.87417 17.5344 6.79129 17.4103 6.68676 17.3058C6.58224 17.2012 6.45813 17.1183 6.32153 17.0618C6.18494 17.0053 6.03855 16.9763 5.89073 16.9764C5.74291 16.9766 5.59657 17.0058 5.46007 17.0626C5.32358 17.1193 5.19962 17.2024 5.09528 17.3072Z" fill="currentColor" />
															<path d="M5.09541 6.69715C5.19979 6.8017 5.32374 6.88466 5.4602 6.94128C5.59665 6.9979 5.74292 7.02708 5.89065 7.02714C6.03839 7.0272 6.18469 6.99815 6.32119 6.94164C6.45769 6.88514 6.58171 6.80228 6.68618 6.69782C6.79064 6.59336 6.87349 6.46933 6.93 6.33283C6.9865 6.19633 7.01556 6.05003 7.01549 5.9023C7.01543 5.75457 6.98625 5.60829 6.92963 5.47184C6.87301 5.33539 6.79005 5.21143 6.6855 5.10706L5.6247 4.04626C5.5204 3.94137 5.39643 3.8581 5.25989 3.80121C5.12335 3.74432 4.97692 3.71493 4.82901 3.71472C4.68109 3.71452 4.53458 3.7435 4.39789 3.80001C4.26119 3.85652 4.13699 3.93945 4.03239 4.04404C3.9278 4.14864 3.84487 4.27284 3.78836 4.40954C3.73185 4.54624 3.70287 4.69274 3.70308 4.84066C3.70329 4.98858 3.73268 5.135 3.78957 5.27154C3.84646 5.40808 3.92974 5.53205 4.03462 5.63635L5.09541 6.69715Z" fill="currentColor" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title">{{__('siderbar.light')}}</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen061.svg-->
													<span class="svg-icon svg-icon-3">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M19.0647 5.43757C19.3421 5.43757 19.567 5.21271 19.567 4.93534C19.567 4.65796 19.3421 4.43311 19.0647 4.43311C18.7874 4.43311 18.5625 4.65796 18.5625 4.93534C18.5625 5.21271 18.7874 5.43757 19.0647 5.43757Z" fill="currentColor" />
															<path d="M20.0692 9.48884C20.3466 9.48884 20.5714 9.26398 20.5714 8.98661C20.5714 8.70923 20.3466 8.48438 20.0692 8.48438C19.7918 8.48438 19.567 8.70923 19.567 8.98661C19.567 9.26398 19.7918 9.48884 20.0692 9.48884Z" fill="currentColor" />
															<path d="M12.0335 20.5714C15.6943 20.5714 18.9426 18.2053 20.1168 14.7338C20.1884 14.5225 20.1114 14.289 19.9284 14.161C19.746 14.034 19.5003 14.0418 19.3257 14.1821C18.2432 15.0546 16.9371 15.5156 15.5491 15.5156C12.2257 15.5156 9.48884 12.8122 9.48884 9.48886C9.48884 7.41079 10.5773 5.47137 12.3449 4.35752C12.5342 4.23832 12.6 4.00733 12.5377 3.79251C12.4759 3.57768 12.2571 3.42859 12.0335 3.42859C7.32556 3.42859 3.42857 7.29209 3.42857 12C3.42857 16.7079 7.32556 20.5714 12.0335 20.5714Z" fill="currentColor" />
															<path d="M13.0379 7.47998C13.8688 7.47998 14.5446 8.15585 14.5446 8.98668C14.5446 9.26428 14.7693 9.48891 15.0469 9.48891C15.3245 9.48891 15.5491 9.26428 15.5491 8.98668C15.5491 8.15585 16.225 7.47998 17.0558 7.47998C17.3334 7.47998 17.558 7.25535 17.558 6.97775C17.558 6.70015 17.3334 6.47552 17.0558 6.47552C16.225 6.47552 15.5491 5.76616 15.5491 4.93534C15.5491 4.65774 15.3245 4.43311 15.0469 4.43311C14.7693 4.43311 14.5446 4.65774 14.5446 4.93534C14.5446 5.76616 13.8688 6.47552 13.0379 6.47552C12.7603 6.47552 12.5357 6.70015 12.5357 6.97775C12.5357 7.25535 12.7603 7.47998 13.0379 7.47998Z" fill="currentColor" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title">{{__('siderbar.dark')}}</span>
											</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
								</div>
								<!--end::Theme mode-->
								<!--begin::User menu-->
								<div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
									<!--begin::Menu wrapper-->
									<div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="{{dropdown_direction('bottom-end')}}">
										<img src="{{ asset('images/favicon.png') }}" alt="user" />
									</div>
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{ asset('images/favicon.png') }}" />
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">{{auth()->user()->full_name}}
                                                        <!-- <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Admin</span> -->
                                                    </div>
													<a href="{{ route('admin.admins.edit',auth()->user()->id) }}" class="fw-semibold text-muted text-hover-primary fs-7">{{auth()->guard('admin')->user()->email}}</a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="@if(isAdmin()){{ route('admin.admins.edit',auth()->guard('admin')->user()->id) }}@else{{ route('admin.profile') }}@endif" class="menu-link px-5">{{__('siderbar.my_profile')}}</a>
										</div>
										<!--end::Menu item-->
                                        <!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="{{route('admin.admins.edit_password',auth()->guard('admin')->user()->id)}}" class="menu-link px-5">{{__('common.Change Password')}}</a>
										</div>
										<!--end::Menu item-->
                                        <!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="{{ route('admin.logout') }}" class="menu-link px-5">{{__('siderbar.sign_out')}}</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::User menu-->
								<!--begin::Header menu toggle-->
								<div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
									<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
										<!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
										<span class="svg-icon svg-icon-1">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="currentColor" />
												<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
								</div>
								<!--end::Header menu toggle-->
							</div>
							<!--end::Navbar-->
						</div>
						<!--end::Header wrapper-->
					</div>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
						<!--begin::Logo-->
						<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
							<!--begin::Logo image-->
							<a href="/admin">
								<img src="{{asset('images/logo-white.png')}}" alt="{{env('APP_NAME')}}" style="height: 56px;" class="app-sidebar-logo-default" />
							</a>
							<!--end::Logo image-->
							<!--begin::Sidebar toggle-->
							<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
								<span class="svg-icon svg-icon-2 rotate-180">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
										<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Sidebar toggle-->
						</div>
						<!--end::Logo-->
						<!--begin::sidebar menu-->
						<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
							<!--begin::Menu wrapper-->
							<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
								<!--begin::Menu-->
								<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                                    {{-- <!--begin:Dashboard-->
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="click" class="menu-item @if(in_array($uri1,['reports'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">{{__('siderbar.dashboards')}}</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
											<div class="menu-item @if(in_array($uri1,['reports', 'home'])) show @endif">
												<!--begin:Menu link-->
												<a class="menu-link " href="{{route('admin.reports.index')}}">
													<span class="menu-bullet">
														<span class="fa fa-bar-chart"></span>
													</span>
													<span class="menu-title">{{__('siderbar.reports')}}</span>
												</a>
												<!--end:Menu link-->
											</div>
											<!--end:Menu item-->
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									<!--end:Dashboard-->

									<!--begin:Bookings-->
									<!--begin:Menu item-->
									<div class="menu-item @if(in_array($uri1,['bookings'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route('admin.bookings.index')}}">
											<span class="menu-icon">
												<span class="fa fa-ticket"></span>
											</span>
											<span class="menu-title">Bookings</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Bookings-->

									<!--begin:Accommodations-->
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="click" class="menu-item @if(in_array($uri1,['accommodations'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<span class="fa fa-building-wheat"></span>
											</span>
											<span class="menu-title">{{ __('siderbar.accommodations') }}</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion">
											@if(isAdmin())
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['accommodations']) && in_array(request('type'),['apartments'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.accommodations.index')}}?type=apartments">
														<span class="menu-bullet">
															<i class="fa-regular fa-building"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.apartments') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['accommodations']) && in_array(request('type'),['villas'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.accommodations.index')}}?type=villas">
														<span class="menu-bullet">
															<i class="fa-solid fa-house"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.villas') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['accommodations']) && in_array(request('type'),['rooms'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.accommodations.index')}}?type=rooms">
														<span class="menu-bullet">
															<i class="fa-solid fa-person-shelter"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.rooms') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
											@endif
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									<!--end:Accommodations-->
									
									
									<!--begin:Events-->
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="click" class="menu-item @if(in_array($uri1,['events', 'event_types'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<span class="fa fa-umbrella-beach"></span>
											</span>
											<span class="menu-title">{{ __('siderbar.events') }}</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion">
											@if(isAdmin())
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['events'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.events.index')}}">
														<span class="menu-bullet">
															<i class="fa-solid fa-umbrella-beach"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.events') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['event_types'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.event_types.index')}}">
														<span class="menu-bullet">
															<i class="fa-solid fa-snowflake"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.event_types') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
											@endif
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									<!--end:Events--> --}}
									
									<!--begin:Categories-->
									<!--begin:Menu item-->
									@php $menu_item = 'clients'; @endphp
									<div class="menu-item @if(in_array($uri1,[$menu_item])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route("admin.$menu_item.index")}}">
											<span class="menu-icon">
												<i class="fa-solid fa-gift"></i>
											</span>
											<span class="menu-title">{{ __("siderbar.$menu_item") }}</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Categories-->

									<!--begin:Categories-->
									<!--begin:Menu item-->
									{{-- @php $menu_item = 'products'; @endphp
									<div class="menu-item @if(in_array($uri1,[$menu_item])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route("admin.$menu_item.index")}}">
											<span class="menu-icon">
												<i class="fa-solid fa-gift"></i>
											</span>
											<span class="menu-title">{{ __("siderbar.$menu_item") }}</span>
										</a>
										<!--end:Menu link-->
									</div> --}}
									<!--end:Menu item-->
									<!--end:Categories-->
{{-- 
									<!--begin:Options-->
									<!--begin:Menu item-->
									@php $menu_item = 'options'; @endphp
									<div class="menu-item @if(in_array($uri1,[$menu_item])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route("admin.$menu_item.index")}}">
											<span class="menu-icon">
												<i class="fa-solid fa-cart-plus"></i>
											</span>
											<span class="menu-title">{{ __("siderbar.$menu_item") }}</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Options-->

									<!--begin:Durations-->
									<!--begin:Menu item-->
									@php $menu_item = 'durations'; @endphp
									<div class="menu-item @if(in_array($uri1,[$menu_item])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route("admin.$menu_item.index")}}">
											<span class="menu-icon">
												<i class="fa-solid fa-clock"></i>
											</span>
											<span class="menu-title">{{ __("siderbar.$menu_item") }}</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Durations-->

									<!--begin:Locations-->
									<!--begin:Menu item-->
									@php $menu_item = 'locations'; @endphp
									<div class="menu-item @if(in_array($uri1,[$menu_item])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route("admin.$menu_item.index")}}">
											<span class="menu-icon">
												<i class="fa-solid fa-map"></i>
											</span>
											<span class="menu-title">{{ __("siderbar.$menu_item") }}</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Locations-->

									<!--begin:Users-->
									<!--begin:Menu item-->
									<div class="menu-item @if(in_array($uri1,['users'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route('admin.users.index')}}">
											<span class="menu-icon">
												<span class="fa fa-users"></span>
											</span>
											<span class="menu-title">Users</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Users-->
									
									<!--begin:Employees-->
									<!--begin:Menu item-->
									<div class="menu-item @if(in_array($uri1,['employees'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{route('admin.employees.index')}}">
											<span class="menu-icon">
												<span class="fa fa-user-nurse"></span>
											</span>
											<span class="menu-title">Employees</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									<!--end:Employees-->

									<!--begin:Tags-->
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="click" class="menu-item @if(in_array($uri1,['tags'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<span class="fa fa-tag"></span>
											</span>
											<span class="menu-title">{{ __('siderbar.tags') }}</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion">
											@if(isAdmin())
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['tags']) && in_array(request('type'),['amenities'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.tags.index')}}?type=amenities">
														<span class="menu-bullet">
															<i class="fa-regular fa-hashtag"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.amenities') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['tags']) && in_array(request('type'),['details'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.tags.index')}}?type=details">
														<span class="menu-bullet">
															<i class="fa-solid fa-circle-info"></i>
														</span>
														<span class="menu-title">{{ __('siderbar.details') }}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
											@endif
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									<!--end:Tags--> --}}

									@if(isAdmin())
									<!--begin:Customer Service-->
									<!--begin:Menu item-->
									{{-- <div data-kt-menu-trigger="click" class="menu-item @if(in_array($uri1,[ 'inbox', 'viewMessage'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<span class="fa fa-address-book"></span>
											</span>
											<span class="menu-title">{{__('siderbar.customer_service')}}</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
											<div class="menu-item @if(in_array($uri1,['inbox', 'viewMessage'])) show @endif">
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['inbox', 'viewMessage'])) show @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.inbox')}}">
														<span class="menu-icon fas fa-envelope icon-lg"></span>
														<span class="menu-title">{{__('siderbar.inbox')}}</span>
														@if($inbox>0) 
															<span style="" class="badge badge-danger">{{$inbox}}</span>
														@endif
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
											</div>
											<!--end:Menu item-->
										</div>
										<!--end:Menu sub-->
									</div> --}}
									<!--end:Menu item-->
									<!--end:Customer Service-->
									
									<!--begin:System Management-->
									<!--begin:Menu item-->
									<div data-kt-menu-trigger="click" class="menu-item @if(in_array($uri1,['settings', 'admins'])) show @endif menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">{{__('siderbar.system_management')}}</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
											<div class="menu-item @if(in_array($uri1,[ 'settings', 'admins'])) show @endif">

												{{-- <!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['settings'])) show here @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.settings.index')}}">
														<span class="menu-icon fas fa-cogs
														icon-lg"></span>
														<span class="menu-title">{{__('common.settings')}}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item--> --}}
												
												<!--begin:Menu item-->
												<div class="menu-item @if(in_array($uri1,['admins'])) show here @endif">
													<!--begin:Menu link-->
													<a class="menu-link" href="{{route('admin.admins.index')}}">
														<span class="menu-icon fas fa-user-nurse icon-lg"></span>
														<span class="menu-title">{{__('siderbar.admins')}}</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->

											</div>
											<!--end:Menu item-->
										</div>
										<!--end:Menu sub-->
									</div>
									<!--end:Menu item-->
									<!--end:System Management-->

									@endif

								</div>
								<!--end::Menu-->
							</div>
							<!--end::Menu wrapper-->
						</div>
						<!--end::sidebar menu-->
					</div>
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Toolbar-->
							<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
								<!--begin::Toolbar container-->
								<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
									<!--begin::Page title-->
									<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
										<!--begin::Title-->
										<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">@yield('title')</h1>
										<!--end::Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">
												<a href="{{url('/admin/home')}}" class="text-muted text-hover-primary">{{__('common.control_panel')}}</a>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<!--end::Item-->
											@hasSection ('prevTitle') 
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">
												@yield('prevTitle')
											</li>
											<!--end::Item-->
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											@endif
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">
												@yield('title')
											</li>
											<!--end::Item-->
										</ul>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Page title-->
                                    @yield('filter')
								</div>
								<!--end::Toolbar container-->
							</div>
							<!--end::Toolbar-->
							<!--begin::Content-->
                            <div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
                                    <div class="@yield('no_white_bg', 'card') mb-8">
                                        <div class="card-body @yield('no_white_bg', 'pt-9') pb-0">
											@if (count($errors) > 0)
													@foreach ($errors->all() as $key => $error)
														<div class="alert alert-danger" role="alert">{{$error}}</div>
													@endforeach
											@endif
											@if (session('status'))
												<div class="alert alert-success success-msg-alert" role="alert">{{  session('status')  }}!</div>
											@endif
                                            @yield('content')
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						<div id="kt_app_footer" class="app-footer realfooter">
							<!--begin::Footer container-->
							<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">{{date("Y")}}&copy;</span>
									<a href="{{url('')}}" target="_blank" class="text-gray-800 text-hover-primary">{{env('APP_NAME')}}</a>
								</div>
								@if(isCompany())
									<div class="text-dark order-2 order-md-1">
										<a href="{{url('')}}" target="_blank" class="text-gray-800 text-hover-primary"><img src="{{Auth::user()->image_url}}" style="height:60px;" id="editImage"></a>
									</div>
								@endif
								<!--end::Copyright-->
							</div>
							<!--end::Footer container-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<div id="loading"><img src="{{asset('images/loading.gif')}}" alt="Loading" /></div>
		<!--end::Modal - Invite Friend-->
        <!--start::Modals-->
            <div id="errors-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{__('common.error')}}</h4>
                        </div>
                        <div class="modal-body">
                            <p class="modal-errors-content"></p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('common.ok')}}</button>
                        </div>
                    </div>
                </div>
            </div>
		<!--end::Modals-->
		<!--begin::Javascript-->
        <script src="{{admin_assets('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{admin_assets('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{admin_assets('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="{{admin_assets('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="{{admin_assets('global/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
		<script src="{{admin_assets('assets/plugins/custom/leaflet/leaflet.bundle.js')}}"></script>
		<script src="{{admin_assets('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{admin_assets('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
		<script src="{{admin_assets('assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
		<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
		<script src="{{admin_assets('assets/js/livewire-component.js')}}"></script>
		<script src="{{admin_assets('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/widgets.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/utilities/modals/create-app.js')}}"></script>
			
		<script src="{{admin_assets('assets/js/custom/utilities/modals/new-target.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/utilities/modals/users-search.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/utilities/modals/select-location.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/apps/subscriptions/list/list.js')}}"></script>
		<script src="{{admin_assets('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
		{{-- <script src="{{admin_assets('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script> --}}
		{{-- <script src="{{admin_assets('assets/js/custom/apps/user-management/users/list/add.js')}}"></script> --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<!--end::Custom Javascript-->
        <script>
			$(".back_to_admin").click(function (){
				$("#loading").show();
			})

			function formatNumber(number) {
				if (isNaN(number)) {
					return 'Invalid number';
				}

				var numString = String(number);
				var parts = numString.split('.');
				var integer_part = parts[0];
				var decimal_part = parts[1] ? '.' + parts[1] : '';

				var formatted_integer_part = '';
				var length = integer_part.length;
				for (var i = 0; i < length; i++) {
					formatted_integer_part += integer_part.charAt(i);
					if ((length - i - 1) % 3 === 0 && i !== length - 1) {
					formatted_integer_part += '\'';
					}
				}

				return formatted_integer_part + decimal_part;
			}

            $(".pick_date").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: false,
                    // auto{{__('common.apply')}}: true,
                    minYear: 2019,
                    maxYear: parseInt(moment().format("YYYY"),12),
					locale: {
						format: 'DD/MM/YYYY'
					}
                }
            ); 
			
			$(".date_with_time").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: false,
                    // auto{{__('common.apply')}}: true,
                    minYear: 2020,
                    maxYear: parseInt(moment().format("YYYY"),12),
					timePicker: true,
					locale: {
						format: 'DD/MM/YYYY hh:mm A'
					}
                }
            );

			$(".date_with_time").on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY hh:mm A'));
            });
            

            $(".pick_date").on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
            });
            
            $(".daterangepicker").click( function(e) {
                e.stopPropagation();
            });
            
            $(document).ready(function() {
				if ($("#kt_table_accounts")[0]){
					handleSearchDatatable();
				}
				$(".basic-hide-search").select2({minimumResultsForSearch: -1});
            });

            $("#kt_datatable_zero_configuration").DataTable();
			dt = $("#kt_table_accounts").DataTable({ });

			var handleSearchDatatable = function () {
				const filterSearch = document.querySelector('[data-kt-accounts-table-filter="search"]');
				filterSearch.addEventListener('keyup', function (e) {
					// console.log(123);
					dt.search(e.target.value).draw();
				});
			}

			
			function check(){
				KTMenu.createInstances();
			}
        </script>
		<!--end::Javascript-->
		@livewireScripts
		<script>
			const optionFormat = (item) => {
				if (!item.id) {
					return item.text;
				}

				var span = document.createElement('span');
				var template = '';

				template += '<div class="d-flex align-items-center">';
				template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') +
					'" class="h-40px me-3" alt="' + item.text + '"/>';
				template += '<div class="d-flex flex-column">'
				template += '<span class="fs-4 fw-bold lh-1">' + item.text + '</span>';
				template += '<span class="text-muted fs-5">' + item.element.getAttribute(
					'data-kt-rich-content-subcontent') + '</span>';
				template += '</div>';
				template += '</div>';

				span.innerHTML = template;

				return $(span);
			}
			// Init Select2 --- more info: https://select2.org/
			$('.select2-icons').select2({
				placeholder: "Select an icon",
				// minimumResultsForSearch: Infinity, // To disable searching
				templateSelection: optionFormat,
				templateResult: optionFormat
			});
		</script>
		{{-- CKEditor --}}
		<script>
			tinymce.init({
				selector: "textarea.kt_docs_tinymce_hidden",
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
		{{-- Date Time Picker --}}
		<script>
			$(".date-input").flatpickr({
				enableTime: false,
				dateFormat: window?.date_input_format ? window.date_input_format : "Y-m-d",
			});
			$(".time-input").flatpickr({
				enableTime: true,
				noCalendar: true,
				dateFormat: window?.time_input_format ? window.time_input_format : "H:i",
			});
			$(".date-time-input").flatpickr({
				enableTime: true,
				dateFormat: window?.date_time_input_format ? window.date_time_input_format : "Y-m-d H:i",
			});
		</script>
		{{-- Date Time Picker --}}
		@yield('script')
		@stack('js')
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
	</body>
	<!--end::Body-->
</html>