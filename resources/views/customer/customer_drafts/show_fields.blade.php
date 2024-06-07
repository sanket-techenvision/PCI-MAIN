

<!-- Service Cat Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_cat_id', 'Service Cat Id:') !!}
    <p>{{ $customerDrafts->service_category }}</p>
</div>

<!-- Service Sub Cat Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_sub_cat_id', 'Service Sub Cat Id:') !!}
    <p>{{ $customerDrafts->service_sub_category }}</p>
</div>

<!-- Service Subsub Cat Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_subsub_cat_id', 'Service Subsub Cat Id:') !!}
    <p>{{ $customerDrafts->service_subsub_category }}</p>
</div>

<!-- Bank Id Field -->
<div class="col-sm-12">
    {!! Form::label('bank_id', 'Bank Id:') !!}
    <p>{{ $customerDrafts->bank_name }}</p>
</div>

<!-- Payment Status Field -->
<div class="col-sm-12">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    <p>{{ $customerDrafts->payment_status }}</p>
</div>

