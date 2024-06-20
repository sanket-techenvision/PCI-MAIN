<div class="card-body p-1">
    <div class="table-responsive">
        <table class="table table-sm" id="basic-datatable">
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
                        <td style="color:green">{{ $customerDrafts->payment_status }}</td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-sm text-uppercase fs-6"
                                style="
                            @if ($customerDrafts->approval_status == 'pending') background-color: #ffc107 !important;
                                color: #fff;
                            @elseif ($customerDrafts->approval_status == 'approved')
                                background-color: #27ae60 !important;
                                color: #fff;
                            @elseif ($customerDrafts->approval_status == 'rejected')
                                background-color: #e74c3c !important;
                                color: #fff; @endif">
                                {{ $customerDrafts->approval_status }}
                            </button>
                        </td>
                        <td class="text-center align-middle">
                            <div class='btn-group'>
                                <a href="{{ route('customer-drafts.show', [$customerDrafts->id]) }}" class="btn btn-sm"
                                    style="background-color: #3e60d5; color: #fff;">
                                    <i class="ri-eye-line"></i>View
                                </a>
                                @if ($customerDrafts->approval_status == 'approved')
                                    <a href="{{ route('customer-drafts.downloaddraft', [$customerDrafts->id]) }}"
                                        class="btn btn-sm" style="background-color: #003cff; color: #fff;">
                                        <i class="ri-file-download-line"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
        </div>
    </div>
</div>
