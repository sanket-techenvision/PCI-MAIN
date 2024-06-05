@extends('layouts.vertical', ['page_title' => 'Services SubSub Category'])

@section('content')
<section class="content-header p-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1>
                    Service Sub Sub Category Details
                </h1>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-primary float-end" href="{{ route('serviceSubSubCategories.index') }}">
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
                @include('service_sub_sub_categories.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection