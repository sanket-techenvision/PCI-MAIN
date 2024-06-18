@extends('admin.layouts.app')
@section('content')
<style>
    .btn-group .btn {
    /* Other styles for your button */
    transition: transform 0.3s ease, box-shadow 0.2s ease; /* Smooth transition over 0.3 seconds */
    transform-origin: center; /* Ensure scaling originates from the center of the button */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0); /* Add a transparent box shadow for a smoother hover effect */
}

.btn-group .btn:hover {
    transform: scale(1.1); /* Scale the button on hover */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a slight box shadow on hover for depth */
}

</style>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table" id="customer-drafts-table">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Applicant Name</th>
                        <th>Applicant Country</th>
                        <th>Service</th>
                        <th>Sub Service</th>
                        <th>SubSub Service</th>
                        <th>Payment Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Approval Status</th>
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
                            <td>{{ $draft['applicant_country'] }}</td>
                            <td>{{ $draft['service_cat'] }}</td>
                            <td>{{ $draft['service_sub_cat'] }}</td>
                            <td>{{ $draft['service_subsub_cat'] }}</td>
                            <td>{{ $draft['payment_status'] }}</td>
                            <td>{{ $draft['date'] }}</td>
                            <td>
                                <div class='btn-group'>
                                    <a href="{{ route('customer-drafts.show', $draft['id']) }}" class="btn"
                                        style="background-color: #3e60d5; color: #fff;"><i class="ri-eye-line">View</i>
                                    </a>
                                    <a href="{{ route('customer-drafts.edit', $draft['id']) }}" class="btn" 
                                        style="background-color: #071de6; color: #fff;">Approve<i class="ri-check-line"></i>
                                    </a>
                                    <a href="{{ route('customer-drafts.edit', $draft['id']) }}" class="btn" 
                                        style="background-color: #e6072c; color: #fff;">Reject<i class="ri-close-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php
                            $srno++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right">
            </div>
        </div>
    </div>
@endsection
