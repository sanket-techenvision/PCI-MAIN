<!-- Service Cat Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_name', 'Service Cat Name:') !!}
    {!! Form::text('service_cat_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Cat Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_description', 'Service Cat Description:') !!}
    {!! Form::text('service_cat_description', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Cat Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_cat_status', 'Service Cat Status:') !!}
    {!! Form::text('service_cat_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Cat Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cat_created_by', 'Cat Created By:') !!}
    {!! Form::text('cat_created_by', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Cat Updated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cat_updated_by', 'Cat Updated By:') !!}
    {!! Form::text('cat_updated_by', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>