<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Divota</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Divota Dashboard" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <!-- END GLOBAL MANDATORY STYLES -->
    {{-- <link href="{{admin_assets('global/css/components.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/> --}}
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{admin_assets('pages/css/login-3.min.css')}}" rel="stylesheet" type="text/css"/>
    @if (app()->getLocale() == 'ar')
            <link href="{{ admin_assets('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ admin_assets('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
                  type="text/css" />
            {{-- <link href="{{ admin_assets('assets/css/custom-rtl.css') }}" rel="stylesheet" type="text/css" /> --}}
      @else
            <link href="{{ admin_assets('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ admin_assets('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
            {{-- <link href="{{ admin_assets('assets/css/custom.css') }}" rel="stylesheet" type="text/css" /> --}}
      @endif
    {{-- <link href="{{admin_assets('layouts/layout4/css/custom.css')}}" rel="stylesheet" type="text/css"/> --}}

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <div style="display: none" id="loading"><img src="{{asset('images/loading.gif')}}" alt="Loading" /></div>
    <link rel="icon" href="{{asset('images/favicon.png')}}"/>
      <style>
            .btn{
                  background-color: #BEAC39;
                  border-color:#BEAC39;
            }

            body{
                  background-color: #333;
            }
            #loading {
                  display: none;
                  position: fixed;
                  margin: auto;
                  top: 0;
                  right: 0;
                  bottom: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  background-color: #ccc;
                  opacity: 0.5;
                  border-radius: 3px;
                  z-index: 111111;
            }
            #loading img{
                  position: fixed;
                  margin: auto;
                  top: 0;
                  right: 0;
                  bottom: 0;
                  left: 0;
                  /*  width: 50px;
                  height: 50px;*/
                  border-radius: 3px;
                  z-index: 1111111;
            }

      </style>
</head>
<!-- END HEAD -->
{{-- <body style="background-color: #333 !important;"> --}}
@yield('content')
{{-- </body> --}}
</html>