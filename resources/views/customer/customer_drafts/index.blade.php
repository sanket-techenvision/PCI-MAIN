@extends('customer.layouts.app')
@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css'])
@endsection
@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Drafts</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-end" href="{{ route('customer-drafts.create') }}">
                        Apply
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="clearfix"></div>

        <div class="card p-1 border">
            @include('customer.customer_drafts.table')
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    @vite(['resources/js/pages/demo.datatable-init.js'])
@endsection
