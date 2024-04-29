<?php
namespace App\Imports;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LocationsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $governorateEn = $row['governorate_en'];
        $governorateAr = $row['governorate_ar'];
        $governoratePcode = $row['governoratepcode'];
        $districtEn = $row['district_en'];
        $districtAr = $row['district_ar'];
        $districtPcode = $row['districtpcode'];
        $subDistrictEn = $row['subdistrict_en'];
        $subDistrictAr = $row['subdistrict_ar'];
        $subDistrictPcode = $row['subdistrictpcode'];
        $communityEn = $row['community_en'];
        $communityAr = $row['community_ar'];
        $communityPcode = $row['communitypcode'];
        $latitude = $row['latitude_y'];
        $longitude = $row['longitude_x'];

        // Add Governorate
        $governorate = Location::where(function ($query) use ($governorateEn, $governoratePcode) {
            $query->where('name->en', $governorateEn)->orWhere('code', $governoratePcode);
        })->where('type', 1)->first();

        if (!$governorate) {
            $governorate = Location::create([
                'name' => [
                    'en' => $governorateEn,
                    'ar' => $governorateAr,
                ],
                'code' => $governoratePcode,
                'type' => 1,
            ]);
        }

        // Add District
        $district = Location::where(function ($query) use ($districtEn, $districtPcode, $governorate) {
            $query->where('name->en', $districtEn)
                ->where('parent_id', $governorate->id)
                ->orWhere('code', $districtPcode)
                ->where('parent_id', $governorate->id);
        })->where('type', 2)->first();

        if (!$district) {
            $district = Location::create([
                'name' => [
                    'en' => $districtEn,
                    'ar' => $districtAr,
                ],
                'code' => $districtPcode,
                'type' => 2,
                'parent_id' => $governorate->id,
            ]);
        }

        // Add SubDistrict
        $subDistrict = Location::where(function ($query) use ($subDistrictEn, $subDistrictPcode, $district) {
            $query->where('name->en', $subDistrictEn)
                ->where('parent_id', $district->id)
                ->orWhere('code', $subDistrictPcode)
                ->where('parent_id', $district->id);
        })->where('type', 3)->first();

        if (!$subDistrict) {
            $subDistrict = Location::create([
                'name' => [
                    'en' => $subDistrictEn,
                    'ar' => $subDistrictAr,
                ],
                'code' => $subDistrictPcode,
                'type' => 3,
                'parent_id' => $district->id,
            ]);
        }

        // Add Community
        $community = Location::where(function ($query) use ($communityEn, $communityPcode, $subDistrict) {
            $query->where('name->en', $communityEn)
                ->where('parent_id', $subDistrict->id)
                ->orWhere('code', $communityPcode)
                ->where('parent_id', $subDistrict->id);
        })->where('type', 4)->first();

        if (!$community) {
            $community = Location::create([
                'name' => [
                    'en' => $communityEn,
                    'ar' => $communityAr,
                ],
                'code' => $communityPcode,
                'type' => 4,
                'Latitude_y' => $latitude,
                'Longitude_x' => $longitude,
                'parent_id' => $subDistrict->id,
            ]);
        }

        return null;
    }
}