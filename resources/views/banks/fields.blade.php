<!-- Bank Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_name', 'Bank Name:') !!}
    {!! Form::text('bank_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Bank Applicant Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_applicant', 'Bank Applicant:') !!}
    {!! Form::text('bank_applicant', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Bank Swift Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_swift_code', 'Bank Swift Code:') !!}
    {!! Form::text('bank_swift_code', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Bank Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_address', 'Bank Address:') !!}
    {!! Form::text('bank_address', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Bank Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_country', 'Bank Country:') !!}
    {!! Form::text('bank_country', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('service_sub_cat_id', 'Select Service Subcategories:') !!}
    {!! Form::select('service_sub_cat_id[]', 
        $serviceSubCategories->prepend('Select Category', ''), 
        null, 
        ['class' => 'form-control', 'required', 'multiple' => 'multiple']) 
    !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('draftType_id', 'Select Draft Types Available:') !!}
    {!! Form::select('draftType_id[]', 
        $draftTypes->prepend('Select Draft Types', ''), 
        null, 
        ['class' => 'form-control', 'required', 'multiple' => 'multiple']) 
    !!}
</div>


<!-- Bank Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_status', 'Bank Status:') !!}
    {!! Form::text('bank_status', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
