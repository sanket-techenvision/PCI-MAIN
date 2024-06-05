<!-- Service Sub Category Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_sub_cat_name', 'Service Sub Category Name:') !!}
    {!! Form::text('service_sub_cat_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Sub Category Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_sub_cat_description', 'Service Sub Category Description:') !!}
    {!! Form::text('service_sub_cat_description', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
<!-- Service Cat Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_id', 'Service Category:') !!}
    {!! Form::select('service_cat_id', ['' => 'Select Service Category'] + $serviceCategories->pluck('service_cat_name', 'service_cat_id')->toArray(), null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Service Sub Category Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_sub_cat_status', 'Service Sub Category Status:') !!}
    {!! Form::select('service_sub_cat_status', ['' => 'Select Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control', 'required']) !!}
</div>




