<!-- Service Subsub Cat Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_subsub_cat_name', 'Service Subsub Cat Name:') !!}
    {!! Form::text('service_subsub_cat_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Subsub Cat Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_subsub_cat_description', 'Service Subsub Cat Description:') !!}
    {!! Form::text('service_subsub_cat_description', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
<!-- Service Sub Cat Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_sub_cat_id', 'Service Sub Category:') !!}
    {!! Form::select('service_sub_cat_id', $serviceSubCategories->pluck('service_sub_cat_name', 'service_sub_cat_id')->prepend('Select Category', ''), null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Service Subsub Cat Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_subsub_cat_status', 'Service Subsub Cat Status:') !!}
    {!! Form::select('service_subsub_cat_status', [
        '' => 'Select Status', 
        'active' => 'Active', 
        'inactive' => 'Inactive'
    ], null, ['class' => 'form-control', 'required']) !!}
</div>
