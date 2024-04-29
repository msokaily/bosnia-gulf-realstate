<script>
    $(document).ready(function() {
        var locations = @json($locations);
        var currentLanguage = '{{app()->getLocale()}}';
        var governorateSelect = $('#governorate-select');
        var districtSelect = $('#district-select');
        var subdistrictSelect = $('#subdistrict-select');
        var communitySelect = $('#community-select');

        populateGovernorates();

        // Function to populate governorate {{__('common.select_option')}}s
        function populateGovernorates() {
            governorateSelect.empty();
            governorateSelect.append('<option value="">{{__('common.select_governorate')}}</option>');
            $.each(locations, function(index, location) {
                if (location.type === "Governorate") {
                    governorateSelect.append('<option value="' + location.id + '">' + location.name[currentLanguage] + '</option>');
                }
            });

            // Set the selected value for governorate using either $item->details->governorate or a default value
            var selectedGovernorate = '{{ isset($item) ? ($item->details ? $item->details->governorate : $item->governorate ?? '') : '' }}';
            governorateSelect.val(selectedGovernorate);
            populateDistricts(selectedGovernorate);
        }

        // Event handler for governorate select change
        governorateSelect.on('change', function() {
            var selectedGovernorate = $(this).val();
            populateDistricts(selectedGovernorate);
        });

        // Function to populate district {{__('common.select_option')}}s based on the selected governorate
        function populateDistricts(governorateId) {
            districtSelect.empty();
            districtSelect.append('<option value="">{{__('common.select_district')}}</option>');
            $.each(locations, function(index, location) {
                if (location.type === "District" && location.parent_id == governorateId) {
                    districtSelect.append('<option value="' + location.id + '">' + location.name[currentLanguage] + '</option>');
                }
            });

            // Set the selected value for district using either $item->details->district or a default value
            var selectedDistrict = '{{ isset($item) ? ($item->details ? $item->details->district : $item->district ?? '') : '' }}';
            districtSelect.val(selectedDistrict);
            populateSubdistricts(selectedDistrict);
        }

        // Event handler for district select change
        districtSelect.on('change', function() {
            var selectedDistrict = $(this).val();
            populateSubdistricts(selectedDistrict);
        });

        // Function to populate subdistrict {{__('common.select_option')}}s based on the selected district
        function populateSubdistricts(districtId) {
            subdistrictSelect.empty();
            subdistrictSelect.append('<option value="">{{__('common.select_sub_district')}}</option>');
            $.each(locations, function(index, location) {
                if (location.type === 'SubDistrict' && location.parent_id == districtId) {
                    subdistrictSelect.append('<option value="' + location.id + '">' + location.name[currentLanguage] + '</option>');
                }
            });

            // Set the selected value for subdistrict using either $item->details->subdistrict or a default value
            var selectedSubdistrict = '{{ isset($item) ? ($item->details ? $item->details->subdistrict : $item->subdistrict ?? '') : '' }}';
            subdistrictSelect.val(selectedSubdistrict);
            populateCommunities(selectedSubdistrict);
        }

        // Event handler for subdistrict select change
        subdistrictSelect.on('change', function() {
            var selectedSubdistrict = $(this).val();
            populateCommunities(selectedSubdistrict);
        });

        // Function to populate community {{__('common.select_option')}}s based on the selected subdistrict
        function populateCommunities(subdistrictId) {
            communitySelect.empty();
            communitySelect.append('<option value="">{{__('common.select_community')}}</option>');
            $.each(locations, function(index, location) {
                if (location.type === 'Community' && location.parent_id == subdistrictId) {
                    communitySelect.append('<option value="' + location.id + '">' + location.name[currentLanguage] + '</option>');
                }
            });

            // Set the selected value for community using either $item->details->community or a default value
            var selectedCommunity = '{{ isset($item) ? ($item->details ? $item->details->community : $item->community ?? '') : '' }}';
            communitySelect.val(selectedCommunity);
        }
    });
</script>
