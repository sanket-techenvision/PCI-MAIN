<h3 for="BENEFICIARY DETAILS">BENEFICIARY DETAILS</h3>
<div class="row">
    <div class="col-6 mb-3">
        <label for="beneficiary_first_name" class="form-label">First Name<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_first_name') is-invalid @enderror" type="text" id="beneficiary_first_name" name="beneficiary_first_name" placeholder="Enter BENEFICIARY first name" value="{{ old('beneficiary_first_name') }}" required>
        @error('beneficiary_first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3">
        <label for="beneficiary_last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_last_name') is-invalid @enderror" type="text" id="beneficiary_last_name" name="beneficiary_last_name" placeholder="Enter BENEFICIARY last name" value="{{ old('beneficiary_last_name') }}" required>
        @error('beneficiary_last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3">
        <label for="beneficiary_email" class="form-label">Beneficiary Email ID<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_email') is-invalid @enderror" type="email" id="beneficiary_email" name="beneficiary_email" placeholder="Enter BENEFICIARY Mail ID" value="{{ old('beneficiary_email') }}" required>
        @error('beneficiary_email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3">
        <div class="form-floating">
            <textarea class="form-control" placeholder="beneficiary_address" id="beneficiary_address" style="height: 100px"></textarea>
            <label for="beneficiary_address">Beneficiary Address</label>
        </div>
    </div>
    <div class="col-6 mb-3">
        <label for="beneficiary_account_no" class="form-label">Beneficiary Account No.<span class="text-danger">*</span></label>
        <input class="form-control @error('beneficiary_account_no') is-invalid @enderror" type="text" id="beneficiary_account_no" name="beneficiary_account_no" placeholder="Enter BENEFICIARY Account Number" value="{{ old('beneficiary_account_no') }}" required>
        @error('beneficiary_account_no')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>