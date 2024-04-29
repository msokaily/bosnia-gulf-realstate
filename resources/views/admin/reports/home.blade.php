@extends('layout.adminLayout')
@php
    $page_name = 'Menu Settings';
@endphp
@section('pageTitle') 
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
@section('title') 
    {{ucwords(__('siderbar.'.$page_name))}}
@endsection
@section('filter') 
    <!--begin::Actions-->
    <!--end::Actions-->
@endsection
@section('css')
@endsection
@section('content')
<div class="portlet light bordered">
    @if(isAdmin())
        <div class="portlet-body">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10" style="height: auto;">
                <!--begin::Row-->
                <h3>{{__('siderbar.settings')}}</h3>
                <!--end::Row-->
            </div>
        </div>
    @endif
</div>
@endsection