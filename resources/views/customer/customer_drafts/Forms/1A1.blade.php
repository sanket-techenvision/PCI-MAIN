<!-- APPLICANT and Beneficiary DETAILS -->
<h3 for="APPLICANT DETAILS">APPLICANT DETAILS</h3>
<div class="row mb-3">
    <div class="col-md-6 mb-3">
        <label for="applicant_first_name" class="form-label">First Name<span class="text-danger">*</span></label>
        <input class="form-control @error('applicant_first_name') is-invalid @enderror" type="text" id="applicant_first_name" name="applicant_first_name" value="{{ Auth::user()->user_first_name }}" placeholder="{{ Auth::user()->user_first_name }}" required>
        @error('applicant_first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="applicant_last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
        <input class="form-control @error('applicant_last_name') is-invalid @enderror" type="text" id="applicant_last_name" name="applicant_last_name" value="{{ Auth::user()->user_last_name }}" placeholder="{{ Auth::user()->user_last_name }}" value="{{ old('applicant_last_name') }}" required>
        @error('applicant_last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="applicant_email" class="form-label">Applicant Email ID<span class="text-danger">*</span></label>
        <input class="form-control @error('applicant_email') is-invalid @enderror" type="email" id="applicant_email" name="applicant_email" placeholder="{{ Auth::user()->user_email }}" value="{{ old('applicant_email') ? old('applicant_email')  : Auth::user()->user_email }}" required>
        @error('applicant_email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="applicant_address" class="form-label">Address<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="applicant_address" name="applicant_address" placeholder="House No./ Building No./ Street / Locality" value="{{old('applicant_address') ? old('applicant_address') : Auth::user()->user_address}}" required></input>
    </div>
    <div class="col-md-4 mb-3">
        <label for="applicant_country" class="form-label">Country<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="applicant_country" name="applicant_country" required>
            <option value="">Select Country</option>
            @foreach($countries as $country)
            <option value="{{ $country->id }}" @if($country->name == Auth::user()->user_country) selected @endif>
                {{ $country->name}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="applicant_state" class="form-label">State<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="applicant_state" name="applicant_state" required>
            <option value="">Select State</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="applicant_city" class="form-label">City<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="applicant_city" name="applicant_city" required>
            <option value="">Select City</option>
        </select>
    </div>
</div>

<h3 for="BENEFICIARY DETAILS">BENEFICIARY DETAILS</h3>
<div class="row">
    <div class="col-6 mb-3">
        <label for="beneficiary_first_name" class="form-label">First Name<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_first_name') is-invalid @enderror" type="text" id="beneficiary_first_name" name="beneficiary_first_name" placeholder="Enter BENEFICIARY first name" value="{{ old('beneficiary_first_name') }}" required>
        @error('beneficiary_first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3">
        <label for="beneficiary_last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_last_name') is-invalid @enderror" type="text" id="beneficiary_last_name" name="beneficiary_last_name" placeholder="Enter BENEFICIARY last name" value="{{ old('beneficiary_last_name') }}" required>
        @error('beneficiary_last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3">
        <label for="beneficiary_email" class="form-label">Beneficiary Email ID<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_email') is-invalid @enderror" type="email" id="beneficiary_email" name="beneficiary_email" placeholder="Enter BENEFICIARY Mail ID" value="{{ old('beneficiary_email') }}" required>
        @error('beneficiary_email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-4 mb-3">
        <label for="beneficiary_address" class="form-label">Address<span class="text-danger">*</span></label>
        <input type="text" class="form-control  @error('beneficiary_address') is-invalid @enderror" id="beneficiary_address" name="beneficiary_address" placeholder="House No./ Building No./ Street / Locality" required></input>
    </div>
    <div class="col-md-4 mb-3">
        <label for="beneficiary_country" class="form-label">Country<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="beneficiary_country" name="beneficiary_country" required>
            <option value="">Select Country</option>
            @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="beneficiary_state" class="form-label">State<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="beneficiary_state" name="beneficiary_state" required>
            <option value="">Select State</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="beneficiary_city" class="form-label">City<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="beneficiary_city" name="beneficiary_city" required>
            <option value="">Select City</option>
        </select>
    </div>
    <div class="col-6 mb-3">
        <label for="beneficiary_account_no" class="form-label">Beneficiary Account No.<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_account_no') is-invalid @enderror" type="text" id="beneficiary_account_no" name="beneficiary_account_no" placeholder="Enter BENEFICIARY Account Number" value="{{ old('beneficiary_account_no') }}" required>
        @error('beneficiary_account_no')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3">
        <label for="guarantee_amount" class="form-label">Guarantee Amount<span class="text-danger">*</span></label>
        <input class="form-control @error('guarantee_amount') is-invalid @enderror" type="number" id="guarantee_amount" name="guarantee_amount" placeholder="Enter Payment Guarantee Amount" value="{{ old('guarantee_amount') }}" min="1" required>
        @error('guarantee_amount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<h3 for="ADVISING BANK">Contract DETAILS</h3>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="contract_no" class="form-label">Contract Number<span class="text-danger">*</span></label>
        <input class="form-control @error('contract_no') is-invalid @enderror" type="text" id="contract_no"
            name="contract_no" placeholder="Enter Contract Number" value="{{ old('contract_no') }}" required>
        @error('contract_no')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="contract_date" class="form-label">Contract Date<span
                class="text-danger">*</span></label>
        <input class="form-control @error('contract_date') is-invalid @enderror" type="date"
            id="contract_date" name="contract_date" placeholder="Select Contract Date"
            value="{{ old('contract_date') }}" required>
        @error('contract_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- Country/State/City -->
<script>
    $(document).ready(function() {
        function handleLocationChange(countrySelector, stateSelector, citySelector, userState, userCity) {
            $(countrySelector).change(function() {
                var countryId = $(this).val();
                $(stateSelector).html('<option value="">Select State</option>');
                $(citySelector).html('<option value="">Select City</option>');

                if (countryId) {
                    $.ajax({
                        url: '/get-states/' + countryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $(stateSelector).append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            // Set the user's state if it's available
                            if (userState) {
                                $(stateSelector).val(userState).trigger('change');
                            }
                        }
                    });
                }
            });

            $(stateSelector).change(function() {
                var stateId = $(this).val();
                $(citySelector).html('<option value="">Select City</option>');

                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                $(citySelector).prop('required', true);
                                $.each(data, function(key, value) {
                                    $(citySelector).append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                                // Set the user's city if it's available
                                if (userCity) {
                                    $(citySelector).val(userCity);
                                }
                            } else {
                                $(citySelector).prop('required', false);
                            }
                        }
                    });
                }
            });

            // Trigger change on country to load states and cities on page load
            if ($(countrySelector).val()) {
                $(countrySelector).trigger('change');
            }
        }
        // Get user's state and city from server-side rendering
        var userState = "{{$userdata['stateid'] }}";
        var userCity = "{{ $userdata['cityid'] }}";

        // Call the function for applicant fields
        handleLocationChange('#applicant_country', '#applicant_state', '#applicant_city', userState, userCity);

        // Call the function for beneficiary fields
        handleLocationChange('#beneficiary_country', '#beneficiary_state', '#beneficiary_city', '', '');
    });
</script>

<!-- Preview Script -->

<script type="text/javascript">
    // Populate the preview step with data from previous steps
    function populatePreview() {
        var previewContent = $('#preview-content');
        previewContent.empty();

        // Get data from previous steps
        var applicantFirstName = $('#applicant_first_name').val();
        var applicantLastName = $('#applicant_last_name').val();
        var applicantEmail = $('#applicant_email').val();
        var applicantAddress = $('#applicant_address').val();
        var applicantCountry = $('#applicant_country option:selected').text();
        var applicantState = $('#applicant_state option:selected').text();
        var applicantCity = $('#applicant_city option:selected').text();
        var serviceCategory = $('#Service_Category option:selected').text();
        var serviceSubCategory = $('#service_sub_cat_id option:selected').text();
        var serviceSubSubCategory = $('#service_subsub_cat_id option:selected').text();
        var bank = $('#bank_id option:selected').text();
        var beneficiaryFirstName = $('#beneficiary_first_name').val();
        var beneficiaryLastName = $('#beneficiary_last_name').val();
        var beneficiaryEmail = $('#beneficiary_email').val();
        var beneficiaryAddress = $('#beneficiary_address').val();
        var beneficiaryCountry = $('#beneficiary_country option:selected').text();
        var beneficiaryState = $('#beneficiary_state option:selected').text();
        var beneficiaryCity = $('#beneficiary_city option:selected').text();
        var beneficiaryAccountNo = $('#beneficiary_account_no').val();
        // Append data to preview content
        previewContent.append(`
                <div class="card shadow">
                <h4>Service Details</h4>
                <table class="table table-striped">
                    <tr><th>Service Category</th><td>${serviceCategory}</td></tr>
                    <tr><th>Service Sub Category</th><td>${serviceSubCategory}</td></tr>
                    <tr><th>Service Subsub Category</th><td>${serviceSubSubCategory}</td></tr>
                    <tr><th>Issuer Bank</th><td>${bank}</td></tr>
                </table>
                <h4>Applicant Details</h4>
                <table class="table table-striped">
                    <tr><th>First Name</th><td>${applicantFirstName}</td></tr>
                    <tr><th>Last Name</th><td>${applicantLastName}</td></tr>
                    <tr><th>Email</th><td>${applicantEmail}</td></tr>
                    <tr><th>Address</th><td>${applicantAddress}</td></tr>
                    <tr><th>Country</th><td>${applicantCountry}</td></tr>
                    <tr><th>State</th><td>${applicantState}</td></tr>
                    <tr><th>City</th><td>${applicantCity}</td></tr>
                </table>
                <h4>Beneficiary Details</h4>
                <table class="table table-striped">
                    <tr><th>First Name</th><td>${beneficiaryFirstName}</td></tr>
                    <tr><th>Last Name</th><td>${beneficiaryLastName}</td></tr>
                    <tr><th>Email</th><td>${beneficiaryEmail}</td></tr>
                    <tr><th>Address</th><td>${beneficiaryAddress}</td></tr>
                    <tr><th>Country</th><td>${beneficiaryCountry}</td></tr>
                    <tr><th>State</th><td>${beneficiaryState}</td></tr>
                    <tr><th>City</th><td>${beneficiaryCity}</td></tr>
                    <tr><th>Account No</th><td>${beneficiaryAccountNo}</td></tr>
                </table>
                </div>
                `);
    }
</script>