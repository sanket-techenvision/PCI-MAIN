<!-- Service Cat Name Field -->
<div class="col-sm-12">
    {!! Form::label('service_cat_name', 'Service Cat Name:') !!}
    <p>{{ $serviceCategory->service_cat_name }}</p>
</div>

<!-- Service Cat Description Field -->
<div class="col-sm-12">
    {!! Form::label('service_cat_description', 'Service Cat Description:') !!}
    <p>{{ $serviceCategory->service_cat_description }}</p>
</div>

<!-- Service Cat Status Field -->
<div class="col-sm-12">
    {!! Form::label('service_cat_status', 'Service Cat Status:') !!}
    <p>{{ $serviceCategory->service_cat_status }}</p>
</div>

<!-- Cat Created By Field -->
<div class="col-sm-12">
    {!! Form::label('cat_created_by', 'Cat Created By:') !!}
    <p>{{ $serviceCategory->cat_created_by }}</p>
</div>

<!-- Cat Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('cat_updated_by', 'Cat Updated By:') !!}
    <p>{{ $serviceCategory->cat_updated_by }}</p>
</div>

