@extends('customer.layouts.app')

@section('content')
<section class="content-header p-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Customer Drafts Details
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary float-end" href="{{ route('customer-drafts.index') }}">
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
                @include('customer.customer_drafts.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection