@extends('layouts.vertical', ['page_title'=> 'Service_Sub_Category'])

@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service  Sub  Categories</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-end"
                       href="{{ route('service_sub_categories.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('service_sub_categories.table')
        </div>
    </div>

@endsection
