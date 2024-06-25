@extends('layouts.vertical', ['page_title' => 'Services SubSub Category'])
@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css'])
@endsection
@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Sub Sub Categories</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-end"
                       href="{{ route('serviceSubSubCategories.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card p-2">
            @include('service_sub_sub_categories.table')
        </div>
    </div>
    @vite(['resources/js/pages/demo.datatable-init.js'])
@endsection
