@extends('customer.layouts.app')

@section('content')
<style>
    .status-ribbon {
        text-align: center;
        position: absolute;
        top: 80px;
        right: -30px;
        color: white;
        padding: 5px 80px;
        border-radius: 3px;
        font-weight: bold;
        z-index: 1;
        transform: rotate(30deg);
        transform-origin: top right;
        overflow: hidden; /* Ensure pseudo-elements don't overflow */
        /* Uncomment for The ZigZag Border of Strip */
        /* --m:
            conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) bottom/5px 51% repeat-x,
            conic-gradient(from 135deg at top, #0000, #000 1deg 89deg, #0000 90deg) top/5px 51% repeat-x;
        -webkit-mask: var(--m);
        mask: var(--m); */
    }

    /* Fold effect */


    /* Status-specific background colors */
    .status-approved {
        background-color: #28a745;
        /* Green */
    }

    .status-pending {
        background-color: #ffc107;
        /* Yellow */
    }

    .status-rejected {
        background-color: #dc3545;
        /* Red */
    }
</style>
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
@php
$approval_status = 'Pending';
@endphp
<div class="content px-3">
    <div class="card p-2 position-relative"  style="overflow: hidden;">
        <div class="status-ribbon 
            @if($approval_status == 'Approved') status-approved 
            @elseif($approval_status == 'Pending') status-pending 
            @elseif($approval_status == 'Rejected') status-rejected  
            @endif">
            {{$approval_status}}
        </div>
        <div class="card-body">
            <div class="row">
                @include('customer.customer_drafts.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection