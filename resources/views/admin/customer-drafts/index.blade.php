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
    <!-- <div class="modal modal-lg fade" id="ChangeRequestModal" tabindex="-1" aria-labelledby="ChangeRequestModalLabel"
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
    </div> -->

    <div class="modal modal-lg fade" id="ChangeRequestModal" tabindex="-1" aria-labelledby="ChangeRequestModalLabel" aria-hidden="true" data-draft-id="">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-2">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ChangeRequestModalLabel">Change Request</h5>
                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close"><span class="fs-4">&times;</span></button>
                </div>
                <div class="row justify-content-center">
                    <!-- chat area -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body py-2 px-3 border-bottom border-light">
                                <div class="row justify-content-between py-1">
                                    <div class="col-sm-7">
                                        <div class="d-flex align-items-start">
                                            <img src="/images/users/avatar-1.jpg" class="me-2 rounded-circle" height="36" alt="Admin">
                                            <div>
                                                <h5 class="my-0 font-15">
                                                    <a href="#" class="text-reset">Admin</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0" data-simplebar style="max-height: 200px;">
                                <ul class="conversation-list p-3" id="chat-messages">
                                    <!-- Chats -->
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <div class="bg-light p-3 rounded">
                                            <form class="needs-validation" novalidate="" name="chat-form" id="chat-form">
                                                <div class="row">
                                                    <div class="col mb-2 mb-sm-0">
                                                        <input type="hidden" name="draft_id" id="draft_id">
                                                        <input type="hidden" name="receiver_id" id="receiver_id" value="5">
                                                        <input type="text" class="form-control border-0" placeholder="Enter your text" name="message" required id="chat-message" />
                                                        @error('message')
                                                        <div class="invalid-feedback">
                                                            Please enter your message
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-light"><i class="ri-attachment-2"></i></a>
                                                            <button type="submit" class="btn btn-success chat-send w-100"><i class="ri-send-plane-2-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end chat area -->
                </div>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatModal = document.getElementById('ChangeRequestModal');
        const chatForm = document.getElementById('chat-form');
        const chatMessages = document.getElementById('chat-messages');
        const draftIdInput = document.getElementById('draft_id');
        const receiverIdInput = document.getElementById('receiver_id');
        const chatMessageInput = document.getElementById('chat-message');

        // Function to load chat messages for a specific draft
        function loadMessages(draftId) {
            fetch(`/chat/messages/${draftId}`)
                .then(response => response.json())
                .then(messages => {
                    chatMessages.innerHTML = '';
                    messages.forEach(message => {
                        const messageHtml = `
                            <li class="clearfix ${message.sender_id == {{ Auth::id() }} ? 'odd' : ''}">
                                <div class="chat-avatar">
                                    <img src="/images/users/avatar-1.jpg" class="rounded" alt="${message.sender.user_first_name}" />
                                    <i>${new Date(message.created_at).toLocaleTimeString()}</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>${message.sender.user_first_name}</i>
                                        <p>${message.message}</p>
                                    </div>
                                </div>
                                <div class="conversation-actions dropdown">
                                    <button class="btn btn-sm btn-link fs-18" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></button>
                                    <div class="dropdown-menu ${message.sender_id == {{ Auth::id() }} ? 'dropdown-menu-end' : ''}">
                                        <a class="dropdown-item" href="#">Copy Message</a>
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </li>`;
                        chatMessages.innerHTML += messageHtml;
                    });
                });
        }

        // Event listener for modal open
         // Event listener for modal open
        chatModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var draftId = button.getAttribute('data-id');
            var approvalStatus = button.getAttribute('data-approval-status');

            // Set the draft ID in the form input
            draftIdInput.value = draftId;

            // Load messages for this draft ID
            loadMessages(draftId);
        });

        // Handle sending chat messages
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(chatForm);
            fetch('/chat/send', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    chatForm.reset();
                    loadMessages(draftIdInput.value);
                });
        });
    });
    </script>
    @vite(['resources/js/pages/demo.datatable-init.js'])
@endsection
