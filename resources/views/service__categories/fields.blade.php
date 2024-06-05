<!-- Service Category Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_name', 'Service Category Name:') !!}
    {!! Form::text('service_cat_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Category Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_description', 'Service Category Description:') !!}
    {!! Form::text('service_cat_description', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Category Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_status', 'Service Category Status:') !!}
    {!! Form::select('service_cat_status', ['' => 'Select Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control' , 'required']) !!}
</div>
