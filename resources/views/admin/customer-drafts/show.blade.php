@extends('admin.layouts.app')
@section('content')
    <div class="card p-2 m-3">
        <div class="card-header h3 text-center bg-primary text-white">
            Applicantion Details
            <div class="">
                <a class="btn btn-primary float-end" href="{{ route('admin.drafts.index') }}">
                    Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Service Information Section -->
            <div class="row">
                <h3>Service Information</h3>
                <div class="col-lg-3">
                    <label for="service_cat_id">Service Category:</label>
                    <p>{{ $data->service_cat_id }}</p>
                </div>

                <div class="col-lg-3">
                    <label for="service_sub_cat_id">Service Sub Category:</label>
                    <p>{{ $data->service_sub_cat_id }}</p>
                </div>

                <div class="col-lg-3">
                    <label for="service_subsub_cat_id">Service Subsub Category:</label>
                    <p>{{ $data->service_subsub_cat_id }}</p>
                </div>

                <div class="col-lg-3">
                    <label for="bank_id">Issuing Bank:</label>
                    <p>{{ $data->bank_id }}</p>
                </div>

                <!-- Applicant Information Section -->
                <h3>Applicant Information</h3>
                <div class="col-lg-3">
                    <label for="applicant_first_name">Applicant First Name:</label>
                    <p>{{ $data->applicant_first_name }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="applicant_last_name">Applicant Last Name:</label>
                    <p>{{ $data->applicant_last_name }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="applicant_email">Applicant Email:</label>
                    <p>{{ $data->applicant_email }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="applicant_address">Applicant Address:</label>
                    <p>{{ $data->applicant_address }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="applicant_country">Applicant Country:</label>
                    <p>{{ $data->applicant_country }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="applicant_state">Applicant State:</label>
                    <p>{{ $data->applicant_state }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="applicant_city">Applicant City:</label>
                    <p>{{ $data->applicant_city }}</p>
                </div>

                <!-- Beneficiary Information Section -->
                <h3>Beneficiary Information</h3>
                <div class="col-lg-3">
                    <label for="beneficiary_first_name">Beneficiary First Name:</label>
                    <p>{{ $data->beneficiary_first_name }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_last_name">Beneficiary Last Name:</label>
                    <p>{{ $data->beneficiary_last_name }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_email">Beneficiary Email:</label>
                    <p>{{ $data->beneficiary_email }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_address">Beneficiary Address:</label>
                    <p>{{ $data->beneficiary_address }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_country">Beneficiary Country:</label>
                    <p>{{ $data->beneficiary_country }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_state">Beneficiary State:</label>
                    <p>{{ $data->beneficiary_state }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_city">Beneficiary City:</label>
                    <p>{{ $data->beneficiary_city }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="beneficiary_account_no">Beneficiary Account No:</label>
                    <p>{{ $data->beneficiary_account_no }}</p>
                </div>
                <div class="col-lg-3">
                    <label for="guarantee_amount">Guarantee Amount:</label>
                    <p>{{ $data->guarantee_amount }}</p>
                </div>

                <!-- Payment Information Section -->
                <h3>Payment Information</h3>
                <div class="col-lg-3">
                    <label for="payment_status">Payment Status:</label>
                    <p>{{ $data->payment_status }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <div class='form-group'>
                        {{-- <a href="{{ route('admin.drafts.approve', $data['id']) }}" class="btn"
                            style="background-color: #27AE60; color: #fff;">Approve<i class="ri-check-line"></i>
                        </a> --}}
                        {{-- <a href="{{ route('admin.drafts.reject', $data['id']) }}" class="btn"
                            style="background-color: #E74C3C; color: #fff;">Reject<i
                                class="ri-close-line"></i>
                        </a> --}}

                        <a href="#" class="btn" style="background-color: #27AE60; color: #fff;"
                            data-bs-toggle="modal" data-bs-target="#approveModal">
                            Approve<i class="ri-check-line"></i>
                        </a>
                        <button type="button" class="btn" style="background-color: #E74C3C; color: #fff;"
                            data-bs-toggle="modal" data-bs-target="#rejectModal">
                            Reject<i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approval Modal -->
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                        <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.drafts.approve', $data['id']) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="approve_notice">Any notice for customer? (optional)</label>
                                <input type="hidden" name="id" value="{{ $data['id'] }}" required>
                                <textarea class="form-control" id="approve_notice" name="approve_notice" rows="3"
                                    placeholder="Enter your notice for the customer here..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('admin.drafts.approve', $data['id']) }}" class="btn btn-primary">Approve</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- End -> Approval Modal -->

        {{-- Draft Reject Modal with Reason Field --}}
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="rejectModalLabel">Reject Draft</h5>
                        <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.drafts.reject') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reason">Reason for rejection:</label>
                                <input type="hidden" name="id" value="{{ $data['id'] }}" required>
                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
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
        {{-- End -> Draft Reject Modal with Reason Field --}}
    </div>

    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    {{-- Loader Before Window Load and at data submission --}}
    <script>
        $(window).on('load', function() {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Function to show the preloader
            function showLoader() {
                document.getElementById('preloader').style.display = 'block';
                document.getElementById('status').style.display = 'block';
            }

            // Function to hide the preloader
            function hideLoader() {
                document.getElementById('preloader').style.display = 'none';
                document.getElementById('status').style.display = 'none';
            }

            // Show the loader initially on page load
            showLoader();

            // Get the approval form
            const approveForm = document.querySelector('#approveModal form');
            if (approveForm) {
                approveForm.addEventListener('submit', function(event) {
                    showLoader();
                });
            }

            // Get the reject form
            const rejectForm = document.querySelector('#rejectModal form');
            if (rejectForm) {
                rejectForm.addEventListener('submit', function(event) {
                    showLoader();
                });
            }

            // Optionally, you can hide the loader when the modal is closed
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    hideLoader();
                });
            });
        });
    </script>
@endsection
