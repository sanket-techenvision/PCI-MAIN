<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="customer-drafts-table">
            <thead>
            <tr>
                <th>Service Category</th>
                <th>Service Sub Category</th>
                <th>Service Subsub Category</th>
                <th>Bank</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customerDrafts as $customerDrafts)
                <tr>
                    <td>{{ $customerDrafts->service_category }}</td>
                    <td>{{ $customerDrafts->service_sub_category }}</td>
                    <td>{{ $customerDrafts->service_subsub_category }}</td>
                    <td>{{ $customerDrafts->bank_name }}</td>
                    <td>{{ $customerDrafts->payment_status }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('customer-drafts.show', [$customerDrafts->id]) }}"
                               class='btn btn-default btn-xs'>
                               <i class="ri-eye-line"></i>
                            </a>
                            <!-- <a href="{{ route('customer-drafts.edit', [$customerDrafts->id]) }}"
                               class='btn btn-default btn-xs'>
                               <i class="ri-edit-box-line"></i>
                            </a> -->
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
