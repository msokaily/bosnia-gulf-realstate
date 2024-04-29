@extends('layout.adminLayout')
@php
    $page_name = 'users';
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
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{__('common.add')}}{{__('siderbar.'.$page_name)}}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="portlet-body ">
                    <form  autocomplete="off" id="form_category" method="post" action="{{route('admin.'.$page_name.'.store')}}"
                        enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body form card-body border-top p-9">
                            @if(isAdmin())
                                <fieldset class="mt-5">
                                    <div class="input-group input-group-solid mb-5">
                                        <label class="col-sm-2 control-label" for="company">
                                            {{__('common.company')}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <select required data-control="select2" id="company_id" name="company_id" class="form-select form-select-solid">
                                                <option value="">{{__('common.select')}}</option>
                                                @foreach($companies as $one)
                                                    <option @if (old('company_id') === $one->id) selected @endif value="{{$one->id}}"> {{$one->first_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            @endif
                            @php
                            $translations = ['en', 'ar'];
                            $attributes = ['first_name', 'father_name', 'last_name'];
                            @endphp
                            
                            @foreach ($translations as $locale)
                                @foreach ($attributes as $attribute)
                                    <fieldset class="mt-5">
                                        <div class="input-group input-group-solid mb-5">
                                            <label class="col-sm-2 control-label" for="{{ $attribute }}_{{ $locale }}">
                                                {{ __('common.' . $attribute) }} ({{ strtoupper($locale) }})
                                                <span class="symbol">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input autocomplete="off" required id="{{ $attribute }}_{{ $locale }}" type="text" name="{{ $attribute }}[{{ $locale }}]" class="form-control" placeholder="{{ __('common.' . $attribute) }}" value="{{ old($attribute . '.' . $locale) }}">
                                            </div>
                                        </div>
                                    </fieldset>
                                @endforeach
                            @endforeach
                            <hr>
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="id_type">
                                        {{__('common.id_type')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select required data-control="select2" id="id_type" name="id_type" class="form-select form-select-solid">
                                            <option value="">{{__('common.select')}}</option>
                                            @foreach($id_types as $one)
                                                <option @if ($one->id === old('id_type')) selected @endif value="{{$one->id}}"> {{$one->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="id_number">
                                        {{__('common.id_number')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required title="Please enter numbers only" pattern="[0-9]*" inputmode="numeric"  id="id_number" type="text" name="id_number" class="form-control"
                                            placeholder="{{__('common.id_number')}}" value="{{ old('id_number') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="phone">
                                        {{__('common.phone')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required title="Please enter numbers only" pattern="[0-9]*" inputmode="numeric"  id="phone" type="text" name="phone" class="form-control"
                                            placeholder="{{__('common.phone')}}" value="{{ old('phone') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="whatsapp">
                                        {{__('common.whatsapp')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required title="Please enter numbers only" pattern="[0-9]*" inputmode="numeric"  id="whatsapp" type="text" name="whatsapp" class="form-control"
                                            placeholder="{{__('common.whatsapp')}}" value="{{ old('whatsapp') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="email">
                                        {{__('common.email')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required id="email" type="email" name="email" class="form-control" placeholder="{{__('common.email')}}"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="username">
                                        {{__('common.username')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required id="username" type="text" name="username" class="form-control" placeholder="{{__('common.username')}}" value="{{ old('username') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="password">
                                        {{__('common.password')}}
                                        <span class="symbol">*</span>
                                        <span style="color: red" class="symbol">{{__('common.leave_empty_nochange')}}</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required id="password" type="password" name="password" class="form-control" placeholder="{{__('common.password')}}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="date_of_birth">
                                        {{__('common.date_of_birth')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" required id="date_of_birth" type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.gender')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <select required data-control="select2" id="gender" name="gender" class="form-select form-select-solid">
                                            <option value="">{{__('common.select')}}</option>
                                            <option @if (old('gender') === 'Male') selected @endif value="Male">{{__('common.male')}}</option>
                                            <option @if (old('gender') === 'Female') selected @endif value="Female">{{__('common.female')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.marital_status')}}</label>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <select data-control="select2" id="marital_status" name="marital_status" class="form-select form-select-solid">
                                            <option value="">{{__('common.select')}}</option>
                                            <option @if (old('marital_status') === 'Married') selected @endif value="Married">{{__('common.married')}}</option>
                                            <option @if (old('marital_status') === 'Widow') selected @endif value="Widow">{{__('common.widow')}}</option>
                                            <option @if (old('marital_status') === 'Divorced') selected @endif value="Divorced">{{__('common.divorced')}}</option>
                                            <option @if (old('marital_status') === 'Single') selected @endif value="Single">{{__('common.single')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.breadwinner')}}</label>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input autocomplete="off" @if (old('breadwinner') === "Yes") checked @endif class="form-check-input w-45px h-30px" type="checkbox" id="breadwinner" name="breadwinner">
                                            <label class="form-check-label" for="breadwinner"></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.residence_status')}}</label>
                                    <div class="col-lg-6">
                                        <select data-control="select2" id="residence_status" name="residence_status" class="form-select form-select-solid">
                                            <option value="">{{__('common.select')}}</option>
                                            <option @if (old('residence_status') === 'Displaced') selected @endif value="Displaced">{{__('common.displaced')}}</option>
                                            <option @if (old('residence_status') === 'Resident') selected @endif value="Resident">{{__('common.resident')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.pwd')}}</label>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input autocomplete="off" @if (old('pwd') === 'Yes') checked @endif class="form-check-input w-45px h-30px" type="checkbox" id="pwd" name="pwd">
                                            <label class="form-check-label" for="pwd"></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.active')}}</label>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input autocomplete="off" @if (old('active') === 1) checked @endif class="form-check-input w-45px h-30px" type="checkbox" id="active" name="active">
                                            <label class="form-check-label" for="active"></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="first_wife_name">
                                        {{__('common.first_wife_name')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" id="first_wife_name" type="text" name="first_wife_name" class="form-control" placeholder="{{__('common.first_wife_name')}}" value="{{ old('first_wife_name') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="father_wife_name">
                                        {{__('common.father_wife_name')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" id="father_wife_name" type="text" name="father_wife_name" class="form-control" placeholder="{{__('common.father_wife_name')}}" value="{{ old('father_wife_name') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="last_wife_name">
                                        {{__('common.last_wife_name')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" id="last_wife_name" type="text" name="last_wife_name" class="form-control" placeholder="{{__('common.last_wife_name')}}" value="{{ old('last_wife_name') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="wife_id_number">
                                        {{__('common.wife_id_number')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" title="Please enter numbers only" pattern="[0-9]*" inputmode="numeric" id="wife_id_number" type="text" name="wife_id_number" class="form-control" placeholder="{{__('common.wife_id_number')}}" value="{{ old('wife_id_number') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.male_0_5')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="male_0_5" type="number" name="male_0_5" class="form-control" value="{{ old('male_0_5') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.female_0_5')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="female_0_5" type="number" name="female_0_5" class="form-control" value="{{ old('female_0_5') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.male_6_12')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="male_6_12" type="number" name="male_6_12" class="form-control" value="{{ old('male_6_12') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.female_6_12')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="female_6_12" type="number" name="female_6_12" class="form-control" value="{{ old('female_6_12') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.male_13_17')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="male_13_17" type="number" name="male_13_17" class="form-control" value="{{ old('male_13_17') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.female_13_17')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="female_13_17" type="number" name="female_13_17" class="form-control" value="{{ old('female_13_17') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.male_18_50')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="male_18_50" type="number" name="male_18_50" class="form-control" value="{{ old('male_18_50') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.female_18_50')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="female_18_50" type="number" name="female_18_50" class="form-control" value="{{ old('female_18_50') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.male_above_50')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="male_above_50" type="number" name="male_above_50" class="form-control" value="{{ old('male_above_50') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.female_above_50')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="female_above_50" type="number" name="female_above_50" class="form-control" value="{{ old('female_above_50') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{__('common.total_family_members')}}</label>
                                    <div class="col-lg-2">
                                        <input autocomplete="off" id="total_family_members" type="number" name="total_family_members" class="form-control" value="{{ old('total_family_members') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            {{-- Select location --}}
                            @include('admin.includes.locations')
                            {{-- Select location --}}
                                
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="camp">
                                        {{__('common.camp')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" id="camp" type="text" name="camp" class="form-control" placeholder="{{__('common.camp')}}" value="{{ old('camp') }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="details_address">
                                        {{__('common.details_address')}}
                                    </label>
                                    <div class="col-md-6">
                                        <textarea required id="details_address" name="details_address" class="form-control" placeholder="{{__('common.details_address')}}">{{ old('details_address') }}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="note">
                                        {{__('common.note')}}
                                    </label>
                                    <div class="col-md-6">
                                        <textarea id="note" name="note" class="form-control" placeholder="{{__('common.note')}}">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="mt-5">
                                <div class="input-group input-group-solid mb-5">
                                    <label class="col-sm-2 control-label" for="category">
                                        {{__('common.category')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input autocomplete="off" id="category" type="text" name="category" class="form-control" placeholder="{{__('common.category')}}" value="{{ old('category') }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-5">
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
                            </fieldset>
                            
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{route('admin.'.$page_name.'.index')}}" type="reset"
                                class="btn btn-light btn-active-light-primary me-2">{{__('common.discard')}}</a>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('common.save_changes')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.includes.locations_code_js')
@endsection
