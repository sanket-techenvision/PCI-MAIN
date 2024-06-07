<h3 for="SERVICE DETAILS">SERVICE DETAILS</h3>

<!-- Service Cat Id Field -->
<div class="form-group col-sm-6 mb-2">
    <label for="Service_Category">Service Category<span class="text-danger">*</span></label>
    <select id="Service_Category" class="form-control" required>
        <option value="" >Select Category</option>
        @foreach($serviceCats as $data)
            <option value="{{ $data->service_cat_id }}" {{ $customerDrafts->service_cat_id == $data->service_cat_id ? 'selected' : '' }}>{{ $data->service_cat_name }}</option>
        @endforeach
    </select>
</div>

<!-- Service Sub Cat Id Field -->
<div class="form-group col-sm-6 mb-2">
    <label for="service_sub_cat_id">Service Sub Category<span class="text-danger">*</span></label>
    <select id="service_sub_cat_id" class="form-control" required>
        <option value="{{ $customerDrafts->service_sub_cat_id }}" selected>Select Sub Category</option>
    </select>
</div>

<!-- Service Subsub Cat Id Field -->
<div class="form-group col-sm-6 mb-2" id="subsub-category-field" style="display: none;">
    <label for="service_subsub_cat_id">Service Subsub Category<span class="text-danger">*</span></label>
    <select id="service_subsub_cat_id" class="form-control" required>
        <option value="">Select Subsub Category</option>
    </select>
</div>

<!-- Bank Id Field -->
<div class="form-group col-sm-6 mb-2">
    <label for="bank_id">Select Issuer Bank<span class="text-danger">*</span></label>
    <select id="bank_id" class="form-control" required>
        <option value="">Select Issuer Bank</option>
    </select>
</div>

<!-- Get Dyanmic Form Selections -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#Service_Category').on('change', function() {
            var categoryId = this.value;
            $("#service_sub_cat_id").html('<option value="">Select Sub Category</option>');
            $("#service_subsub_cat_id").html('<option value="">Select Subsub Category</option>');
            $('#subsub-category-field').hide(); // Hide sub-sub category field initially
            if (categoryId) {
                $.ajax({
                    url: '/get-sub-categories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function(key, value) {
                            $("#service_sub_cat_id").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            }
        });

        $('#service_sub_cat_id').on('change', function() {
            var subCategoryId = this.value;
            $("#service_subsub_cat_id").html('<option value="">Select Subsub Category</option>');
            $('#subsub-category-field').hide(); // Hide sub-sub category field initially
            if (subCategoryId) {
                $.ajax({
                    url: '/get-subsub-categories/' + subCategoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        if ($.isEmptyObject(result)) {
                            $('#subsub-category-field').hide(); // Hide if no sub-sub categories are returned
                        } else {
                            $.each(result, function(key, value) {
                                $("#service_subsub_cat_id").append('<option value="' + key + '">' + value + '</option>');
                            });
                            $('#subsub-category-field').show(); // Show if sub-sub categories are returned
                        }
                    }
                });
            }
        });
        $('#service_sub_cat_id').on('change', function() {
            var subCategoryId = this.value;
            $("#bank_id").html('<option value="">Select Issuer Bank</option>');
            if (subCategoryId) {
                $.ajax({
                    url: '/get-bank-data/' + subCategoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function(key, value) {
                            $("#bank_id").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            }

        });
    });
</script>