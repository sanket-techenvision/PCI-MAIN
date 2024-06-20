<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDrafts extends Model
{
    public $table = 'customer_drafts';

    public $fillable = [
        'user_id',

        'applicant_first_name',
        'applicant_last_name',
        'applicant_email',

        'applicant_address',
        'applicant_country',
        'applicant_state',
        'applicant_city',

        'service_cat_id',
        'service_sub_cat_id',
        'service_subsub_cat_id',
        'bank_id',

        'beneficiary_first_name',
        'beneficiary_last_name',
        'beneficiary_email',

        'beneficiary_address',
        'beneficiary_country',
        'beneficiary_state',
        'beneficiary_city',

        'beneficiary_account_no',
        'beneficiary_bank_name',
        'beneficiary_bank_address',

        'currency_code',
        'guarantee_amount',

        'advising_swift_code',
        'contract_no',
        'contract_date',

        'payment_status',
        'approval_status',

        'approve_notice',
        'reason',
        'file_path'
    ];

    protected $casts = [
        'applicant_first_name' => 'string',
        'applicant_last_name' => 'string',
        'applicant_email' => 'string',
        'applicant_address' => 'string',
        'applicant_country' => 'string',
        'applicant_state' => 'string',
        'applicant_city' => 'string',
        'service_cat_id' => 'string',
        'service_sub_cat_id' => 'string',
        'service_subsub_cat_id' => 'string',
        'bank_id' => 'string',
        'beneficiary_first_name' => 'string',
        'beneficiary_last_name' => 'string',
        'beneficiary_email' => 'string',
        'beneficiary_address' => 'string',
        'beneficiary_country' => 'string',
        'beneficiary_state' => 'string',
        'beneficiary_city' => 'string',
        'beneficiary_account_no' => 'string',
        'guarantee_amount' => 'string',
        'payment_status' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'applicant_first_name' => 'required|string|max:255',
        'applicant_last_name' => 'required|string|max:255',
        'applicant_email' => 'required|string|max:255',

        'applicant_address' => 'required|string|max:255',
        'applicant_country' => 'required|string|max:255',
        'applicant_state' => 'required|string|max:255',
        'applicant_city' => 'nullable|string|max:255',

        'service_cat_id' => 'required|string|max:255',
        'service_sub_cat_id' => 'required|string|max:255',
        'service_subsub_cat_id' => 'nullable|string|max:255',
        'bank_id' => 'required|string|max:255',

        'beneficiary_first_name' => 'required|string|max:255',
        'beneficiary_last_name' => 'required|string|max:255',
        'beneficiary_email' => 'required|string|max:255',

        'beneficiary_address' => 'required|string|max:255',
        'beneficiary_country' => 'required|string|max:255',
        'beneficiary_state' => 'required|string|max:255',
        'beneficiary_city' => 'nullable|string|max:255',

        'beneficiary_account_no' => 'required|string|max:255',
        'beneficiary_bank_name' => 'nullable|string|max:255',
        'beneficiary_bank_address' => 'nullable|string|max:255',
        'currency_code' => 'required|string|max:255',
        'guarantee_amount' => 'required|string|max:255',

        'advising_swift_code' =>  'required|string|max:255',
        'contract_no' => 'required|string|max:255',
        'contract_date' => 'required|string|max:255',
        
        'payment_status' => 'required|string|max:255',

        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
