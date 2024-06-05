@extends('layouts.vertical', ['page_title'=>'Banks'])

@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Banks</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-end"
                       href="{{ route('banks.create') }}">
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
            @include('banks.table')
        </div>
    </div>

@endsection
