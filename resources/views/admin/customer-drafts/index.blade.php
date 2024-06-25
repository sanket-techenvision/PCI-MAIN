@extends('admin.layouts.app')
@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css'])
@endsection
@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Drafts</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="clearfix"></div>
        <div class="card p-1 border">
            <div class="card-body p-1">
                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Applicant Name</th>
                                <th>Service</th>
                                <th>Sub Service</th>
                                <th>SubSub Service</th>
                                <th>Payment Status</th>
                                <th>Date</th>
                                <th>Draft Status</th>
                                <th>Action</th>
                                <th>Change Request/Confirm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $srno = 1;
                            @endphp
                            @foreach ($data as $draft)
                                <tr>
                                    <td>{{ $srno }}</td>
                                    <td>{{ $draft['applicant_first_name'] }} {{ $draft['applicant_last_name'] }}</td>
                                    <td>{{ $draft['service_cat'] }}</td>
                                    <td>{{ $draft['service_sub_cat'] }}</td>
                                    <td>{{ $draft['service_subsub_cat'] }}</td>
                                    <td class="align-middle text-center">
                                        @if ($draft['payment_status'] == 'success')
                                            <i class="ri-money-dollar-circle-line fs-3 text-success"></i>
                                        @endif
                                    </td>
                                    <td>{{ $draft['date'] }}</td>
                                    <td class="align-middle text-center text-capitalize">
                                        <div class="text-uppercase fs-6 p-1"
                                            style="
                                        @if ($draft['approval_status'] == 'Pending') background-color: #ffc107 !important;
                                            color: #fff;
                                        @elseif ($draft['approval_status'] == 'generated')
                                            background-color: #27ae60 !important;
                                            color: #fff;
                                        @elseif ($draft['approval_status'] == 'rejected')
                                            background-color: #e74c3c !important;
                                            color: #fff; @endif">
                                            {{ $draft['approval_status'] }}
                                        </div>
                                    </td>
                                    {{-- View / Download Draft --}}
                                    <td class="align-middle text-center">
                                        <div class='form-group text-center'>
                                            <div class='btn-group m-1'>
                                                @if ($draft['approval_status'] != 'generated')
                                                    <a href="{{ route('admin.drafts.view', $draft['id']) }}"
                                                        class="btn btn-sm fs-6"
                                                        style="background-color: #3e60d5; color: #fff;"><i
                                                            class="ri-eye-line"></i>
                                                    </a>
                                                @endif
                                                @if ($draft['approval_status'] == 'generated')
                                                    <button type="button" class="btn btn-sm fs-6"
                                                        style="background-color: #3e60d5; color: #fff;"
                                                        data-draft-id="{{ $draft['id'] }}" data-bs-toggle="modal"
                                                        data-bs-target="#downloadModal">
                                                        <i class="ri-download-line"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Trigger change request modal / View Reason --}}
                                    <td class="align-middle text-center">
                                        <div class="btn-group">
                                            @if ($draft['approval_status'] == 'generated' && $draft['applicant_confirmation'] != 'Confirmed')
                                                <button class="btn btn-sm fs-6 text-dark" style="background-color: #ffc107;"
                                                    data-bs-toggle="modal" data-id="{{ $draft['id'] }}"
                                                    data-bs-target="#ChangeRequestModal"
                                                    data-approval-status = "{{ $draft['approval_status'] }}">
                                                    <i class="ri-arrow-up-down-line"></i>Change Request
                                                </button>
                                            @endif
                                            @if ($draft['applicant_confirmation'] == 'Confirmed')
                                                <button type="button" class="btn btn-sm btn-success">
                                                    {{$draft['applicant_confirmation']}}
                                                </button>
                                            @endif
                                        </div>
                                        {{-- Trigger 'Reason for rejection' modal (if rejected) --}}
                                        {{-- @if ($draft['approval_status'] == 'rejected')
                                            <h3 class="text-center text-uppercase">
                                                <button class="btn btn-sm btn-primary fs-6" data-bs-toggle="modal"
                                                    data-bs-target="#reasonModal" data-id="{{ $draft['id'] }}"
                                                    data-approval-status="{{ $draft['approval_status'] }}"
                                                    data-rejection-reason="{{ $draft['reason'] }}">View
                                                    Reason</button>
                                            </h3>
                                        @endif --}}
                                    </td>
                                </tr>
                                @php
                                    $srno++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Drafat Modal -->
    <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="downloadModalLabel">Download Draft</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <a id="pdfDownloadLink" href="#" class="btn btn-sm fs-6 btn-primary">
                                        <img src="https://www.freeiconspng.com/uploads/download-16x16-pdf-icon-png-3.png"
                                            alt="PDF" class="img-fluid mb-2 w-50">
                                        <h5><i class="ri-download-line"></i> Download as PDF</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <a id="docDownloadLink" href="#" class="btn btn-sm fs-6 btn-primary">
                                        <img src="https://www.freeiconspng.com/uploads/word-icon-omnom-icons-softicons-com-4.png"
                                            alt="DOC" class="img-fluid mb-2 w-50">
                                        <h5><i class="ri-download-line"></i> Download as DOC</h5>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Download Drafat Modal -->

    {{-- Chagne request modal --}}
    <div class="modal modal-lg fade" id="ChangeRequestModal" tabindex="-1" aria-labelledby="ChangeRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-2">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ChangeRequestModalLabel">Change Request</h5>
                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fs-4">&times;</span></button>
                </div>
                <form name="changerequestform" action="changerequestform" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="modalDraftId" name="draft_id"
                            value=""></input>
                        {{-- <div class="mb-3">
                                <textarea class="form-control" name="chnageinrequest" id="chnageinrequest" rows="5" required></textarea>
                                <div id="chnageinrequest-error" class="text-danger" style="display: none;">The 'Change in
                                    request' text-input is required.</div>
                            </div> --}}
                        <div class="mb-3">
                            <input type="file" class="form-control" id="file" name="file"
                                accept=".pdf,.doc,.docx,image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End modal --}}
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var downloadModal = document.getElementById('downloadModal');
            downloadModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget;
                // Extract info from data-* attributes
                var draftId = button.getAttribute('data-draft-id');
                // Update the modal's content with the draft ID
                var pdfDownloadLink = document.getElementById('pdfDownloadLink');
                var docDownloadLink = document.getElementById('docDownloadLink');

                pdfDownloadLink.href = '{{ route('admin.drafts.downloaddraft', ':id') }}'.replace(':id',
                    draftId);
                docDownloadLink.href = '{{ route('admin.drafts.downloaddraftword', ':id') }}'.replace(
                    ':id', draftId);
            });
        });
    </script>
    @vite(['resources/js/pages/demo.datatable-init.js'])
@endsection
