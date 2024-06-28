{!! $breadCrumb !!}

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
        <input class="form-control @error('applicant_email') is-invalid @enderror" type="email" id="applicant_email" name="applicant_email" placeholder="{{ Auth::user()->user_email }}" value="{{ old('applicant_email') ? old('applicant_email') : Auth::user()->user_email }}" required>
        @error('applicant_email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="applicant_address" class="form-label">Address<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="applicant_address" name="applicant_address" placeholder="House No./ Building No./ Street / Locality" value="{{ old('applicant_address') ? old('applicant_address') : Auth::user()->user_address }}" required></input>
    </div>
    <div class="col-md-4 mb-3">
        <label for="applicant_country" class="form-label">Country<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="applicant_country" name="applicant_country" required>
            <option value="">Select Country</option>
            @foreach ($countries as $country)
            <option value="{{ $country->id }}" @if ($country->name == Auth::user()->user_country) selected @endif>
                {{ $country->name }}
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
    <div class="col-md-6 mb-3">
        <label for="beneficiary_company_name" class="form-label">Company Name<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_company_name') is-invalid @enderror" type="text" id="beneficiary_company_name" name="beneficiary_company_name" placeholder="Enter Company name" value="{{ old('beneficiary_company_name') }}" required>
        @error('beneficiary_company_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="beneficiary_email" class="form-label">Beneficiary Email ID<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_email') is-invalid @enderror" type="email" id="beneficiary_email" name="beneficiary_email" placeholder="Enter BENEFICIARY Mail ID" value="{{ old('beneficiary_email') }}" required>
        @error('beneficiary_email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="beneficiary_address" class="form-label">Address<span class="text-danger">*</span></label>
        <input type="text" class="form-control  @error('beneficiary_address') is-invalid @enderror" id="beneficiary_address" name="beneficiary_address" placeholder="House No./ Building No./ Street / Locality" required></input>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="beneficiary_country" class="form-label">Country<span class="text-danger">*</span></label>
        <select class="form-control select2" data-toggle="select2" id="beneficiary_country" name="beneficiary_country" required>
            <option value="">Select Country</option>
            @foreach ($countries as $country)
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
    <div class="col-md-6 mb-3">
        <label for="beneficiary_account_no" class="form-label">Beneficiary Account No.<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_account_no') is-invalid @enderror" type="text" id="beneficiary_account_no" name="beneficiary_account_no" placeholder="Enter BENEFICIARY Account Number" value="{{ old('beneficiary_account_no') }}" required>
        @error('beneficiary_account_no')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
    <label for="guarantee_amount" class="form-label">Guarantee Amount<span class="text-danger">*</span></label>
    <div class="btn-group d-flex">
        <select class="form-select select2 @error('currency_code') is-invalid @enderror me-2" data-toggle="select2" id="currency_code" name="currency_code" required>
            <option value="" disabled selected>Select Currency</option>
            @foreach ($currency as $currency)
            <option value="{{ $currency->code }}" {{ old('currency_code') == $currency->code ? 'selected' : '' }}>
                {{ $currency->code }} - {{ $currency->country }}
            </option>
            @endforeach
        </select>
        <input class="form-control @error('guarantee_amount') is-invalid @enderror" type="number" id="guarantee_amount" name="guarantee_amount" placeholder="Enter Payment Guarantee Amount" value="{{ old('guarantee_amount') }}" min="1" required>
    </div>
    @error('guarantee_amount')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('currency_code')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

</div>

<h3 for="ADVISING BANK">ADVISING BANK</h3>
<div class="row">
    {{-- ADVISING BANK --}}
    <div class="col-md-6 mb-3">
        <label for="advising_swift_code" class="form-label">Advising Bank SWIFT Code<span class="text-danger">*</span></label>
        <input class="form-control @error('advising_swift_code') is-invalid @enderror" type="text" id="advising_swift_code" name="advising_swift_code" placeholder="Enter Advising Bank SWIFT Code" value="{{ old('advising_swift_code') }}" required>
        @error('advising_swift_code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="beneficiary_bank_name" class="form-label">Beneficiary Bank Name<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_bank_name') is-invalid @enderror" type="text" id="beneficiary_bank_name" name="beneficiary_bank_name" placeholder="Enter Beneficiary Bank Name" value="{{ old('beneficiary_bank_name') }}" required>
        @error('beneficiary_bank_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="beneficiary_bank_address" class="form-label">Beneficiary Bank Address<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_bank_address') is-invalid @enderror" type="text" id="beneficiary_bank_address" name="beneficiary_bank_address" placeholder="Enter Beneficiary Bank Address" value="{{ old('beneficiary_bank_address') }}" required>
        @error('beneficiary_bank_address')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<h3 for="ADVISING BANK">CONTRACT DETAILS</h3>
<div class="row">
    <div class="col-md-5 mb-3">
        <label for="project_name" class="form-label">Project Name<span class="text-danger">*</span></label>
        <input class="form-control @error('project_name') is-invalid @enderror" type="text" id="project_name" name="project_name" placeholder="Project Name" value="{{ old('project_name') }}" required>
        @error('project_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-5 mb-3">
        <label for="contract_no" class="form-label">Contract Number (Between Applicant and Beneficiary)<span class="text-danger">*</span></label>
        <input class="form-control @error('contract_no') is-invalid @enderror" type="text" id="contract_no" name="contract_no" placeholder="Enter Contract Number" value="{{ old('contract_no') }}" required>
        @error('contract_no')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-2 mb-3">
        <label for="contract_date" class="form-label">Contract Date<span class="text-danger">*</span></label>
        <input class="form-control @error('contract_date') is-invalid @enderror" type="date" id="contract_date" name="contract_date" placeholder="Select Contract Date" value="{{ old('contract_date') }}" required max="{{ \Carbon\Carbon::today()->toDateString() }}">
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
                                $(stateSelector).append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
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
                                    $(citySelector).append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
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
        var userState = "{{ $userdata['stateid'] }}";
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

        var beneficiaryCompanyName = $('#beneficiary_company_name').val();
        var beneficiaryEmail = $('#beneficiary_email').val();

        var beneficiaryAddress = $('#beneficiary_address').val();
        var beneficiaryCountry = $('#beneficiary_country option:selected').text();
        var beneficiaryState = $('#beneficiary_state option:selected').text();
        var beneficiaryCity = $('#beneficiary_city option:selected').text();

        var beneficiaryAccountNo = $('#beneficiary_account_no').val();
        var beneficiaryBankName = $('#beneficiary_bank_name').val();
        var beneficiaryBankAddress = $('#beneficiary_bank_address').val();

        var currencyCode = $('#currency_code').val();
        var guaranteeAmount = $('#guarantee_amount').val();

        var advisingSwiftCode = $('#advising_swift_code').val();

        var contractNo = $('#contract_no').val();
        var contractDate = $('#contract_date').val();

        previewContent.append(`
        <!-- Service Information Section -->
        <h3>Service Information</h3>
        <div class="row">
        <div class="col-lg-3">
            <label for="serviceCategory">Service Category:</label>
            <p>${serviceCategory}</p>
        </div>
        <div class="col-lg-3">
            <label for="serviceSubCategory">Service Sub Category:</label>
            <p>${serviceSubCategory}</p>
        </div>
        <div class="col-lg-3">
            <label for="serviceSubSubCategory">Service Subsub Category:</label>
            <p>${serviceSubSubCategory}</p>
        </div>
        <div class="col-lg-3">
            <label for="bank">Issuer Bank:</label>
            <p>${bank}</p>
        </div>
    </div>

    <!-- Applicant Details Section -->
    <h3>Applicant Details</h3>
    <div class="row">
        <div class="col-lg-3">
            <label for="applicantFirstName">First Name:</label>
            <p>${applicantFirstName}</p>
        </div>
        <div class="col-lg-3">
            <label for="applicantLastName">Last Name:</label>
            <p>${applicantLastName}</p>
        </div>
        <div class="col-lg-3">
            <label for="applicantEmail">Email:</label>
            <p>${applicantEmail}</p>
        </div>
        <div class="col-lg-3">
            <label for="applicantAddress">Address:</label>
            <p>${applicantAddress}</p>
        </div>
        <div class="col-lg-3">
            <label for="applicantCountry">Country:</label>
            <p>${applicantCountry}</p>
        </div>
        <div class="col-lg-3">
            <label for="applicantState">State:</label>
            <p>${applicantState}</p>
        </div>
        <div class="col-lg-3">
            <label for="applicantCity">City:</label>
            <p>${applicantCity}</p>
        </div>
    </div>

    <!-- Beneficiary Details Section -->
    <h3>Beneficiary Details</h3>
    <div class="row">
        <div class="col-lg-3">
            <label for="beneficiaryCompanyName">Company Name:</label>
            <p>${beneficiaryCompanyName}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryEmail">Email:</label>
            <p>${beneficiaryEmail}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryAddress">Address:</label>
            <p>${beneficiaryAddress}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryCountry">Country:</label>
            <p>${beneficiaryCountry}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryState">State:</label>
            <p>${beneficiaryState}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryCity">City:</label>
            <p>${beneficiaryCity}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryAccountNo">Account No:</label>
            <p>${beneficiaryAccountNo}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryBankName">Beneficiary Bank Name:</label>
            <p>${beneficiaryBankName}</p>
        </div>
        <div class="col-lg-3">
            <label for="beneficiaryBankAddress">Beneficiary Bank Address:</label>
            <p>${beneficiaryBankAddress}</p>
        </div>
        <div class="col-lg-3">
            <label for="guaranteeAmount">Guarantee Amount:</label>
            <p>${currencyCode} - ${guaranteeAmount}</p>
        </div>
    </div>

    <!-- Contract Details Section -->
    <h3>Contract Details</h3>
    <div class="row">
        <div class="col-lg-3">
            <label for="advisingSwiftCode">Advising Swift Code:</label>
            <p>${advisingSwiftCode}</p>
        </div>
        <div class="col-lg-3">
            <label for="contractNo">Contract No:</label>
            <p>${contractNo}</p>
        </div>
        <div class="col-lg-3">
            <label for="contractDate">Contract Date:</label>
            <p>${contractDate}</p>
        </div>
    </div>
`);
    }
</script>