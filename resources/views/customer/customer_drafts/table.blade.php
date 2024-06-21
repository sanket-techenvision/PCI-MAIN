<div class="card-body p-1">
    <div class="table-responsive">
        <table class="table table-sm table-hover" id="basic-datatable">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Service Category</th>
                    <th>Service Sub Category</th>
                    <th>Service Subsub Category</th>
                    <th>Bank</th>
                    <th>Payment Status</th>
                    <th>Approval Status</th>
                    <th>Actions</th>
                    <th>Change Request</th>
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
                        
                        <td class="text-center align-middle" style="color: green"><i
                                class="ri-money-dollar-circle-line fs-3"></i></td>
                        {{-- Draft Status --}}
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-xs text-uppercase fs-6"
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
                            </button>
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
                                        class="btn btn-sm" style="background-color: #003cff; color: #fff;">
                                        <i class="ri-download-line"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                        {{-- Trigger change request modal --}}
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-primary fs-6" data-bs-toggle="modal"
                                data-id="{{ $customerDrafts->id }}" data-bs-target="#ChangeRequestModal"
                                data-approval-status = "{{ $customerDrafts->approval_status }}">
                                <i class="ri-arrow-up-down-line"></i>Change Request
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Chagne request modal --}}
    <div class="modal fade" id="ChangeRequestModal" tabindex="-1" aria-labelledby="ChangeRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-2">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ChangeRequestModalLabel">Change Request</h5>
                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fs-4">&times;</span></button>
                </div>
                <div class="ms-2" id="generatedContent" style="display: none;">
                    <a id="downloadLink" href="#"><i class="ri-file-word-line fs-2"></i> Download Draft in Word Format</a>
                </div>
                <form name="changerequestform" action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="modalDraftId" value=""></input>
                        <div class="mb-3">
                            <textarea class="form-control" name="chnageinrequest" id="chnageinrequest" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" accept="application/pdf">
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

    {{--   get draft id in modal --}}
    <script>
        var myModal = document.getElementById('ChangeRequestModal');
        myModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var draftId = button.getAttribute('data-id');
            var approvalStatus = button.getAttribute('data-approval-status');

            var modalDraftId = myModal.querySelector('#modalDraftId');
            var modalDraftIDInput = myModal.querySelector('#modalDraftId');
            modalDraftIDInput.value = draftId;

            // Update the download link dynamically
            var downloadLink = myModal.querySelector('#downloadLink');
            downloadLink.href = `/downloaddraftword/${draftId}`;

            // Show or hide elements based on approval status
            var generatedContent = myModal.querySelector('#generatedContent');
            if (approvalStatus === 'generated') {
                generatedContent.style.display = 'block';
            } else {
                generatedContent.style.display = 'none';
            }
        });
    </script>

</div>
