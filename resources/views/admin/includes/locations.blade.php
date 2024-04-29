 {{-- Select location --}}
 <fieldset class="mt-5">
    <div class="input-group input-group-solid mb-5">
        <label class="col-sm-2 form-label">
            {{__('common.location')}}
            <span class="symbol">*</span>
        </label>
        <div class="col-md-10 sortable">
            <div class="col-md-10 col-md-offset-2 mt-5 add-push-row row">
                <div class="col-md-4">
                    <select required id="governorate-select" name="governorate_id" class="form-control select2_" data-placeholder="{{__('common.select_governorate')}}" aria-required="true" aria-describedby="select-error" aria-invalid="false" >
                        <option value="">{{__('common.select_governorate')}}</option>
                        @foreach($governorates as $governorate)
                            <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select required id="district-select" name="district_id" class="form-control select2_" data-placeholder="{{__('common.select_district')}}" aria-required="true" aria-describedby="select-error" aria-invalid="false" >
                        <option value="">{{__('common.select_district')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-2 mt-5 add-push-row row">
                <div class="col-md-4">
                    <select required id="subdistrict-select" name="sub_district_id" class="form-control select2_" data-placeholder="{{__('common.select_sub_district')}}" aria-required="true" aria-describedby="select-error" aria-invalid="false" >
                        <option value="">{{__('common.select_sub_district')}}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select required id="community-select" name="communitiy_id" class="form-control select2_" data-placeholder="{{__('common.select_community')}}" aria-required="true" aria-describedby="select-error" aria-invalid="false" >
                        <option value="">{{__('common.select_community')}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
{{-- Select location --}}
