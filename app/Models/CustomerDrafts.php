<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDrafts extends Model
{
    public $table = 'customer_drafts';

    public $fillable = [
        'user_id',
        'service_cat_id',
        'service_sub_cat_id',
        'service_subsub_cat_id',
        'bank_id',
        'payment_status'
    ];

    protected $casts = [
        'service_cat_id' => 'string',
        'service_sub_cat_id' => 'string',
        'service_subsub_cat_id' => 'string',
        'bank_id' => 'string',
        'payment_status' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'service_cat_id' => 'required|string|max:255',
        'service_sub_cat_id' => 'required|string|max:255',
        'service_subsub_cat_id' => 'required|string|max:255',
        'bank_id' => 'required|string|max:255',
        'payment_status' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
