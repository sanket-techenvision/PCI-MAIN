<!-- Bank Name Field -->
<div class="col-sm-12">
    {!! Form::label('bank_name', 'Bank Name:') !!}
    <p>{{ $banks->bank_name }}</p>
</div>

<!-- Bank Applicant Field -->
<div class="col-sm-12">
    {!! Form::label('bank_applicant', 'Bank Applicant:') !!}
    <p>{{ $banks->bank_applicant }}</p>
</div>

<!-- Bank Swift Code Field -->
<div class="col-sm-12">
    {!! Form::label('bank_swift_code', 'Bank Swift Code:') !!}
    <p>{{ $banks->bank_swift_code }}</p>
</div>

<!-- Bank Address Field -->
<div class="col-sm-12">
    {!! Form::label('bank_address', 'Bank Address:') !!}
    <p>{{ $banks->bank_address }}</p>
</div>

<!-- Bank Country Field -->
<div class="col-sm-12">
    {!! Form::label('bank_country', 'Bank Country:') !!}
    <p>{{ $banks->bank_country }}</p>
</div>

<!-- Bank Status Field -->
<div class="col-sm-12">
    {!! Form::label('bank_status', 'Bank Status:') !!}
    <p>{{ $banks->bank_status }}</p>
</div>

