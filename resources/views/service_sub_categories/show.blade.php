@extends('layouts.vertical', ['page_title'=>'Create Service_Sub_Category'])

@section('content')
<section class="content-header p-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Service Sub Category Details
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary float-end" href="{{ route('service_sub_categories.index') }}">
                    Back
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                @include('service_sub_categories.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection