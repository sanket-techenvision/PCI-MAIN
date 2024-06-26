<style>
    .file-input {
        display: none;
    }

    #attachment-preview {
        z-index: 1050;
        background: rgba(255, 255, 255, 0.9);
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        margin: 0 auto;
        text-align: center;
        top: 10px;
        left: 50%;
    }
</style>
<div class="card-body p-1">
    <div class="table-responsive">
        <table class="table table-sm table-hover" id="basic-datatable">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Service Category</th>
                    <th>Service Sub Category</th>
                    <th>Service Subsub Category</th>
                    <th>Issuing Bank</th>
                    <th>Payment Status</th>
                    <th>Draft Status</th>
                    <th>Actions</th>
                    <th>Change Request/Confirm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customerDrafts as $customerDrafts)
                    <tr>
                        <td>{{ $customerDrafts->srno }}</td>
                        <td>{{ $customerDrafts->service_category }}</td>
                        <td>{{ $customerDrafts->service_sub_category }}</td>
                        <td>{{ $customerDrafts->service_subsub_category }}</td>
                        <td>{{ $customerDrafts->bank_name }}</td>

                        <td class="text-center align-middle" style="color: green">
                            <i class="ri-money-dollar-circle-line fs-3"></i>
                        </td>
                        {{-- Draft Status --}}
                        <td class="text-center align-middle">
                            <div class="text-uppercase fs-6 p-1" style="
                                    @if ($customerDrafts->approval_status == 'Pending') background-color: #ffc107 !important;
                                        color: #fff;
                                    @elseif ($customerDrafts->approval_status == 'generated' && $customerDrafts->applicant_confirmation != 'confirmed')
                                        background-color: #27ae60 !important;
                                        color: #fff;
                                    @elseif ($customerDrafts->approval_status == 'rejected')
                                        background-color: #e74c3c !important;
                                    color: #fff; @endif">
                                {{ $customerDrafts->approval_status }}
                            </div>
                        </td>
                        {{-- View/download Draft --}}
                        <td class="text-center align-middle">
                            <div class='btn-group'>
                                @if ($customerDrafts->approval_status != 'generated')
                                    <a href="{{ route('customer-drafts.show', [$customerDrafts->id]) }}" class="btn btn-sm"
                                        style="background-color: #3e60d5; color: #fff;">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                @endif
                                @if ($customerDrafts->approval_status == 'generated')
                                    <a href="{{ route('customer-drafts.downloaddraft', [$customerDrafts->id]) }}"
                                        class="btn btn-sm" style="background-color: #3e60d5; color: #fff;">
                                        <i class="ri-download-line"></i>
                                    </a>
                                @endif
                            </div>
                        </td>

                        <td class="text-center align-middle">
                            <div class="btn-group">
                                {{-- Trigger change request modal --}}
                                @if ($customerDrafts->approval_status == 'generated' && $customerDrafts->applicant_confirmation != 'Confirmed')
                                    <button class="btn btn-sm fs-6 text-dark" style="background-color: #ffc107;"
                                        data-bs-toggle="modal" data-id="{{ $customerDrafts->id }}"
                                        data-bs-target="#ChangeRequestModal"
                                        data-approval-status="{{ $customerDrafts->approval_status }}">
                                        <i class="ri-arrow-up-down-line"></i>Change Request
                                    </button>
                                    <button class="btn btn-sm btn-success fs-6" data-bs-toggle="modal"
                                        data-id="{{ $customerDrafts->id }}" data-bs-target="#confirmDraftModal"
                                        data-approval-status="{{ $customerDrafts->approval_status }}">
                                        <i class="ri-arrow-up-line"></i>Confirm Draft
                                    </button>
                                @elseif($customerDrafts->approval_status == 'generated' && $customerDrafts->applicant_confirmation == 'Confirmed')
                                    {{-- Trigger Confirmation modal --}}
                                    <button class="btn btn-sm btn-success fs-6">
                                        <i class="ri-check-line"></i> {{$customerDrafts->applicant_confirmation}}
                                    </button>
                                @endif
                            </div>
                            {{-- Trigger 'Reason for rejection' modal (if rejected) --}}
                            @if ($customerDrafts->approval_status == 'rejected')
                                <h3 class="text-center text-uppercase">
                                    <button class="btn btn-primary btn-sm fs-6" data-bs-toggle="modal"
                                        data-bs-target="#reasonModal" data-id="{{ $customerDrafts->id }}"
                                        data-approval-status="{{ $customerDrafts->approval_status }}"
                                        data-rejection-reason="{{ $customerDrafts->reason }}">View
                                        Reason</button>
                                </h3>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ---------------------------------------------------------------------------------------------- --}}
    {{-- --------------------------------------- Modals ----------------------------------------------- --}}
    {{-- Rejection Reason Modal --}}
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
                <div class="modal-body" id="reason-body">
                </div>
            </div>
        </div>
    </div>

    {{-- Chagne request modal --}}
    <!-- <div class="modal modal-lg fade" id="ChangeRequestModal" tabindex="-1" aria-labelledby="ChangeRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-2">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ChangeRequestModalLabel">Change Request</h5>
                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close"><span class="fs-4">&times;</span></button>
                </div>
                <div class="row justify-content-center">

                    <div class="col-xl-3 col-lg-4">
                        <form name="changerequestform" action="changerequestform" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="modalDraftId" name="draft_id" value=""></input>
                                <div class="mb-3">
                                    <textarea class="form-control" name="chnageinrequest" id="chnageinrequest" rows="5" required></textarea>
                                    <div id="chnageinrequest-error" class="text-danger" style="display: none;">The 'Change in
                                        request' text-input is required.</div>
                                </div>
                                <div class="mb-3">
                                    <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,image/*" required>
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
        </div>
    </div> -->

    {{-- Change request modal --}}
    <div class="modal modal-lg fade" id="ChangeRequestModal" tabindex="-1" aria-labelledby="ChangeRequestModalLabel"
        aria-hidden="true" data-draft-id="">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-2">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ChangeRequestModalLabel">Change Request</h5>
                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fs-4">&times;</span></button>
                </div>
                <div class="row justify-content-center">
                    <!-- chat area -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body py-2 px-3 border-bottom border-light">
                                <div class="row justify-content-between py-1">
                                    <div class="col-sm-7">
                                        <div class="d-flex align-items-start">
                                            <img src="/images/users/avatar-1.jpg" class="me-2 rounded-circle"
                                                height="36" alt="Admin">
                                            <div>
                                                <h5 class="my-0 font-15">
                                                    <a href="#" class="text-reset">Admin</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="attachment-preview" class="mt-2" style="display:none"></div>
                            <div class="card-body p-0" id="chat-scroll" data-simplebar data-simplebar-primary style="max-height: 200px;">
                                <ul class="conversation-list p-3" id="chat-messages" >
                                    <!-- Chats -->
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <div class="bg-light p-3 rounded">
                                            <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                                                <div class="row">
                                                    <div class="col mb-2 mb-sm-0">
                                                        <input type="hidden" name="draft_id" id="draft_id">
                                                        <input type="hidden" name="receiver_id" id="receiver_id"
                                                            value="8">
                                                        <input type="text" class="form-control border-0"
                                                            placeholder="Enter your text" name="message" required
                                                            id="chat-message" />
                                                        @error('message')
                                                            <div class="invalid-feedback">
                                                                Please enter your message
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-light" id="icon-click"><i
                                                                    class="ri-attachment-2"></i></a>
                                                            <input type="file" class="file-input" id="file-input"
                                                                name="attachment"
                                                                accept="application/pdf, image/*, .docx" max="5120">
                                                            <button type="submit"
                                                                class="btn btn-success chat-send w-100"><i
                                                                    class="ri-send-plane-2-line"></i></button>
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

</div>
{{-- End modal --}}

{{-- Confirm Draft Modal --}}
<div class="modal fade" id="confirmDraftModal" tabindex="-1" role="dialog" aria-labelledby="confirmDraftModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmDraftModalLabel">Confirm Draft</h5>
                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="confirmDraftForm" id="confirmDraftForm" action="/cofirmDraft" method="post">
                    @csrf
                    <input type="hidden" name="draft_id" id="draft-id" value="">
                    <p>Are you sure you want to confirm this draft?</p>
                    <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                        <label class="form-check-label" for="termsCheckbox">
                            I accept the <a href="#" target="_blank">terms and conditions</a>
                        </label>
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- --------------------------------------- Modals End ------------------------------------------- --}}


{{-- ---------------------------------------------------------------------------------------------- --}}
{{-- --------------------------------------- Scripts ---------------------------------------------- --}}
{{-- Change request modal Script --}}
<!-- <script>
    var myModal = document.getElementById('ChangeRequestModal');
    myModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var draftId = button.getAttribute('data-id');
        var approvalStatus = button.getAttribute('data-approval-status');

        var modalDraftId = myModal.querySelector('#modalDraftId');
        var modalDraftIDInput = myModal.querySelector('#modalDraftId');
        modalDraftIDInput.value = draftId;

        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
        // Clear other form inputs
        document.querySelector('[name="file"]').value = '';
        document.getElementById('chnageinrequest-error').style.display = 'none';
    });
</script> -->
{{--<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatModal = document.getElementById('ChangeRequestModal');
        const chatForm = document.getElementById('chat-form');
        const chatMessages = document.getElementById('chat-messages');
        const draftIdInput = document.getElementById('draft_id');
        const receiverIdInput = document.getElementById('receiver_id');
        const chatMessageInput = document.getElementById('chat-message');
        const fileInput = document.getElementById('file-input');
        const attachmentPreview = document.getElementById('attachment-preview');

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
                                    </div>`;
                        if (message.attachment) {
                            const attachmentPath = `/storage/${message.attachment}`;
                            const fileExtension = message.attachment.split('.').pop().toUpperCase();
                            messageHtml += `
                            <div class="card mt-2 mb-1 shadow-none border text-start">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-primary rounded">
                                                    ${fileExtension}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col ps-0">
                                            <a href="${attachmentPath}" class="text-muted fw-bold" target="_blank">${message.attachment.split('/').pop()}</a>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="${attachmentPath}" class="btn btn-link btn-lg text-muted" download>
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        messageHtml += `
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
        chatModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var draftId = button.getAttribute('data-id');
            var approvalStatus = button.getAttribute('data-approval-status');

            document.getElementById('icon-click').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default action for the link
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                attachmentPreview.innerHTML = ''; // Clear previous preview
                const file = this.files[0];
                if (file) {
                    const fileReader = new FileReader();
                    fileReader.onload = function (e) {
                        const fileUrl = e.target.result;
                        let previewHtml;
                        if (file.type.startsWith('image/')) {
                            previewHtml = `<img src="${fileUrl}" class="img-thumbnail" alt="Attachment" style="max-width: 200px; max-height: 200px;">`;
                        } else if (file.type === 'application/pdf') {
                            previewHtml = `<embed src="${fileUrl}" type="application/pdf" width="200" height="200">`;
                        } else {
                            previewHtml = `<a href="${fileUrl}" target="_blank">${file.name}</a>`;
                        }
                        attachmentPreview.innerHTML = previewHtml;
                        attachmentPreview.style.display = 'block'; // Show the attachment preview
                        chatMessages.style.display = 'none'; // Hide the chat messages
                    };
                    fileReader.readAsDataURL(file);
                }
            });

            // Set the draft ID in the form input
            draftIdInput.value = draftId;

            // Load messages for this draft ID
            loadMessages(draftId);
        });

        // Handle sending chat messages
        chatForm.addEventListener('submit', function (e) {
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
                    attachmentPreview.innerHTML = ''; // Clear the preview after sending
                    attachmentPreview.style.display = 'none'; // Hide the attachment preview
                    fileInput.value = ''; // Clear the file input
                    chatMessages.style.display = 'block'; // Show the chat messages
                    loadMessages(draftIdInput.value);
                });
        });
    });
</script>--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const chatModal = document.getElementById('ChangeRequestModal');
    const chatForm = document.getElementById('chat-form');
    const chatMessages = document.getElementById('chat-messages');
    const draftIdInput = document.getElementById('draft_id');
    const receiverIdInput = document.getElementById('receiver_id');
    const chatMessageInput = document.getElementById('chat-message');
    const fileInput = document.getElementById('file-input');
    const attachmentPreview = document.getElementById('attachment-preview');

    // Function to load chat messages for a specific draft
    function loadMessages(draftId) {
        fetch(`/chat/messages/${draftId}`)
            .then(response => response.json())
            .then(messages => {
                chatMessages.innerHTML = '';
                messages.forEach(message => {
                    let messageHtml = `
                        <li class="clearfix ${message.sender_id == {{ Auth::id() }} ? 'odd' : ''}">
                            <div class="chat-avatar">
                                <img src="/images/users/avatar-1.jpg" class="rounded" alt="${message.sender.user_first_name}" />
                                <i>${new Date(message.created_at).toLocaleTimeString()}</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>${message.sender.user_first_name}</i>`;

                    if (message.message) {
                        messageHtml += `<p>${message.message}</p>`;
                    }
                    
                    if (message.attachment) {
                        const attachmentPath = `/storage/${message.attachment}`;
                        const fileName = message.attachment.split('/').pop(); // Extract file name
                        const fileExtension = fileName.split('.').pop().toUpperCase(); // Extract file extension
                        messageHtml += ` </div>
                            <div class="card mt-2 mb-1 shadow-none border text-start">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-primary rounded">
                                                    ${fileExtension}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col ps-0">
                                            <a href="${attachmentPath}" class="text-muted fw-bold" target="_blank">${fileName}</a>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="${attachmentPath}" class="btn btn-link btn-lg text-muted" download="${fileName}">
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    }

                    messageHtml += `
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
    chatModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var draftId = button.getAttribute('data-id');
        var approvalStatus = button.getAttribute('data-approval-status');

        document.getElementById('icon-click').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action for the link
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileReader = new FileReader();
                fileReader.onload = function(e) {
                    const fileUrl = e.target.result;
                    let previewHtml;
                    if (file.type.startsWith('image/')) {
                        previewHtml = `<img src="${fileUrl}" class="img-thumbnail" alt="Attachment" style="max-width: 200px; max-height: 200px;">`;
                    } else if (file.type === 'application/pdf') {
                        previewHtml = `<embed src="${fileUrl}" type="application/pdf" width="200" height="200">`;
                    } else {
                        previewHtml = `<a href="${fileUrl}" target="_blank">${file.name}</a>`;
                    }
                    attachmentPreview.innerHTML = previewHtml;
                    attachmentPreview.style.display = 'block'; // Show the attachment preview
                    chatMessages.style.display = 'none'; // Hide the chat messages
                };
                fileReader.readAsDataURL(file);
            }
        });

        // Set the draft ID in the form input
        draftIdInput.value = draftId;

        // Load messages for this draft ID
        loadMessages(draftId);
    });
    // Event listener for modal close
    chatModal.addEventListener('hide.bs.modal', function() {
        attachmentPreview.innerHTML = ''; // Clear the preview
        attachmentPreview.style.display = 'none'; // Hide the attachment preview
        fileInput.value = ''; // Clear the file input
        chatMessages.style.display = 'block'; // Show the chat messages
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
                attachmentPreview.innerHTML = ''; // Clear the preview after sending
                attachmentPreview.style.display = 'none'; // Hide the attachment preview
                fileInput.value = ''; // Clear the file input
                chatMessages.style.display = 'block'; // Show the chat messages
                loadMessages(draftIdInput.value);
            });
    });
});

</script>

{{-- Confirm Draft Script --}}
<script>
    var confirmDraftModal = document.getElementById('confirmDraftModal');
    confirmDraftModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var draftId = button.getAttribute('data-id');
        var approvalStatus = button.getAttribute('data-approval-status');

        var draftIdInput = confirmDraftModal.querySelector('#draft-id');
        draftIdInput.value = draftId;
        var termsCheckbox = confirmDraftModal.querySelector('#termsCheckbox');
        var confirmButton = confirmDraftModal.querySelector('#confirmButton');
        termsCheckbox.checked = false;
        confirmButton.disabled = true;

        termsCheckbox.addEventListener('change', function () {
            confirmButton.disabled = !this.checked;
        });
    });
</script>

{{-- RejectedReason Modal Script --}}
<script>
    var reasonModal = document.getElementById('reasonModal');
    reasonModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var rejectionReason = button.getAttribute('data-rejection-reason');

        var reasonBody = reasonModal.querySelector('#reason-body');
        reasonBody.textContent = rejectionReason;
    });
</script>

{{-- CKEditor Script --}}
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('chnageinrequest');

        // Ensure CKEditor content is updated in the textarea before form submission
        document.forms['changerequestform'].addEventListener('submit', function() {
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            var chnageinrequestContent = CKEDITOR.instances['chnageinrequest'].getData().trim();
            if (!chnageinrequestContent) {
                document.getElementById('chnageinrequest-error').style.display = 'block';
                event.preventDefault();
            } else {
                document.getElementById('chnageinrequest-error').style.display = 'none';
            }
        });
    });
</script> -->
{{-- --------------------------------------- Scripts End ------------------------------------------ --}}