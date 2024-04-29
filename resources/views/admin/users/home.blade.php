@extends('layout.adminLayout')
@php
    $page_name = 'users';
@endphp
@section('pageTitle')
    {{ ucwords(__('siderbar.' . $page_name)) }}
@endsection
@section('title')
    {{ ucwords(__('siderbar.' . $page_name)) }}
@endsection
@section('css')
    <style>
    </style>
@endsection
@section('no_white_bg')
@endsection
@section('content')
    <div style="display: block" id="loading"><img src="{{ asset('images/loading.gif') }}" alt="Loading" /></div>
    <div class="portlet light bordered">
        <div class="portlet-body row">
            <!--begin::Search-->
            <div class="col-md-4">
                <!--begin::Users-->
                @livewire('users.users-list')
                <!--end::Users-->
            </div>
            <!--end::Search-->
            <!--begin::Content-->
            <div class="col-xl-6">
                <!--begin::Edit User-->
                @livewire('users.edit-user', ['id' => $id ?? null, 'mode' => $mode ?? ''])
                <!--end::Edit User-->
            </div>
            <!--end::Content-->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#loading').hide();
    </script>
@endsection
