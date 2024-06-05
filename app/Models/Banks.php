<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    public $table = 'banks';
    protected $primaryKey = 'bank_id';
    public $fillable = [
        'bank_name',
        'bank_applicant',
        'bank_swift_code',
        'bank_address',
        'bank_country',
        'bank_status',
        'service_sub_cat_id',
        'draftType_id'
    ];

    protected $casts = [
        'bank_name' => 'string',
        'bank_applicant' => 'string',
        'bank_swift_code' => 'string',
        'bank_address' => 'string',
        'bank_country' => 'string',
        'bank_status' => 'string',
        'service_sub_cat_id' => 'array',
        'draftType_id'=>'array',
    ];

    public static array $rules = [
        'bank_name' => 'required|string|max:255',
        'bank_applicant' => 'nullable|string|max:255',
        'bank_swift_code' => 'nullable|string|max:255',
        'bank_address' => 'nullable|string|max:255',
        'bank_country' => 'nullable|string|max:255',
        'bank_status' => 'required|string|max:255',
        'service_sub_cat_id' => 'required|array',
        'draftType_id' => 'required|array',
    ];

    
}
