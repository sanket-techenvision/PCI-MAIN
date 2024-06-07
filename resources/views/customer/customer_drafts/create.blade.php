@extends('customer.layouts.app')

@section('content')
<section class="content-header p-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    Create Draft
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

            <div class="row step step-1" id="fields">
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
                </div>
            </div>

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
                    <div class="col-6 mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="beneficiary_address" id="beneficiary_address" name="beneficiary_address" style="height: 100px"></textarea>
                            <label for="beneficiary_address">Beneficiary Address</label>
                        </div>
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

            <div class="row step step-3" id="payment-gateway" style="display: none;">
                <div>
                    <h3>PAYMENT</h3>

                    <div class="col-6 mb-3">
                        <label for="guarantee_amount" class="form-label">Guarantee Amount<span class="text-danger">*</span></label>
                        <input class="form-control @error('guarantee_amount') is-invalid @enderror" type="text" id="guarantee_amount" name="guarantee_amount" placeholder="Enter Payment Guarantee Amount" value="{{ old('guarantee_amount') }}" required>
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
                        <button type="submit" class="btn btn-success">Payment Successful!</button>
                        <a href="{{route('customer-drafts.create')}}"> <button type="button" class="btn btn-danger">Payment Failed</button></a>
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
    <script>
        $(document).ready(function() {
            $('.next-button').click(function() {
                var currentStep = $(this).data('next') - 1;
                var nextStep = $(this).data('next');

                // Hide current step and show the next step
                $('.step').hide();
                $('.step-' + nextStep).show();
            });

            $('.prev-button').click(function() {
                var prevStep = $(this).data('prev');

                // Hide current step and show the previous step
                $('.step').hide();
                $('.step-' + prevStep).show();
            });

            $('#pay-button').click(function() {
                var amount = $('#guarantee-amount').val();
                if (amount === '') {
                    alert('Please enter the guarantee amount.');
                    $('#guarantee-amount').addClass('error');
                    return;
                }
                $('#guarantee-amount').removeClass('error');

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
        });
    </script>


</div>
@endsection