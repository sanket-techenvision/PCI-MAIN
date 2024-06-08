<!-- Applicant First Name Field -->
<div class="col-sm-3">
    {!! Form::label('applicant_first_name', 'Applicant First Name:') !!}
    <p>{{ $customerDrafts->applicant_first_name }}</p>
</div>

<!-- Applicant Last Name Field -->
<div class="col-sm-3">
    {!! Form::label('applicant_last_name', 'Applicant Last Name:') !!}
    <p>{{ $customerDrafts->applicant_last_name }}</p>
</div>

<!-- Applicant Email Field -->
<div class="col-sm-3">
    {!! Form::label('applicant_email', 'Applicant Email:') !!}
    <p>{{ $customerDrafts->applicant_email }}</p>
</div>

<!-- Applicant Address Field -->
<div class="col-sm-3">
    {!! Form::label('applicant_address', 'Applicant Address:') !!}
    <p>{{ $customerDrafts->applicant_address }}</p>
</div>

<!-- Service Cat Id Field -->
<div class="col-sm-3">
    {!! Form::label('service_cat_id', 'Service Cat Id:') !!}
    <p>{{ $customerDrafts->service_cat_id }}</p>
</div>

<!-- Service Sub Cat Id Field -->
<div class="col-sm-3">
    {!! Form::label('service_sub_cat_id', 'Service Sub Cat Id:') !!}
    <p>{{ $customerDrafts->service_sub_cat_id }}</p>
</div>

<!-- Service Subsub Cat Id Field -->
<div class="col-sm-3">
    {!! Form::label('service_subsub_cat_id', 'Service Subsub Cat Id:') !!}
    <p>{{ $customerDrafts->service_subsub_cat_id }}</p>
</div>

<!-- Bank Id Field -->
<div class="col-sm-3">
    {!! Form::label('bank_id', 'Bank Id:') !!}
    <p>{{ $customerDrafts->bank_id }}</p>
</div>

<!-- Beneficiary First Name Field -->
<div class="col-sm-3">
    {!! Form::label('beneficiary_first_name', 'Beneficiary First Name:') !!}
    <p>{{ $customerDrafts->beneficiary_first_name }}</p>
</div>

<!-- Beneficiary Last Name Field -->
<div class="col-sm-3">
    {!! Form::label('beneficiary_last_name', 'Beneficiary Last Name:') !!}
    <p>{{ $customerDrafts->beneficiary_last_name }}</p>
</div>

<!-- Beneficiary Email Field -->
<div class="col-sm-3">
    {!! Form::label('beneficiary_email', 'Beneficiary Email:') !!}
    <p>{{ $customerDrafts->beneficiary_email }}</p>
</div>

<!-- Beneficiary Address Field -->
<div class="col-sm-3">
    {!! Form::label('beneficiary_address', 'Beneficiary Address:') !!}
    <p>{{ $customerDrafts->beneficiary_address }}</p>
</div>

<!-- Beneficiary Account No Field -->
<div class="col-sm-3">
    {!! Form::label('beneficiary_account_no', 'Beneficiary Account No:') !!}
    <p>{{ $customerDrafts->beneficiary_account_no }}</p>
</div>

<!-- Guarantee Amount Field -->
<div class="col-sm-3">
    {!! Form::label('guarantee_amount', 'Guarantee Amount:') !!}
    <p>{{ $customerDrafts->guarantee_amount }}</p>
</div>

<!-- Payment Status Field -->
<div class="col-sm-3">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    <p>{{ $customerDrafts->payment_status }}</p>
</div>
