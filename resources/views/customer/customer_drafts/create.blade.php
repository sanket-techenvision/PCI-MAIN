@extends('customer.layouts.app')

@section('content')
<section class="content-header p-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    Apply For Service
                </h1>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="content px-3">

    <div class="card">
        {!! Form::open(['route' => 'customer-drafts.store', 'id' => 'multi-step-form']) !!}
        <div class="card-body">

            <!-- APPLICANT DETAILS -->
            <div class="row step step-0" id="fields0">
                <h3 for="APPLICANT DETAILS">APPLICANT DETAILS</h3>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="applicant_first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                        <input class="form-control @error('applicant_first_name') is-invalid @enderror" type="text" id="applicant_first_name" name="applicant_first_name" placeholder="{{ Auth::user()->user_first_name }}" required>
                        @error('applicant_first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4 mb-3">
                        <label for="applicant_last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                        <input class="form-control @error('applicant_last_name') is-invalid @enderror" type="text" id="applicant_last_name" name="applicant_last_name" placeholder="{{ Auth::user()->user_last_name }}" value="{{ old('applicant_last_name') }}" required>
                        @error('applicant_last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4 mb-3">
                        <label for="applicant_email" class="form-label">Applicant Email ID<span class="text-danger">*</span></label>
                        <input class="form-control @error('applicant_email') is-invalid @enderror" type="email" id="applicant_email" name="applicant_email" placeholder="{{ Auth::user()->user_email }}" value="{{ old('applicant_email') }}" required>
                        @error('applicant_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4 mb-3">
                        <label for="applicant_address" class="form-label">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="applicant_address" name="applicant_address" placeholder="House No./ Building No./ Street / Locality" required></input>
                    </div>
                    <div class="col-4">
                        <label for="applicant_country" class="form-label">Country<span class="text-danger">*</span></label>
                        <select class="form-control" id="applicant_country" name="applicant_country" required>
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="applicant_state" class="form-label">State<span class="text-danger">*</span></label>
                        <select class="form-control" id="applicant_state" name="applicant_state" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="applicant_city" class="form-label">City<span class="text-danger">*</span></label>
                        <select class="form-control" id="applicant_city" name="applicant_city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>

                </div>
                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="1">Next</button>
                </div>
            </div>

            <!-- Service Selection with Relative Bank -->
            <div class="row step step-1" id="fields" style="display: none;">
                <h3 for="SERVICE DETAILS">SERVICE DETAILS</h3>

                <!-- Service Cat Id Field -->
                <div class="form-group col-sm-6 mb-2">
                    <label for="Service_Category">Service Category<span class="text-danger">*</span></label>
                    <select id="Service_Category" class="form-control" name="service_cat_id" required>
                        <option value="">Select Category</option>
                        @foreach($serviceCats as $data)
                        <option value="{{ $data->service_cat_id }}">{{ $data->service_cat_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Service Sub Cat Id Field -->
                <div class="form-group col-sm-6 mb-2">
                    <label for="service_sub_cat_id">Service Sub Category<span class="text-danger">*</span></label>
                    <select id="service_sub_cat_id" class="form-control" name="service_sub_cat_id" required>
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <!-- Service Subsub Cat Id Field -->
                <div class="form-group col-sm-6 mb-2" id="subsub-category-field" style="display: none;">
                    <label for="service_subsub_cat_id">Service Subsub Category<span class="text-danger">*</span></label>
                    <select id="service_subsub_cat_id" class="form-control" name="service_subsub_cat_id" required>
                        <option value="">Select Subsub Category</option>
                    </select>
                </div>

                <!-- Bank Id Field -->
                <div class="form-group col-sm-6 mb-2">
                    <label for="bank_id">Select Issuer Bank<span class="text-danger">*</span></label>
                    <select id="bank_id" class="form-control" name="bank_id" required>
                        <option value="">Select Issuer Bank</option>
                    </select>
                </div>

                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="2">Next</button>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="0">Previous</button>
                </div>
            </div>

            <!-- BENEFICIARY DETAILS -->
            <div class="row step step-2" id="fields2" style="display: none;">
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
                        <input type="text" class="form-control" id="beneficiary_address" name="beneficiary_address" placeholder="House No./ Building No./ Street / Locality" required></input>
                    </div>
                    <div class="col-4">
                        <label for="beneficiary_country" class="form-label">Country<span class="text-danger">*</span></label>
                        <select class="form-control" id="beneficiary_country" name="beneficiary_country" required>
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="beneficiary_state" class="form-label">State<span class="text-danger">*</span></label>
                        <select class="form-control" id="beneficiary_state" name="beneficiary_state" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="beneficiary_city" class="form-label">City<span class="text-danger">*</span></label>
                        <select class="form-control" id="beneficiary_city" name="beneficiary_city" required>
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
                </div>
                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="3">Next</button>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="1">Previous</button>
                </div>
            </div>

            <!-- Preview Filled Data -->
            <div class="row step step-3" id="preview" style="display: none;">
                <h3 for="PREVIEW FILLED DATA">PREVIEW FILLED DATA</h3>
                <div id="preview-content">
                    <!-- Content will be populated by JavaScript -->
                </div>
                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="4">Confirm and Proceed To Payment</button>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="2">Previous</button>
                </div>
            </div>

            <!-- Payment Step -->
            <div class="row step step-4" id="payment-gateway" style="display: none;">
                <div>
                    <h3>PAYMENT</h3>

                    <div class="col-6 mb-3">
                        <label for="guarantee_amount" class="form-label">Guarantee Amount<span class="text-danger">*</span></label>
                        <input class="form-control @error('guarantee_amount') is-invalid @enderror" type="number" id="guarantee_amount" name="guarantee_amount" placeholder="Enter Payment Guarantee Amount" value="{{ old('guarantee_amount') }}" required>
                        @error('guarantee_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="payment-status" class="text-center">
                        <button type="button" class="btn btn-primary" id="pay-button">Pay</button>
                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">

                    <div id="payment-success" style="display: none;">
                        <input type="hidden" name="payment_status" value="success">
                        <button type="submit" class="btn btn-success">Payment Successfull !</button>
                        <a href="{{route('customer-drafts.create')}}"> <button type="button" class="btn btn-danger">Payment Failed</button></a>
                    </div>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="3">Previous</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        <div class="card-footer">
            <a href="{{ route('customer-drafts.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Countre/State/City -->
    <script>
        $(document).ready(function() {
            function handleLocationChange(countrySelector, stateSelector, citySelector) {
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
                                } else {
                                    $(citySelector).prop('required', false);
                                }
                            }
                        });
                    }
                });
            }

            // Call the function for applicant fields
            handleLocationChange('#applicant_country', '#applicant_state', '#applicant_city');

            // Call the function for beneficiary fields
            handleLocationChange('#beneficiary_country', '#beneficiary_state', '#beneficiary_city');
        });
    </script>


    <!-- Ajax for Service categories and Bank DETAILS -->
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
                var subSubCategoryField = $("#service_subsub_cat_id");
                var subSubCategoryDiv = $('#subsub-category-field');

                // Clear and hide sub-sub category field initially
                subSubCategoryField.html('<option value="">Select Subsub Category</option>');
                subSubCategoryDiv.hide();
                subSubCategoryField.removeAttr('required'); // Remove required attribute initially

                if (subCategoryId) {
                    $.ajax({
                        url: '/get-subsub-categories/' + subCategoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                            if ($.isEmptyObject(result)) {
                                subSubCategoryDiv.hide(); // Hide if no sub-sub categories are returned
                                subSubCategoryField.removeAttr('required'); // Ensure required attribute is removed
                            } else {
                                $.each(result, function(key, value) {
                                    subSubCategoryField.append('<option value="' + key + '">' + value + '</option>');
                                });
                                subSubCategoryDiv.show(); // Show if sub-sub categories are returned
                                subSubCategoryField.attr('required', 'required'); // Add required attribute
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

    <!-- Section script -->
    <script>
        $(document).ready(function() {
            $('.next-button').click(function(event) {
                event.preventDefault(); // Prevent the default action

                var currentStep = $(this).data('next') - 1;
                var nextStep = $(this).data('next');

                // Validate the current step
                var isValid = validateStep(currentStep);
                if (isValid) {
                    if (nextStep === 3) {
                        populatePreview();
                    }
                    // Hide current step and show the next step
                    $('.step').hide();
                    $('.step-' + nextStep).show();
                } else {
                    alert('Please fill all required fields before proceeding.');
                }
            });

            $('.prev-button').click(function() {
                var prevStep = $(this).data('prev');

                // Hide current step and show the previous step
                $('.step').hide();
                $('.step-' + prevStep).show();
            });

            $('#pay-button').click(function() {
                var amount = $('#guarantee_amount').val();
                if (amount === '') {
                    alert('Please enter the guarantee amount.');
                    $('#guarantee_amount').addClass('is-invalid');
                    return;
                }
                $('#guarantee_amount').removeClass('is-invalid');

                // Mock payment processing
                var paymentSuccessful = true;

                if (paymentSuccessful) {
                    $('#payment-status').hide();
                    $('#payment-success').show();
                } else {
                    $('#payment-status').hide();
                    $('#payment-failure').show();
                }
            });

            function validateStep(step) {
                var isValid = true;
                $('.step-' + step + ' [required]').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return isValid;
            }
            // Populate the preview step with data from previous steps
            function populatePreview() {
                var previewContent = $('#preview-content');
                previewContent.empty();

                // Get data from previous steps
                var applicantFirstName = $('#applicant_first_name').val();
                var applicantLastName = $('#applicant_last_name').val();
                var applicantEmail = $('#applicant_email').val();
                var applicantAddress = $('#applicant_address').val();
                var serviceCategory = $('#Service_Category option:selected').text();
                var serviceSubCategory = $('#service_sub_cat_id option:selected').text();
                var serviceSubSubCategory = $('#service_subsub_cat_id option:selected').text();
                var bank = $('#bank_id option:selected').text();
                var beneficiaryFirstName = $('#beneficiary_first_name').val();
                var beneficiaryLastName = $('#beneficiary_last_name').val();
                var beneficiaryEmail = $('#beneficiary_email').val();
                var beneficiaryAddress = $('#beneficiary_address').val();
                var beneficiaryAccountNo = $('#beneficiary_account_no').val();
                console.log(applicantFirstName, applicantLastName, applicantEmail);
                // Append data to preview content
                previewContent.append(`
                <div class="card shadow">
                <h4>Applicant Details</h4>
                <table class="table table-striped">
                    <tr><th>First Name</th><td>${applicantFirstName}</td></tr>
                    <tr><th>Last Name</th><td>${applicantLastName}</td></tr>
                    <tr><th>Email</th><td>${applicantEmail}</td></tr>
                    <tr><th>Address</th><td>${applicantAddress}</td></tr>
                </table>
                <h4>Service Details</h4>
                <table class="table table-striped">
                    <tr><th>Service Category</th><td>${serviceCategory}</td></tr>
                    <tr><th>Service Sub Category</th><td>${serviceSubCategory}</td></tr>
                    <tr><th>Service Subsub Category</th><td>${serviceSubSubCategory}</td></tr>
                    <tr><th>Issuer Bank</th><td>${bank}</td></tr>
                </table>
                <h4>Beneficiary Details</h4>
                <table class="table table-striped">
                    <tr><th>First Name</th><td>${beneficiaryFirstName}</td></tr>
                    <tr><th>Last Name</th><td>${beneficiaryLastName}</td></tr>
                    <tr><th>Email</th><td>${beneficiaryEmail}</td></tr>
                    <tr><th>Address</th><td>${beneficiaryAddress}</td></tr>
                    <tr><th>Account No</th><td>${beneficiaryAccountNo}</td></tr>
                </table></div>
            `);
            }
            // Remove 'is-invalid' class when user starts typing
            $('input, textarea, select').on('input change', function() {
                if ($(this).val() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>


</div>
@endsection