@extends('customer.layouts.app')

@section('css')
@vite('node_modules/select2/dist/css/select2.min.css')
@endsection
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

            <!-- Service Selection with Relative Bank -->
            <div class="row step step-0" id="fields0">
                <h3 for="SERVICE DETAILS">SERVICE DETAILS</h3>

                <!-- Service Cat Id Field -->
                <div class="form-group col-sm-6 mb-2">
                    <label for="Service_Category">Service Category<span class="text-danger">*</span></label>
                    <select id="Service_Category" class="form-control select2" data-toggle="select2" name="service_cat_id" required>
                        <option value="">Select Category</option>
                        @foreach($serviceCats as $data)
                        <option value="{{ $data->service_cat_id }}">{{ $data->service_cat_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Service Sub Cat Id Field -->
                <div class="form-group col-sm-6 mb-2">
                    <label for="service_sub_cat_id">Service Sub Category<span class="text-danger">*</span></label>
                    <select id="service_sub_cat_id" class="form-control select2" data-toggle="select2" name="service_sub_cat_id" required>
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <!-- Service Subsub Cat Id Field -->
                <div class="form-group col-sm-6 mb-2" id="subsub-category-field" style="display: none;">
                    <label for="service_subsub_cat_id">Service Subsub Category<span class="text-danger">*</span></label>
                    <select id="service_subsub_cat_id" class="form-control select2" data-toggle="select2" name="service_subsub_cat_id" required>
                        <option value="">Select Subsub Category</option>
                    </select>
                </div>

                <!-- Bank Id Field -->
                <div class="form-group col-sm-6 mb-2">
                    <label for="bank_id">Select Issuer Bank<span class="text-danger">*</span></label>
                    <select id="bank_id" class="form-control select2" data-toggle="select2" name="bank_id" required>
                        <option value="">Select Issuer Bank</option>
                    </select>
                </div>
                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="1">Next</button>
                </div>
            </div>

            <!-- Dynamic Form -->
            <div class="row step step-1" id="fields" style="display: none;">
                <div id="dynamic-form-content">
                    <!-- Dynamic form content will be loaded here -->
                </div>
                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="2">Next</button>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="0">Previous</button>
                </div>
            </div>

            <!-- Preview Filled Data -->
            <div class="row step step-2" id="preview" style="display: none;">
                <h3 for="PREVIEW FILLED DATA">PREVIEW FILLED DATA</h3>
                <div id="preview-content">
                    <!-- Content will be populated by JavaScript -->
                </div>
                <div>
                    <button type="button" class="btn btn-primary next-button float-end" data-next="3">Confirm and
                        Proceed To Payment</button>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="1">Previous</button>
                </div>
            </div>

            <!-- Payment Step -->
            <div class="row step step-3" id="payment-gateway" style="display: none;">
                <div class="m-5">
                    <h3 class="text-center">PAYMENT</h3>
                    <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                    <div id="payment-success">
                        <input type="hidden" name="payment_status" value="success">
                        <button type="submit" class="btn btn-success m-2">Payment Successfull !</button>
                        <a href="{{route('customer-drafts.create')}}"> <button type="button" class="btn btn-danger m-2">Payment Failed</button></a>
                    </div>
                    <button type="button" class="btn btn-secondary prev-button float-start" data-prev="2">Previous</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        <div class="card-footer">
            <a href="{{ route('customer-drafts.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Ajax for Service categories and Bank DETAILS -->
    <script>
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
    
    <!-- Script to get dynamc form  -->
    <script>
        $(document).ready(function() {
            // Event listener for the Next button in the service selection step

            $('.next-button[data-next="1"]').click(function(event) {
                event.preventDefault(); // Prevent default form submission

                let categoryId = $('#Service_Category').val();
                let subCategoryId = $('#service_sub_cat_id').val();
                let subSubCategoryId = $('#service_subsub_cat_id').val();
                let bankId = $('#bank_id').val();

                if (categoryId && subCategoryId && subSubCategoryId && bankId) {
                    updateDynamicForm(categoryId, subCategoryId, subSubCategoryId, bankId);
                } else {
                    alert('Please select category, subcategory, subSubCategoryId and bank.');
                }
            });

            function updateDynamicForm(categoryId, subCategoryId, subSubCategoryId, bankId) {
                // Get the CSRF token from the meta tag
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Prepare data to be sent in the POST request
                let data = {
                    categoryId: categoryId,
                    subCategoryId: subCategoryId,
                    subSubCategoryId: subSubCategoryId,
                    bankId: bankId
                };

                // Make a POST request to fetch dynamic form fields based on selected category and subcategory
                $.ajax({
                    url: '/get-dynamic-form',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: data,
                    success: function(response) {
                        $('#dynamic-form-content').html(response);
                        $('#fields').show();
                        $('#fields0').hide();
                        $('.select2').select2();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching dynamic form:', error);
                    }
                });
            }
            // Event delegation for next and previous buttons
            $(document).on('click', '.next-button', function() {
                var currentStep = $(this).data('next') - 1;
                var nextStep = $(this).data('next');

                // Validate the current step
                var isValid = validateStep(currentStep);
                if (isValid) {
                    if (nextStep === 2) {
                        if (typeof populatePreview === 'function') {
                            populatePreview();
                        }
                    }
                    // Hide current step and show the next step
                    $('.step').hide();
                    $('.step-' + nextStep).show();
                } else {
                    alert('Please fill all required fields before proceeding.');
                }
            });

            $(document).on('click', '.prev-button', function() {
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

            // Remove 'is-invalid' class when user starts typing
            $('input, textarea, select').on('input change', function() {
                if ($(this).val() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
    @yield('dynamic-scripts')

</div>
@endsection