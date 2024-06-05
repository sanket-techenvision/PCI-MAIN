<!-- Service Subsub Cat Name Field -->
<div class="col-sm-12">
    {!! Form::label('service_subsub_cat_name', 'Service Subsub Cat Name:') !!}
    <p>{{ $serviceSubSubCategory->service_subsub_cat_name }}</p>
</div>

<!-- Service Subsub Cat Description Field -->
<div class="col-sm-12">
    {!! Form::label('service_subsub_cat_description', 'Service Subsub Cat Description:') !!}
    <p>{{ $serviceSubSubCategory->service_subsub_cat_description }}</p>
</div>

<!-- Service Subsub Cat Status Field -->
<div class="col-sm-12">
    {!! Form::label('service_subsub_cat_status', 'Service Subsub Cat Status:') !!}
    <p>{{ $serviceSubSubCategory->service_subsub_cat_status }}</p>
</div>

<!-- Service Sub Cat Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_sub_cat_id', 'Service Sub Cat Id:') !!}
    <p>{{ $serviceSubSubCategory->serviceSubCategory->service_sub_cat_name }}</p>
</div>

<!-- Service Subsub Cat Created By Field -->
<div class="col-sm-12">
    {!! Form::label('service_subsub_cat_created_by', 'Service Subsub Cat Created By:') !!}
    <p>{{ $serviceSubSubCategory->service_subsub_cat_created_by }}</p>
</div>

<!-- Service Subsub Cat Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('service_subsub_cat_updated_by', 'Service Subsub Cat Updated By:') !!}
    <p>{{ $serviceSubSubCategory->service_subsub_cat_updated_by }}</p>
</div>

