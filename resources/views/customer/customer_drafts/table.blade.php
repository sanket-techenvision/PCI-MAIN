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
                            <div class="text-uppercase fs-6 p-1"
                                style="
                            @if ($customerDrafts->approval_status == 'pending') background-color: #ffc107 !important;
                                color: #fff;
                            @elseif ($customerDrafts->approval_status == 'generated')
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
                                    <a href="{{ route('customer-drafts.show', [$customerDrafts->id]) }}"
                                        class="btn btn-sm" style="background-color: #3e60d5; color: #fff;">
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
                        {{-- Trigger change request modal --}}
                        <td class="text-center align-middle">
                            <div class="btn-group">

                                @if ($customerDrafts->approval_status == 'generated')
                                    <button class="btn btn-sm fs-6 text-dark" style="background-color: #ffc107;"
                                        data-bs-toggle="modal" data-id="{{ $customerDrafts->id }}"
                                        data-bs-target="#ChangeRequestModal"
                                        data-approval-status = "{{ $customerDrafts->approval_status }}">
                                        <i class="ri-arrow-up-down-line"></i>Change Request
                                    </button>

                                    <button class="btn btn-sm btn-success fs-6" data-bs-toggle="modal"
                                        data-id="{{ $customerDrafts->id }}" data-bs-target="#confirmDraftModal"
                                        data-approval-status = "{{ $customerDrafts->approval_status }}">
                                        <i class="ri-arrow-up-line"></i>Confirm Draft
                                    </button>
                                @endif
                            </div>
                            {{-- Trigger 'Reason for rejection' modal (if rejected) --}}
                            @if ($customerDrafts->approval_status == 'rejected')
                                <h3 class="text-center text-uppercase">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
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
                        <input type="hidden" class="form-control" id="modalDraftId" name="draft_id" value=""></input>
                        <div class="mb-3">
                            <textarea class="form-control" name="chnageinrequest" id="chnageinrequest" rows="5" required></textarea>
                            <div id="chnageinrequest-error" class="text-danger" style="display: none;">The 'Change in
                                request' text-input is required.</div>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,image/*"
                                required>
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

    {{--  Confirm Draft Modal --}}
    <div class="modal fade" id="confirmDraftModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDraftModalLabel" aria-hidden="true">
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
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                                I accept the <a href="#" target="_blank">terms and conditions</a>
                            </label>
                        </div>
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
    <script>
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
    </script>

    {{-- Confirm Draft Script --}}
    <script>
        var confirmDraftModal = document.getElementById('confirmDraftModal');
        confirmDraftModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var draftId = button.getAttribute('data-id');
            var approvalStatus = button.getAttribute('data-approval-status');

            var draftIdInput = confirmDraftModal.querySelector('#draft-id');
            draftIdInput.value = draftId;
            var termsCheckbox = confirmDraftModal.querySelector('#termsCheckbox');
            var confirmButton = confirmDraftModal.querySelector('#confirmButton');
            termsCheckbox.checked = false;
            confirmButton.disabled = true;

            termsCheckbox.addEventListener('change', function() {
                confirmButton.disabled = !this.checked;
            });
        });
    </script>

    {{-- RejectedReason Modal Script --}}
    <script>
        var reasonModal = document.getElementById('reasonModal');
        reasonModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var rejectionReason = button.getAttribute('data-rejection-reason');

            var reasonBody = reasonModal.querySelector('#reason-body');
            reasonBody.textContent = rejectionReason;
        });
    </script>

    {{-- CKEditor Script --}}
    <script>
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
    </script>
    {{-- --------------------------------------- Scripts End ------------------------------------------ --}}
</div>
