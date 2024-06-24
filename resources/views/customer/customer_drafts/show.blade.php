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
            overflow: hidden;
            /* Ensure pseudo-elements don't overflow */
            /* Uncomment for The ZigZag Border of Strip */
            /* --m:
                    conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) bottom/5px 51% repeat-x,
                    conic-gradient(from 135deg at top, #0000, #000 1deg 89deg, #0000 90deg) top/5px 51% repeat-x;
                -webkit-mask: var(--m);
                mask: var(--m); */
        }

        /* Status-specific background colors */
        .status-approved {
            background-color: #28a745;
            border: #28a745;
            color: #ffffff;
            /* Green */
        }

        .status-pending {
            background-color: #ffc107;
            border:#ffc107;
            color: #ffffff;
            /* Yellow */
        }

        .status-rejected {
            background-color: #dc3545;
            border:#ffc107;
            color: #ffffff;
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
        $approval_status = $customerDrafts->approval_status;
    @endphp
    <div class="content px-3">
        <div class="card p-2 position-relative" style="overflow: hidden;">
            <div
                class="status-ribbon text-capitalize
            @if ($approval_status == 'generated') status-approved 
            @elseif($approval_status == 'pending') status-pending 
            @elseif($approval_status == 'rejected') status-rejected @endif">
                {{ $approval_status }}
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($isRejected)
                        <h3 class="text-center text-uppercase">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal">View
                                Reason</button>
                        </h3>
                    @endif
                    @include('customer.customer_drafts.show_fields')
                </div>
            </div>
            @if ($isApproved)
                <div class="form-group text-center">
                    <a href="{{ route('customer-drafts.downloaddraft', [$customerDrafts->id]) }}" class="btn btn-primary status-approved">
                        Download Draft <i class="ri-download-line fs-3"></i>
                    </a>
                </div>
            @endif

        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="reasonModalLabel">Reason For Rejection</h5>
                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $customerDrafts->reason }}
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
