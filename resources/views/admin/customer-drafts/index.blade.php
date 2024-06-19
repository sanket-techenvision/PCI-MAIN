@extends('admin.layouts.app')
@section('content')
    <style>
        .btn-group .btn {
            transition: transform 0.3s ease, box-shadow 0.2s ease;
            transform-origin: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0);
        }

        .btn-group .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="card p-3 m-1">
        <div class="table-responsive">
            <table class="table table-sm table-striped" id="customerdrafts">
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
                        <th>Approval Status</th>
                        <th>Action</th>
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
                            <td>{{ $draft['approval_status'] }}</td>
                            <td>
                                <div class='form-group text-center'>
                                    <div class='btn-group m-1'><a href="{{ route('admin.drafts.view', $draft['id']) }}"
                                            class="btn" style="background-color: #3e60d5; color: #fff;"><i
                                                class="ri-eye-line">View</i>
                                        </a>
                                    </div>
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
    </div>
@endsection
@section('datatable-script')
    <script>
        $(document).ready(function() {
            $('#customerdrafts').DataTable();
        });
    </script>
@endsection
